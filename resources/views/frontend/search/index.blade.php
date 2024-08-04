@extends('frontend.app.index')
@section('title', 'Search')
@section('content')
    <div class="box-shipping">
        <div style="height: 386px; text-align: center; padding: 56px">
            <h2 style="font-size: 28px; margin-bottom: 32px; color: #252525">
                Search
            </h2>
            <div class="row">
                <div class="col">
                    <form method="GET" action="{{ route('frontend.getSearch') }}">
                        <div class="input-group mb-3" style="max-width: 500px; margin: auto">
                        <input
                            type="text"
                            class="form-control form-control-lg rounded-search"
                            placeholder="Search..."
                            name="search"
                            aria-label="Search"
                            style="
                    border-top-right-radius: 0;
                    border-bottom-right-radius: 0;
                  "
                        />
                        <button
                            class="btn btn-outline-secondary rounded-search"
                            type="submit"
                            id="button-addon2"
                            style="
                    border-top-left-radius: 0;
                    border-bottom-left-radius: 0;
                  "
                        >
                            <i class="bi bi-search text-black"></i>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
