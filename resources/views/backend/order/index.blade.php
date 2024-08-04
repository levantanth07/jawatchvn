@extends('backend.app.index')
@section('title','Danh sách đơn hàng')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Danh sách đơn hàng</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <form method="GET" action="{{ route('backend.order.index') }}">
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
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Total Quantity</th>
                            <th style="width: 250px">Status</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $item)
                            <tr class="content-data">
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->customer->full_name }}</td>
                                <td>{{ number_format($item->total_amount, 2) }}$</td>
                                <td>{{ number_format($item->total_quantity, 2) }}</td>
                                <td>
                                    <select name="status" class="form-control status" data-id="{{ $item->id }}">
                                        <option @if($item->status == 0) {{'selected'}} @endif value="0">Chờ xử lý</option>
                                        <option @if($item->status == 1) {{'selected'}} @endif value="1">Hoàn thành</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
                                        View
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Order detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>STT</th>
                                                                <th>Product name</th>
                                                                <th>Amount</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($item->orderDetail as $key => $value)
                                                            <tr>
                                                                <th>{{ $key+1 }}</th>
                                                                <td>{{ $value->product->name ?? '' }}</td>
                                                                <td>{{ number_format($value->amount ?? 0) }}$</td>
                                                                <td>{{ number_format($value->quantity ?? 0, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@section('script')
    <script>
        $(document).ready(function () {
            $('.status').on('change', function () {
                let elementParents = $(this).parents('.content-data');
                let id = elementParents.find('.status').data('id');
                let status = elementParents.find('.status').val();
                $.ajax({
                    type: "GET",
                    url: "/backend/order/update/"+id,
                    data: {status : status},
                    success: function (response) {
                        if (response.code === 200) {
                            alert('Success!')
                        } else {
                            alert('Fail!')
                        }
                    }
                });
            })
        })
    </script>
@endsection

