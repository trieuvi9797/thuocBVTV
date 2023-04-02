@extends('admin.layouts.app')    
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">          
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Chi tiết sản phẩm</h1>
        </div>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h4 class="section-title">Hình sản phẩm</h4>
                <div  id="image_show">            
                    <img src="{{ $product->image }}" id="show-image" alt="" width="300px" height="300px">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="mb-3">
                            <label  class="form-label">Tên sản phẩm:</label>
                            <h4>{{ $product->name }}</h4>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Danh mục:</label>
                            <a>{{ $product->category_id }}</a>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label  class="form-label">Giá bán:</label>
                                    <a>{{ $product->price }} VNĐ</a>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Khuyến mãi:</label>
                                    <a>{{ $product->sale }}%</a>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Lượt xem:</label>
                                    <a></a>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label  class="form-label">Số lượng:</label>
                                    <a>{{ $product->quantity }}</a>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Đã bán:</label>
                                    <a>{{ $getDetail->view }}</a>
                                </div>                                
                                <div class="mb-3">
                                    <label  class="form-label">Lượt thích:</label>
                                    <a></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <div class="mb-3">
                        <label  class="form-label">Mô tả:</label>
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!--//tab-content-->
</div><!--//container-fluid-->
 
@endsection
