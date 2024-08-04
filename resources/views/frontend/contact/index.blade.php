@extends('frontend.app.index')
@section('title', 'Contact')
@section('content')
    <div class="box-contact">
        <h2>Contact Us</h2>
        <div class="box-description">
            <p>
                We’re here to help answer any questions. We'll get back to you as
                soon as we can.
            </p>
        </div>
        <form class="contact-form" method="POST" action="{{ route('frontend.createContact') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 mb-12">
                    @include('frontend.notify')
                </div>
                <!-- Name field -->
                <div class="col-sm-12 col-md-6 mb-3">
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        id="full_name"
                        name="full_name"
                        placeholder="Name"
                    />
                </div>
                <!-- Email field -->
                <div class="col-sm-12 col-md-6 mb-3">
                    <input
                        type="email"
                        name="email"
                        class="form-control form-control-lg"
                        id="email"
                        placeholder="Email *"
                    />
                </div>
            </div>
            <!-- Phone number field -->
            <div class="mb-3">
                <input
                    type="tel"
                    class="form-control form-control-lg"
                    id="phone_number"
                    name="phone_number"
                    placeholder="Phone number"
                />
            </div>
            <!-- Comment field -->
            <div class="mb-3">
            <textarea
                class="form-control form-control-lg"
                id="comment"
                rows="3"
                name="note"
                placeholder="Comment"
            ></textarea>
            </div>
            <!-- Send button -->
            <button
                type="submit"
                class="btn btn-lg"
                style="background-color: rgb(44, 51, 47); color: white"
            >
                Send
            </button>
        </form>
    </div>
@endsection
