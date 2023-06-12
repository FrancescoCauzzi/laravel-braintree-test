@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout Page</h1>
    <form method="post" action="/purchase">
        @csrf
        <!-- Add form fields for payment information here -->
        <input type="hidden" id="payment_method_nonce" name="payment_method_nonce" value="">

        <button type="submit">Submit Payment</button>
    </form>

</div>
<script>
    var clientToken = "{{ $clientToken }}";
    // Use the clientToken here...
</script>

@endsection
