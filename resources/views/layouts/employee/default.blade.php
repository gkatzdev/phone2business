<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
?>

@extends('layouts.employee.modal')
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    @include('includes.employee.head')
</head>
<body>
<!-- Header-->
<header id="header" class="light">
    <div class="header-top-row">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="top-welcome hidden-xs hidden-sm">
                        <p><i class="fa fa-phone"></i> 0800-771-5619 &nbsp; <i class="fa fa-envelope"></i> sac@touchcard.com.br</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <div id="account-menu" class="pull-left">
                            <div class="col-xs-1 cart-notification">
                                <span id="cart-notification-text" class="icon-cart-notification"></span><a href="{!! route('getCartItems') !!}"></a>
                            </div>
                            <a href="{!! route('getCartItems') !!}" class="account-menu-title"><i class="fa fa-shopping-cart"></i>&nbsp; Carrinho</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="account-menu" class="pull-left">
                            <a href="cart" class="account-menu-title"><i class="fa fa-user"></i>&nbsp; Minha Conta <i class="fa fa-angle-down"></i> </a>
                            <ul class="list-unstyled account-menu-item">
                                @include('includes.user.top-menu-account')
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <p class="login"> <i class="fa fa-sign-out"></i><a href="{!! route('logout') !!}">Sair</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bg">
        <div class="header-main" id="header-main-fixed">
            <div class="header-main-block1 with-menu">
                <div class="container">
                    <div id="container-fixed">
                        <div class="row">
                            <div class="col-md-12">
                                <nav class="navbar yamm  navbar-main" role="navigation">
                                    <div class="navbar-header">
                                        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                                        <a href="{!! route('dashboard') !!}" class="navbar-brand"><img class="nav-bar-img-logo normal-scroll-logo" src="/user/img/logos/touch-menu-logo.png" alt=""></a>
                                    </div>
                                    <div class="top-icon-block">
                                        <div class="dots-icon pull-right">
                                            <a id="user-dots-menu" href="" class=""  title="Pontos">{!! $user->dots !!}&nbsp;pts</a>
                                        </div>
                                    </div>
                                    @include('includes.user.top-menu')
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /header-main-menu -->
    </div>
</header>
<!-- Index -->
@yield('content')
<section>
    @include('includes.user.modal.modal-transfers-services')
    @include('includes.user.modal.modal-payments-services')
    @include('includes.user.modal.modal-gift-card-services')
    @include('includes.user.modal.modal-recharge-services')
    @include('includes.user.modal.modal-wish-services')
</section>
@include('includes.user.footer')
<script>
    function getCartCount(){
        $.ajax({
            url: "{!! route('getCartCount') !!}",
            success: function(data){
                $('.cart-notification').removeClass('hidden');
                $('#cart-notification-text').text(data);
            },
            fail: function(){
                return false;
            },
            error: function(){
                return "{!! route('404') !!}";
            }
        });
    }

    $(document).ready(function(){
        // Cart notifications
        getCartCount();
    });
</script>