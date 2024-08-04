@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show icons-alert" role="alert">
        <strong>{!! session('success') !!}</strong>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show icons-alert" role="alert">
        <strong>{!! session('error') !!}</strong>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
