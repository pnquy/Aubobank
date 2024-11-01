<!-- resources/views/purchase/form.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nạp Tiền vào Tài Khoản</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('purchase.process') }}" method="POST" id="payment-form">
        @csrf

        <div class="form-group">
            <label for="amount">Số tiền (USD):</label>
            <input type="number" name="amount" id="amount" class="form-control" min="10" required>
        </div>

        <div class="form-group">
            <label for="card-element">Thông tin thẻ</label>
            <div id="card-element">
                <!-- Stripe.js injects the Card Element -->
            </div>
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit" class="btn btn-primary">Nạp Tiền</button>
    </form>
</div>
@endsection

@section('scripts')
<!-- Include Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Cấu hình Stripe
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    // Xử lý lỗi
    card.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Xử lý form submit
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Hiển thị lỗi cho người dùng
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Gửi token tới server
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);

                // Submit form
                form.submit();
            }
        });
    });
</script>
@endsection
