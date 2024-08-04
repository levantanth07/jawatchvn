@extends('frontend.app.index')
@section('title', 'Refund policy')
@section('content')
    <div class="container box-shipping">
        <h2>Refund policy</h2>
        <div class="box-description">
            {!! $post->content !!}
        </div>
    </div>
@endsection
