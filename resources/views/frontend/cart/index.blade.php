@extends('frontend.app.index')
@section('title', 'Cart')
@section('content')
    <div class="box-shipping">
        <div class="cart-content">
            @include('frontend.notify')
            <div class="box-header">
                <h2 style="font-size: 40px; color: #252525">Your cart</h2>
                <a style="font-size: 18px; color: #505655" href="{{ route('frontend.home') }}">
                    Continue shopping
                </a>
            </div>
            <div class="box-table-cart">
                <table class="table custom-table-cart">
                    <thead>
                    <tr>
                        <th class="product-col">Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                            <tr class="cart-item">
                                <td>
                                    <div class="cart-product">
                                        <div class="left">
                                            <img src="{{ asset('').'public/public/'.$cart['image'] }}" alt="img" />
                                        </div>
                                        <div class="right">
                                            <a href="{{ route('frontend.detailProduct', $cart['slug']) }}">
                                                {{ $cart['name'] }}
                                            </a>
                                            <p
                                                style="
                                    color: #252525bf;
                                    font-size: 16px;
                                    margin-top: 8px;
                                  "
                                            >
                                                ${{ $cart['price_format'] }} US
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-quantity">
                                        <div class="counter-container">
                                            <button class="counter-button decrement" data-id="{{ $cart['id'] }}">-</button>
                                            <span class="counter-value counter" data-id="{{ $cart['id'] }}">{{ $cart['qty'] }}</span>
                                            <button class="counter-button increment" data-id="{{ $cart['id'] }}">+</button>
                                        </div>
                                        <i
                                            class="bi bi-trash3"
                                            style="color: #252525; font-size: 20px"
                                        ></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-total">
                                        <p style="color: #252525; font-size: 18px">$<span class="cart_total">{{ $cart['total_format'] }}</span> US</p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cart-footer">
            <div style="display: flex; flex-direction: column; align-items: end;">
                <div class="d-flex mb-5">
                    <p style="font-weight: 500; font-size: 20px; color: #252525">
                        Subtotal
                    </p>
                    <p style="margin-left: 20px; font-size: 18px; color: #252525bf">$
                        <span class="total_price_all">{{ $total_price_all }}</span> US
                    </p>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal" style="font-size: 18px; padding: 8px 124px">
                    Check Out
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Information</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="POST" action="{{ route('frontend.createOrder') }}">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" placeholder="Enter email" name="email">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email">First name:</label>
                                        <input required type="text" class="form-control" placeholder="Enter First name" name="first_name">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email">Last name:</label>
                                        <input required type="text" class="form-control" placeholder="Enter Last name" name="last_name">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email">Address:</label>
                                        <input type="text" class="form-control" placeholder="Enter address" name="address">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email">Phone number:</label>
                                        <input required type="text" class="form-control" placeholder="Enter Phone number" name="phone_number">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="email">Note:</label>
                                        <textarea class="form-control" cols="3" rows="3" name="note">

                                        </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Order</button>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
               {{-- <button
                    class="btn btn-secondary"
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                    style="font-size: 18px; padding: 8px 124px"
                >
                    Check out
                </button>--}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.decrement').on('click', function () {
                let element_root = $(this).parents('.cart-item');
                let quantity = $(this).parents('.counter-container').find('.counter').text();
                let product_id =  $(this).parents('.counter-container').find('.counter').data('id');
                quantity--
                if (quantity === 0) {
                    alert('The quantity must be greater than 0')
                    $(this).parents('.counter-container').find('.counter').text(1)
                    return;
                }
                $(this).parents('.counter-container').find('.counter').text(quantity)
                updateCart(product_id, quantity, element_root)
            })

            $('.increment').on('click', function () {
                let element_root = $(this).parents('.cart-item');
                let quantity = $(this).parents('.counter-container').find('.counter').text();
                let product_id =  $(this).parents('.counter-container').find('.counter').data('id');
                quantity++
                $(this).parents('.counter-container').find('.counter').text(quantity)
                updateCart(product_id, quantity, element_root)
            })

            function updateCart(product_id, quantity, element_root) {
                $.ajax({
                    type: "GET",
                    url: "/update-cart/"+product_id,
                    data: {quantity : quantity},
                    success: function (response) {
                        element_root.find('.counter').text(response.data.cart.qty)
                        element_root.find('.cart_total').text(response.data.cart.total_format)
                        $('.total_price_all').text(response.data.total_price_all)
                    }
                });
            }
        })
    </script>
@endsection
