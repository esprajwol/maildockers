@extends('dashboard.layouts.main')

@section('title', ' - Brand Lists')
@section('content')
    <h1>Stripe Payment Form</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('customer.checkout.session') }}" method="POST">
        @csrf
        <button type="submit">Pay £9.90</button>
    </form>

@stop
