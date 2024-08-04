@extends('frontend.app.index')
@section('content')
    <div class="container box-about">
        <h2>About Us</h2>
        <div class="box-description">
            {!! $post->content !!}
        </div>
    </div>
@endsection
