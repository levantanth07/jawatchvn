@extends('frontend.app.index')
@section('title', 'Privacy')
@section('content')
    <div class="box-shipping">
        <h2>Privacy</h2>
        <div class="box-description">
            {!! $post->content !!}
        </div>
    </div>
@endsection
