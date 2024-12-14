<style>
    @import url("https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap");

    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    body {
        line-height: 1.5;
        min-height: 100vh;
        font-family: "Outfit", sans-serif;
        color: #2d232e;
        background-color: #c8c0bd;
        position: relative;
        margin: 0;
        padding: 0;
    }

    section {
        margin-top: 5px !important;
    }

    button,
    input,
    select,
    textarea {
        font: inherit;
    }

    a {
        color: inherit;
    }

    * {
        scrollbar-width: thin;
    }

    *::-webkit-scrollbar {
        background-color: transparent;
        width: 12px;
    }

    *::-webkit-scrollbar-thumb {
        border-radius: 99px;
        background-color: #ddd;
        border: 4px solid #fff;
    }

    .privacyPopup {
        position: fixed;
        display: none;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -33%);
        background-color: rgba(0, 0, 0, 0.25);
        padding: 20px;
        z-index: 99999;
    }

    .modal-container {
        display: flex;
        flex-direction: column;
        max-height: 60vh;
        /* width: 95%; */
        max-width: 700px;
        background-color: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.25);
        margin: 0 auto;
    }

    .modal-container-body {
        padding: 5px 32px 10px;
        overflow-y: auto;
        flex-grow: 1;
        scrollbar-width: auto;
        font-size: 16px !important;
    }

    .rtf h1, .rtf h2, .rtf h3, .rtf h4, .rtf h5, .rtf h6 {
        font-weight: 700;
    }

    .rtf h1 {
        font-size: 1.5rem;
        line-height: 1.125;
    }

    .rtf h2 {
        font-size: 1.25rem;
        line-height: 1.25;
    }

    .rtf h3 {
        font-size: 1rem;
        line-height: 1.5;
    }

    .rtf > * + * {
        margin-top: 1em;
    }

    .rtf > * + :is(h1, h2, h3) {
        margin-top: 2em;
    }

    .rtf > :is(h1, h2, h3) + * {
        margin-top: 0.75em;
    }

    .rtf ul,
    .rtf ol {
        margin-left: 20px;
        list-style-position: inside;
    }

    .rtf ol {
        list-style: decimal;
    }

    .rtf ul {
        list-style: disc;
    }

    .modal-container-footer {
        padding: 5px 5px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        border-top: 1px solid #ddd;
        gap: 5px;
        position: sticky; /* Keeps the footer visible at the bottom */
        bottom: 0;
        background-color: #fff;
    }

    .button {
        padding: 12px 20px;
        border-radius: 8px;
        background-color: transparent;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }

    .button.is-ghost {
        background-color: #94734e;
        color: #fff;
    }

    .button.is-ghost:hover,
    .button.is-ghost:focus {
        background-color: #ef7070;
    }

    .button.is-primary {
        background-color: #f96d13;
        color: #fff;
    }

    .button.is-primary:hover,
    .button.is-primary:focus {
        background-color: #faa36c;
    }

    .icon-button {
        padding: 0;
        border: none;
        background-color: transparent;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        cursor: pointer;
        border-radius: 8px;
        transition: background-color 0.15s ease;
    }

    .icon-button svg {
        width: 24px;
        height: 24px;
    }

    .icon-button:hover,
    .icon-button:focus {
        background-color: #dfdad7;
    }

    .modal-container-header {
        padding: 16px 32px;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-container-title {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        line-height: 1;
    }

    .modal-container-title .title-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-container-title svg {
        width: 32px;
        height: 32px;
        color: #750550;
    }

    .modal-container-title h1 {
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0;
    }

    .modal-container-title p {
        font-size: 18px;
        color: #555;
        margin: 0;
    }

    @media (max-width: 600px) {
        .popup{
            font-size: 1.6rem;
            height: 65vh;
            transform: translate(-50%, -50%);
        }
        .modal-container {
            max-width: 95%;
            /* margin: 0 10px; */
        }

        .modal-container-title h1 {
            font-size: 24px;
        }
/*
        .modal-container-title p {
            font-size: 18px;
        }

        section p {
            font-size: 16px;
        } */
    }

    .show-modal {
        display: flex !important;
    }
</style>


<div class="modal privacyPopup popup" id="privacyPopup">
	<article class="modal-container">
		<header class="modal-container-header">
            <div class="modal-container-title">
                <div class="title-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="currentColor" d="M14 9V4H5v16h6.056c.328.417.724.785 1.18 1.085l1.39.915H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.449 2 4.002 2h10.995L21 8v1h-7zm-2 2h9v5.949c0 .99-.501 1.916-1.336 2.465L16.5 21.498l-3.164-2.084A2.953 2.953 0 0 1 12 16.95V11zm2 5.949c0 .316.162.614.436.795l2.064 1.36 2.064-1.36a.954.954 0 0 0 .436-.795V13h-5v3.949z" />
                    </svg>
                    <h1>{{ localize('payment_policy') }}</h1>
                </div>
                <p>{{ localize('terms_of_service_payments_agreement') }} - {{ localize('last_update_on') }}: 01-01-2024</p>
            </div>
		</header>
		<section class="modal-container-body rtf">
            <p>
                {!! localize('policy_terms') !!}
                {!! localize('policy_terms1') !!}
                {!! localize('policy_terms2') !!}
            </p>
        </section>

            <footer class="modal-container-footer">
                <button class="button is-ghost" id="btnCloseModal">{{ localize('decline') }}</button>
                <form action="{{route('stripe.checkout.session')}}" method="POST">@csrf
                    <input type="hidden" id="coupon_no_submit" name="coupon_no_submit">
                    <input type="hidden" id="your_email_coupon_submit" name="your_email_coupon_submit">
                    <button class="button is-primary">{{ localize('accept') }}</button>
                </form>
            </footer>

    </article>
</div>

<script>
    document.getElementById('btnCloseModal').addEventListener('click', function() {
        $('#privacyPopup').hide();
    });
</script>
