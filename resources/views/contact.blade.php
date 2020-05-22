@extends('layouts.master-navbar')

@section('title', 'Contacto')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/contact-styles.css') }}">
@endsection

@section('content')
    <div class="contactContainer">
        <div class="contactText" id="contactTitle">
            <h1>Contacta con nosotros por los siguientes canales</h1>
        </div>
        <div class="contactText" id="contacts1">
            <p>Correo: <a href="mailto:contacto@partnerme.com">contacto@partnerme.com</a><br>
               Twitter: <a href="twitter.com/supportpartnerme">@supportPartnerMe</a></p>
        </div>
        <div class="contactText" id="contacts2">
            <p>Teléfono: <a href="tel:+34000000000">+34 000 00 00 00</a><br>
               Fax: <a href="fax:+348.555.1234567">+348.555.1234567</a></p>
        </div>
    </div>
@endsection