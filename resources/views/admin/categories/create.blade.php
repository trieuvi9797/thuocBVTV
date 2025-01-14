@extends('admin.layouts.app')
@section('title', 'Thêm danh mục')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="col-auto">
                <h1 class="app-page-title">Thêm danh mục</h1>
            </div>
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form action="" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" id="name" value="" required>
                            @error('name')
                                <span class="text-danger"> </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục:</label>
                            <select name="parent_id" class="form-control">
                                    <option value="">---Chọn danh mục---</option>
                                @foreach ($parentCategories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                    <button type="submit" class="btn app-btn-primary" >Lưu</button>
                
                    </form>
                </div><!--//app-card-body-->
            </div>
</div><!--//row-->

@endsection