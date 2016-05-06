<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    @include('includes.head')
</head>
<body class="Listagem">
<header class="col-sm-12 col-xs-12 Topo_logo">
    <div class="col-sm-12 col-xs-12 barra_azul_topo_1">
        <img class="logo_phone2b" src="/img/logo.png" alt="">
    </div>
</header>
<div class="col-sm-12 col-xs-12 Barra_menu">
    <div class="col-sm-12 col-xs-12 barra_azul_topo">
        <div class="Menu">
            <div class="Menu_Telefonia">
                <img class="ico_phone" src="/img/ico-phone.png" alt="">
                <a href="{!! route('company') !!}" class="link-empresas">
                    Empresas
                </a>
            </div>
            <div class="Menu_Usuarios">
                <img class="ico_users" src="/img/ico-user.png" alt="">
                <a href="{!! route('employee') !!}" class="link-colaboradores">
                    Colaboradores
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid employees-list">
    @yield('content')
</div>
<section>
</section>
@include('includes.footer')