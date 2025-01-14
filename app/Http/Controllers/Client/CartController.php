<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Jobs\SendMail;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    

    public function index()
    {
        if(Auth::user()->user_type=='US'){
        return view('client.carts.list',[
            'title' => 'Giỏ hàng của bạn',
            'content' => Cart::content()
        ]);
        }
        return redirect()->back();
    }

    public function addCart($id, Request $request)
    {
        if(Auth::user()->user_type=='US'){
            $product = Product::where('id', $id)->first();
            $qty = (int)$request->input('qty');
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'weight' => 0,
                'options' => [
                    'image' => $product->image
                ]
            ]);
                return redirect('/gio-hang');
        }
        return redirect()->back();
    }

    public function addProductCart($id)
    {
        if(Auth::user()->user_type=='US'){
            $product = Product::where('id', $id)->first();
            if($product->quantity == 0)
            {
                return redirect('/gio-hang')->with('error', 'Sản phẩm bạn đã chọn không đủ số lượng trong kho.');
            }
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'weight' => 0,
                'options' => [
                    'image' => $product->image
                    ]
                ]);
            return redirect('/gio-hang');
        }
        return redirect()->back();
    }
    
    public function remove($row_id)
    {
        Cart::remove($row_id);
        return redirect('/gio-hang');
    }
    public function upQuantity($row_id)
    {
        $row = Cart::get($row_id);
        $product = Product::find($row->id);
        if($row->qty < $product->quantity)
        {
            Cart::update($row_id, $row->qty + 1);
            Session::flash('success', 'Bạn vừa thêm sản phẩm vào giỏ hàng.');
            return redirect('/gio-hang');
        }
        return redirect('/gio-hang')->with('error', 'Sản phẩm bạn vừa chọn không đủ số lượng trong kho. Vui lòng chọn sản phẩm khác để thay thế hoặc liên hệ hotline để được tư vấn thêm.');
    }
    public function downQuantity($row_id)
    {
        $row = Cart::get($row_id);
        if($row->qty > 1)
        {
            Cart::update($row_id, $row->qty - 1);
        }
        return redirect('/gio-hang');
    }
    public function getCheckout()
    {
        $user = Auth::user();
        return view('client.carts.create',[
            'title' => 'Đơn hàng của bạn',
            'content' => Cart::content(),
            'user' => $user,
        ]);
    }
    
    public function postCheckout(Request $request)
    {
        $this->validate($request, [
			'phone' => ['required', 'max:191'],
			'address' => ['required', 'max:191'],
		]);
        //Kiêm tra xem số lượng mỗi sản phẩm có còn trong kho hàng nữa không
        $flag = true;
        $list_soil_out = "";
        foreach (Cart::content() as $row) {
            $rowId = $row->rowId;
            $product_qty = Product::where('id',$row->id)->select('quantity')->get()->first();
            $quantity_repository = $product_qty->quantity;
            //Nếu số lượng trong kho bằng 0 thì xóa sản phẩm đó ra khỏi cart
            if($row->qty > $quantity_repository)
            {
                $product = Product::find($row->id);
                $name_pro = $product->name;
                $list_soil_out .= " " . $row->name . " số lượng trong kho còn " . $quantity_repository . " sản phẩm <br/>";
                $flag = false;
                //update lại số lượng sản phẩm trong cart bằng số lượng trong kho.
                Cart::update($rowId,['qty'=>$quantity_repository]);
            }
        }
            //nếu có những sản phẩm đã hết, hoặc số lượng ít hơn lựa chọn thì thông báo cho người dùng
        if($flag == false){
            return redirect('create')->with('error',"Bạn vui lòng kiểm tra lại giỏ hàng: <br/>".$list_soil_out);
        }
        else{
            $customer = new Customer;
            $customer->name    = $request->name;
            $customer->email   = $request->email;
            $customer->phone   = $request->phone;
            $customer->address = $request->address;
            $customer->note    = $request->note;
         
            if(Auth::check()) { $customer->user_id = Auth::user()->id;} 
        
            if($customer->save())
                {   //lưu thong tin dơn hàng    
                    $customer_id = Customer::max('id');   
                    $bill = new Bill();
                    $bill->customer_id = $customer_id;
                    $total_price = Cart::total(0,'','');
                    $bill->total_price = $total_price;
                    if($bill->save())
                    {   //lưu thông tin chi tiết đơn hàng
                        $bill_id  = Bill::max('id');
                        foreach(Cart::content() as $cart)
                        {
                            $detail_bill             = new BillDetail();
                            $detail_bill->bill_id    = $bill_id;
                            $detail_bill->product_id = $cart->id;
                            $detail_bill->quantity   = $cart->qty;
                            // $detail_bill->price      = $cart->price;
                            $detail_bill->price      = $cart->subtotal(0,'','');
                            $detail_bill->save();
    
                            $productID = Product::where('id',$cart->id)->select('quantity')->get()->first();
                            $quantity = $productID->quantity;
                            $qty_remaining = $quantity - $cart->qty; //sl ton = sl kho - sl moi mua
                            $qty_buy = $productID->sold;
                            $sold = $qty_buy + $cart->qty; // sl da ban
                            //cập nhật lại số lượng hàng trong kho
                            $quantity = DB::table('products')
                                            ->where('id',$cart->id)
                                            ->update([
                                                'quantity' => $qty_remaining,
                                                'sold'     => $sold ]);
                        }
                    // SendMail::dispatch($customer->email)->delay(now()->addSeconds(2));

                    $billDetail = BillDetail::where('bill_id', $bill->id)->get();

                    Mail::send('client.mail.success',[
                        'detail_bill'=>$billDetail,
                        'bill'=>$bill,
                        'customer'=>$customer,
                    ], function($message) use ($request){
                        $message->to($request->email, $request->name)
                                ->subject('Đơn hàng của bạn');
                    });



                    Cart::destroy();
                    return redirect('/dat-hang-thanh-cong')->with('success',"Thanh toán thành công. Bạn có thể kiểm tra email thanh toán để xem đơn hàng");
                }else{
                    return redirect()->back()->with('error',"Không thể lưu lại thông tin đơn hàng");
                }
            }else{
                 return redirect()->back()->with('error',"Không thể lưu lại thông tin khách hàng");
            }
        }   
    }
    
    public function successfull()
    {
        return view('client.bills.successfull',[
            'title' => 'Đặt hàng thành công',
        ]);
    }

    public function myBill()
    {
        $userID = Auth::user()->id;
        $customer_userID = Customer::where('user_id',$userID)->orderByDesc('id')->get();
        if(count($customer_userID) > 0){
            foreach($customer_userID as $value)
            $id_customer[] = $value->id;
        }else
            $id_customer = [];

        $bill_ID = Bill::whereIn('customer_id',$id_customer)->orderByDesc('id')->get();
        if(count($bill_ID) > 0){
            foreach($bill_ID as $value)
            $id_billDetail[] = $value->id;
        }else
            $id_billDetail = [];

        $billDetail = BillDetail::whereIn('bill_id',$id_billDetail)->orderByDesc('created_at')->get();
        return view('client.bills.myBill', [
            'title' => 'Đơn hàng của tôi',
            'bills' => $bill_ID,
            'billDetails' => $billDetail,
            'customers' => $customer_userID,
        ]);
    }
    
    public function myBill_Detail($id)
    {
        $billDetail = BillDetail::where('bill_id', $id)->get();
        $bill = Bill::find($id);
        $customer = Customer::find($bill->customer_id);
        return view('client.bills.billDetail',[
            'title' => 'Chi tiết đơn hàng của tôi',
            'billDetails' => $billDetail,
            'bills' => $bill,
            'customers' => $customer
        ]); 
    }

    public function myBill_Done($id)
    {
        $bill_ID = Bill::where('id',$id)->first();
        if($bill_ID->active == 1){
            DB::table('bills')->where('id',$id)->update(['active' => 2]);
        }

        $billDetail = BillDetail::where('bill_id', $id)->get();
        $bill = Bill::find($id);
        $customer = Customer::find($bill->customer_id);
        return view('client.bills.billDetail',[
            'title' => 'Chi tiết đơn hàng của tôi',
            'billDetails' => $billDetail,
            'bills' => $bill,
            'customers' => $customer
        ]); 
    }
}
