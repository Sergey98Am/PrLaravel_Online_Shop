@extends('layouts.general')

@section('sidebar')
@endsection

@section('cont')
    <div class="col-12">
        @if(session()->has('success_message'))
            <div class="spaces"></div>
            <div class="alert alert-success">
                {{session()->get('success_message')}}
            </div>
        @endif
    </div>
    <div class="col-12">
        @if(count($errors) > 0)
            <div class="spacer"></div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="col-12 checkout-title">
        <h2>Checkout</h2>
    </div>
    <div class="col-sm-12 col-md-6 checkout_form">
        <form action="{{route('checkout.store')}}" id="payment-form" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="province">Province</label>
                    <input type="text" class="form-control" id="province" name="province" value="{{old('province')}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="postalcode">Postal Code</label>
                    <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{old('postalcode')}}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                </div>
                <div class="col-md-12 mb-3 payment_details">
                    <h4>Payment Details</h4>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="name_on_card">Name On Card</label>
                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{old('name_on_card')}}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
            </div>
            <button id="complete-order" class="btn btn-success" type="submit">Complete Order</button>
        </form>
    </div>
    <div class="col-sm-12 col-md-6 checkout_prods">
        <div class="total-promo">
            @if(session()->has('coupon'))
                <h2><sub>Total Amount</sub> ${{$sum - session()->get('coupon')['discount']}}</h2>
                <div class="coupon">
                    <h3><sub>Discount</sub> <b>(</b>({{session()->get('coupon')['name']}}) | (-{{session()->get('coupon')['discount']}})<b>)</b> </h3>
                    <form action="{{route('coupon.destroy')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>Remove</button>
                    </form>
                </div>
                @else
                <h2><sub>Total Amount</sub> ${{$sum}}</h2>
            @endif
            <form action="{{route('coupon.store')}}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo Code" id="coupon_code" name="coupon_code">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Apply</button>
                    </div>
                </div>
            </form>
        </div>
        @foreach($cart as $product)
            <div class="prod_checkout" style="width: 100%">
                <img src="{{asset('/images/'.$product->image)}}" >
                <div class="prod_checkout_body">
                    <h5>{{$product->title}}</h5>
                    <div class="prices">
                        <span>Price > ${{$product->price}} -- </span>
                        <span>Quantity > {{$product->quantity}}</span>
                        <p>Total Price > ${{$product->total_price}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('scr')
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_rhEb4JV6suaOFYEaNDhKOkHU00EB0IfJ1O');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true,
        })

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            document.getElementById('complete-order').disabled = true;

            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_stat: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value,
            }


            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;

                    document.getElementById('complete-order').disabled = false;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });


        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();

        }
    </script>
@endsection
