<form action="{{ route('stripe.checkout.session') }}" method="POST">
    @csrf
    <button type="submit" class="btn text-button">
        Pay $10 to Download PDF
    </button>
</form>
<style>
    .text-button {
        background: none;
        border: none;
        color: red;
        cursor: pointer;
        font-size: inherit;
        font-family: inherit;
        padding: 0;
        color: #F96608;
        font-size: 2rem;
        font-weight: 700;
        font-family: "Roboto", Sans-serif;
    }

    .text-button:hover {
        color: darkblue;
    }
</style>
