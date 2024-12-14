<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LegalPDF - PDF</title>
    <style>
        *{margin:0;padding:0;-webkit-box-sizing:border-box;box-sizing:border-box;}
        body{font-size:62.5%;padding:4rem 3rem;max-width:100%;font-family:DejaVu Sans,sans-serif;unicode-bidi: bidi-override !important;direction: unset !important;}
        .left-align{width:25%}
        .right-align{width:75%}
        .float-left{float:left}
        .clear-both{clear:both}
        .pdf-logo-holder{width:15rem;height:auto;overflow:hidden;margin:0 auto}
        .pdf-logo-holder>img{width:100%;height:auto;-o-object-fit:contain;object-fit:contain}
        header.pdf-header{border-bottom:.15rem solid #7a7a7a}
        header.pdf-header h3.logo-slogan{font-size:1.5rem;line-height:2.4rem;color:#999903;text-align:center;font-weight:bold;margin:1rem 0}
        header.pdf-header h3.title{font-size:2.2rem;line-height:2.8rem;color:#999903;text-align:left;font-weight:bold;margin-left:1rem; margin-bottom: 0}
        header.pdf-header p.paragraph{text-align:left;color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:3rem;margin-left:1rem}
        section.pdf-invoice .order-details-card{margin-bottom:1.5rem}
        section.pdf-invoice .order-details-card h3.card-title{font-size:2rem;line-height:2.6rem;color:#7a7a7a;text-align:left;font-weight:bold}
        section.pdf-invoice .order-details-card .card-items{padding:1rem 0}
        section.pdf-invoice .order-details-card .card-items .item{border-bottom:.15rem dashed #7a7a7a;padding:1rem 0; display: flex}
        section.pdf-invoice .order-details-card .card-items .item {text-align:left;color:#7a7a7a;font-size:1.6rem;font-weight:400;line-height:2.3rem}
        section.pdf-invoice .order-details-card .card-items .item span {font-weight:bold}
        section.pdf-invoice .additional-card{margin:1.5rem 0}
        section.pdf-invoice .additional-card h3.card-title{font-size:1.8rem;line-height:2.6rem;color:#7a7a7a;text-align:center;font-weight:bold;margin-bottom:1.5rem}
        section.pdf-invoice .additional-card .card-box{max-width:90%;border:.15rem solid #7a7a7a;padding:1rem;margin:0 auto}
        section.pdf-invoice .additional-card .card-box .card-p{width:45%}
        section.pdf-invoice .additional-card .card-box .card-c{width:10%}
        section.pdf-invoice .additional-card .card-box h3.title-1{font-size:1.7rem;line-height:2.4rem;color:#7a7a7a;font-weight:bold}
        .text-center{text-align:center}
        .text-right{text-align:right}
        section.pdf-invoice p.notes{text-align:center;color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}
        section.pdf-message-collection .message-counter-head{border-top:.15rem solid #7a7a7a;padding-top:1rem;margin-top:2.5rem}
        section.pdf-message-collection .message-counter-head p.text-1{text-align:left;color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}
        section.pdf-message-collection .message-counter-head p.text-2{text-align:right;color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}
        section.pdf-message-collection .message-body h3.subjects{font-size:1.8rem;line-height:2.4rem;color:#7a7a7a}
        section.pdf-message-collection .message-body h3.sub-subjects{font-size:1.5rem;line-height:2rem;color:#7a7a7a}
        section.pdf-message-collection .message-body .content{color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}
        .pdf-page-footer{width:100%}
        .pdf-page-footer .title{text-align:center}
        footer.pdf-page-footer h3.title{font-size:1.6rem;line-height:2.3rem;color:#7a7a7a;text-align:center;font-weight:bold}
        .pdf-page-header{width:100%;padding: 0;margin:1rem auto;}
        .pdf-page-header .pdf-repeat{width:33.33%}
        header.pdf-page-header h3.title-1{font-size:1.5rem;line-height:2.4rem;color:#999903;text-align:left;font-weight:bold}
        header.pdf-page-header h3.title-2{font-size:1.5rem;line-height:2.4rem;color:#7a7a7a;text-align:center;font-weight:bold}
        header.pdf-page-header h3.title-3{font-size:1.5rem;line-height:2.4rem;color:#999903;text-align:right;font-weight:bold}
        .message-counter-head{width:100%}
        .message-counter-head .ram{width:50%}
    </style>
</head>

<body>
    <header class="pdf-header">
        <div class="h-wrapper">
            <div class="left-align float-left">
                <div class="pdf-logo-holder">
                    {{-- <img src="{{ asset('web/assets/img/corry-builder-1200x1200.png') }}" alt="logo"> --}}
                </div>
                <h3 class="logo-slogan">FAST & SECURED</h3>
            </div>
            <div class="right-align float-left">
                <h3 class="title">Emails and Chats Extractor</h3>
                <div class="p-wrapper">
                    <p class="paragraph">
                        This is a formal document ready to be used, created by LegalPDF.
                        The document contains all the requested information by the client.
                    </p>
                    <p class="paragraph">
                        For more information, please visit legalpdf.co otherwise contact us
                        on info@legalpdf.co or +44 208 5053 311
                    </p>
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
    </header>

    <section class="pdf-invoice">
        <div class="order-details-card">
            <h3 class="card-title">Order details</h3>
            <div class="card-items">
                <div class="item">
                    Ordered by
                    <span>Niweshs | niweshs@gmail.com</span>
                </div>
                <div class="item">
                    Date:
                    <span>04-1-2023 at 18:05</span>
                </div>
                <div class="item">
                    Platform:
                    <span>Microsoft Outlook</span>
                </div>
                <div class="item">
                    Number of emails:
                    <span>11</span>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <h3 class="card-title">The following document contains emails between</h3>
            <div class="card-box">
                <div class="card-p float-left">
                    <h3 class="title-1">niweshs@gmail.com</h3>
                </div>
                <div class="card-c float-left">
                    <h3 class="title-1 text-center">and</h3>
                </div>
                <div class="card-p float-left">
                    <h3 class="title-1 text-right">ewcanwin@gmail.com</h3>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        <p class="notes">* The following emails are in order from newest to oldest</p>
    </section>
</body>

</html>
