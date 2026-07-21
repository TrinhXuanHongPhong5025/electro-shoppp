@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhật sản phẩm
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form"  action="{{URL::to('/update-order'.$order_id)}}" method="POST">
                            @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>

                                        <select name="order_status" class="form-control input-sm m-bot15">

                                            <option value="0" {{ isset($data) && $data->order_status == 0 ? 'selected' : '' }}>Accepted</option>
                                            <option value="1" {{ isset($data) && $data->order_status == 1 ? 'selected' : '' }}>In progress</option>
                                            <option value="2" {{ isset($data) && $data->order_status == 2 ? 'selected' : '' }}>Shipped</option>
                                            <option value="3" {{ isset($data) && $data->order_status == 3 ? 'selected' : '' }}>Delivered</option>
                                            <option value="4" {{ isset($data) && $data->order_status == 4 ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>
                                <button type="submit" name="edit_order_status" class="btn btn-info">Submit</button>
                            </form>
                        </div>

                    </div>
                </section>

            </div>
        </div>
@endsection
