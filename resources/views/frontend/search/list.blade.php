@extends('frontend.app.index')
@section('title', 'List search')
@section('content')
    <div class="section">
            <h2 class="h1">Kết quả tìm kiếm với từ khóa : <span class="text-danger">{{ $search }}</span></h2>
            <div class="row g-4 mt-4">
                @foreach($results as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="card">
                            <div class="card-box">
                                <a href="{{ route('frontend.detailProduct', $item->slug) }}">
                                    <img style="width: 100%" src="{{ asset('').'public/public/'.$item->image }}" alt="image" />
                                </a>
                            </div>
                             @if($item->is_stock == 1)
                                <div style="color:#ffffff; background-color:#204D6C; text-align:center; font-weight:800; padding:5px">STOCK</div>
                            @else
                                <div style="color:#ffffff; background-color:red; text-align:center; font-weight:800; padding:5px">SOLD</div>
                            @endif
                            <div class="card-body d-flex gap-2 align-items-center py-4">
                                <div class="d-flex flex-column flex-wrap">
                                    <a href="{{ route('frontend.detailProduct', $item->slug) }}" title="{{ $item->name }}">{{ \Illuminate\Support\Str::limit($item->name, 30) }}</a>
                                    <h3 class="py-3 mb-2">${{ $item->sale_price > 0 ? number_format($item->sale_price) : number_format($item->price) }} US</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="text-center d-flex justify-content-center" id="pagination-customer"
                style="margin-top: 56px"
            >
                {!! $results->withQueryString()->links() !!}
            </div>
        </div>
@endsection
@section('style')
    <style>
        #pagination-customer nav ul li.active >span.page-link {
            color: #FFFFFF !important;
        }
    </style>
@endsection
@section('script')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#pagination-customer nav ul').addClass('pagination-lg');
        })
    </script>
@endsection
