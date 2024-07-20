@extends('front.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form  role="form"
                        action="{{ route('stripe.post') }}"
                        method="post"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        id="payment-form">
            @csrf
                <div class="card shadow-lg border-0">
                    <div class="card-body checkout-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a Country</option>
                                        <option value="1">India</option>
                                        <option value="2">UK</option>
                                    </select>
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control"></textarea>
                                </div>            
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="city" id="city" class="form-control" placeholder="City">
                                </div>            
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="state" id="state" class="form-control" placeholder="State">
                                </div>            
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip">
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
                                </div>            
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes " class="form-control"></textarea>
                                </div>            
                            </div>
                        </div>
                    </div>
                </div>
       </div>
        <div class="col-md-4">
            <div class="sub-title">
                <h2>Order Summary</h2>
            </div>
            <div class="card cart-summary">
                <div class="card-body">
                    @php
                        $total = 0;
                        $shipping = 20;
                    @endphp
                    @foreach($cartItems as $cartItem)
                        @php
                            $product = $cartItem->product;
                            $subtotal = $product->price * $cartItem->qty;
                            $total += $subtotal;
                        @endphp
                        <div class="d-flex justify-content-between pb-2">
                            <div class="h6">{{ $product->name }} X {{ $cartItem->qty }}</div>
                            <div class="h6">${{ number_format($subtotal, 2) }}</div>
                        </div>
                    @endforeach
                
                    <div class="d-flex justify-content-between summery-end">
                        <div class="h6"><strong>Subtotal</strong></div>
                        <div class="h6"><strong>${{ number_format($total, 2) }}</strong></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="h6"><strong>Shipping</strong></div>
                        <div class="h6"><strong>${{ number_format($shipping, 2) }}</strong></div>
                    </div>
                    <div class="d-flex justify-content-between mt-2 summery-end">
                        @php
                            $grandTotal = $total + $shipping;
                        @endphp
                        <div class="h5"><strong>Total</strong></div>
                        <div class="h5"><strong>${{ number_format($grandTotal, 2) }}</strong></div>
                    </div>
                </div>
            </div>
            <div class="card payment-form">
                <div class="card-body p-0">
                    <div class="pt-4">
                        <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#payment-form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true
                },
                country: "required",
                address: "required",
                city: "required",
                state: "required",
                zip: "required",
                mobile: "required",
                order_notes: "required"
            },
            messages: {
                first_name: "Please enter your first name",
                last_name: "Please enter your last name",
                email: "Please enter a valid email address",
                country: "Please select a country",
                address: "Please enter your address",
                city: "Please enter your city",
                state: "Please enter your state",
                zip: "Please enter your zip code",
                mobile: "Please enter your mobile number",
                order_notes: "Please enter order notes"
            },
        });
    });
</script>
@endsection
