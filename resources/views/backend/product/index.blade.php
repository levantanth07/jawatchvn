@extends('backend.app.index')
@section('title','Danh sách sản phẩm')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Danh sách sản phẩm</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form method="GET" action="{{ route('backend.product.index') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Nhập từ khóa">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Tìm kiếm</button>
                        </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                @include('backend.notify')
                <div class="x_content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Status</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ number_format($item->price ?? 0) }}</td>
                                <td>{{ number_format($item->sale_price ?? 0) }}</td>
                                <td>@if($item->status == 1)
                                        <span class="text-success">{{ 'Kích hoạt' }}</span>
                                    @elseif($item->status == 2)
                                        <span class="text-danger">{{ 'Ngừng kích hoạt' }}</span>
                                    @endif</td>
                                <td>@if($item->is_stock == 1)
                                        <span class="text-success">{{ 'Còn hàng' }}</span>
                                    @elseif($item->is_stock == 2)
                                        <span class="text-danger">{{ 'Hết hàng' }}</span>
                                    @endif</td>
                                <td><img src="{{ asset('').'public/public/'.$item->image }}" alt="" width="80px"></td>
                                <td>
                                    <a href="{{ route('backend.product.edit',$item->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa ?')"
                                       href="{{ route('backend.product.destroy',$item->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {!! $results->withQueryString()->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

