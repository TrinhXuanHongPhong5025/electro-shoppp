@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhật sản phẩm
                    </header>
                    <div class="panel-body">
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="position-center">
                        @foreach($edit_product as $key =>$pro)
                            <form role="form" action="{{URL::to('/update-product'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                        <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Hình ảnh sản phẩm">
                                        <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="100" width="100" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                                        <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                        <textarea style="resize:none" rows="5" class="form-control" name="product_desc" id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                        <textarea style="resize:none" rows="5" class="form-control" name="product_content" id="exampleInputPassword1" value="">{{$pro->product_content}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                        <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate )
                                        @if($cate->category_id == $pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                        <!-- $brand_product lấy ở phương thức add_product của controller ProductController -->
                                        @if($brand->brand_id == $pro->brand_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Size sản phẩm</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($size_product as $key => $size)
                                        <!-- $brand_product lấy ở phương thức add_product của controller ProductController -->
                                        @if($size->size_id == $pro->size_id)
                                            <option selected value="{{$size->size_id}}">{{$size->size_name}}</option>
                                        @else
                                            <option value="{{$size->size_id}}">{{$size->size_name}}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Màu sắc sản phẩm</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($color_product as $key => $color)
                                        <!-- $brand_product lấy ở phương thức add_product của controller ProductController -->
                                        @if($color->color_id == $pro->color_id)
                                            <option selected value="{{$color->color_id }}">{{$color->color_name}}</option>
                                        @else
                                            <option value="{{$color->color_id }}">{{$color->color_name}}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                        </select>
                                    </div>
                                <button type="submit" name="add_product" class="btn btn-info">Submit</button>
                            </form>
                        @endforeach
                        </div>

                    </div>
                </section>

            </div>
        </div>
@endsection
