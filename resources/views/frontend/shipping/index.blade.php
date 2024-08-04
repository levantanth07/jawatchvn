@extends('frontend.app.index')
@section('title', 'Shipping')
@section('content')
    <div class="box-shipping">
        <h2>Shipping policy</h2>
        <div class="box-description">
            {!! $post->content !!}
        </div>
    </div>
@endsection
