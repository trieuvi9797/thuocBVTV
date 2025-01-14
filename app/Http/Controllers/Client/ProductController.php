<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\Category\CategoryService;
use App\Http\Services\Product\ProductService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    Protected $categoryService;
    Protected $productService;
    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index()
    {
        $category = $this->categoryService->getParent();
        $products = $this->productService->getAll();
        $productSale = $this->productService->getProductSale();
        $productNew = $this->productService->getProductNew();
        $productSold = $this->productService->getProductSold();
        return view('client.products.index', [
            'title' => 'Sản phẩm',
            'products' => $products,
            'productSale' => $productSale,
            'productSold' => $productSold,
            'productNew' => $productNew,
            'category' => $category
        ]);
    }

    public function productDetail($id = '', $slug = '')
    {
        //tăng lượt xem
        $idProduct = Product::find($id);
        $view = $idProduct->view;
        DB::table('products')->where('id',$id)->update(['view' => $view + 1]);

        $productDetails = $this->productService->getDetails($id);
        $products = $this->productService->more($id);
        return view('client.products.detail', [
            'title' => $productDetails->name,
            'products' => $products,
            'productDetails' => $productDetails,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function productNew()
    {
        $category = $this->categoryService->getParent();
        $products = $this->productService->productNew();
        $productSale = $this->productService->getProductSale();
        $productNew = $this->productService->getProductNew();
        $productSold = $this->productService->getProductSold();
        return view('client.products.new', [
            'title' => 'Sản phẩm mới nhất',
            'products' => $products,
            'productSale' => $productSale,
            'productSold' => $productSold,
            'productNew' => $productNew,
            'category' => $category
        ]);
    }
    public function productSold()
    {
        $category = $this->categoryService->getParent();
        $products = $this->productService->productSold();
        $productSale = $this->productService->getProductSale();
        $productNew = $this->productService->getProductNew();
        $productSold = $this->productService->getProductSold();
        return view('client.products.sold', [
            'title' => 'Sản phẩm bán chạy',
            'products' => $products,
            'productSale' => $productSale,
            'productSold' => $productSold,
            'productNew' => $productNew,
            'category' => $category
        ]);
    }
    public function productSale()
    {
        $category = $this->categoryService->getParent();
        $products = $this->productService->productSale();
        $productSale = $this->productService->getProductSale();
        $productNew = $this->productService->getProductNew();
        $productSold = $this->productService->getProductSold();
        return view('client.products.sale', [
            'title' => 'Sản phẩm khuyến mãi',
            'products' => $products,
            'productSale' => $productSale,
            'productSold' => $productSold,
            'productNew' => $productNew,
            'category' => $category
        ]);
    }
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
