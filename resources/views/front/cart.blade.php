@extends('front.layouts.app')

@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @foreach($cartItems as $cartItem)
                                    @php
                                        $product = $cartItem->product;
                                        $subtotal = $product->price * $cartItem->qty;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('image/' . ($product->image ?? 'default.jpg')) }}" width="50" height="50">
                                                <h2>{{ $product->name }}</h2>
                                            </div>
                                        </td>
                                        <td>${{ $product->price }}</td>
                                        <td>
                                            <div class="input-group quantity mx-auto" style="width: 149px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-dark btn-minus" onclick="updateCart({{ $product->id }}, {{ $cartItem->qty - 1 }})">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-0 text-center" value="{{ $cartItem->qty }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-dark btn-plus" onclick="updateCart({{ $product->id }}, {{ $cartItem->qty + 1 }})">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ $subtotal }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="removeFromCart({{ $product->id }})">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card cart-summery">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summary</h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                <div>Subtotal</div>
                                <div>${{ $total }}</div>
                            </div>
                            <div class="d-flex justify-content-between summery-end">
                                <div>Total</div>
                                <div>${{ $total }}</div>
                            </div>
                            <div class="pt-5">
                                <a href="{{ route('checkout') }}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script type="text/javascript">
    function updateCart(id, quantity) {
        if (quantity < 1) {
            return;
        }
        $.ajax({
            url: '{{ route("update.cart") }}',
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }

    function removeFromCart(id) {
        $.ajax({
            url: '{{ route("remove.from.cart") }}',
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function (response) {
                window.location.reload();
            }
        });
    }
</script>
@endsection
