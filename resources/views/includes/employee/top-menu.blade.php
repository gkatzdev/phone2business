<?php
/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
?>
<div id="navbar-collapse-1" class="navbar-collapse collapse ">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{!! route('dashboard') !!}">Home</a></li>
        <li class="yamm-fw dropdown fadeInUp animated"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Produtos <i class="fa fa-caret-right fa-rotate-45"></i></a>
            <ul class="dropdown-menu list-unstyled  fadeInUp  animated products-dropdown-menu">
                <li>
                    <div class="yamm-content">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="header-menu">
                                    <h4>Departamentos</h4>
                                </div>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{!! route('getcatalog', 0) !!}"><i class="fa fa-angle-right"></i>
                                                <strong>Todas as categorias</strong>
                                        </a>
                                    </li>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{!! route('getcatalog', $category->id) !!}"><i class="fa fa-angle-right"></i> {!! $category->name !!} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li class="yamm-fw dropdown fadeInUp animated"><a href="" data-toggle="dropdown" class="dropdown-toggle">Serviços <i class="fa fa-caret-right fa-rotate-45"></i></a>
            <ul class="dropdown-menu list-unstyled  fadeInUp animated services-dropdown-menu">
                <li>
                    <div class="yamm-content">
                        <div class="row">
                            @foreach($modules as $module)
                                <!-- hide products and wishes module -->
                                @if($module->name != 'products' && $module->name != 'wish')
                                    <!-- index Voucher Gift -->
                                    @if($module->id == 5)
                                        <div class="header-menu">
                                            <h4><a href="{!! route('voucher-gift') !!}"><i class="fa fa-{!! $module->name !!} top-fa-{!! $module->name !!}"></i> {!! $module->title !!}</a></h4>
                                        </div>
                                    @elseif($module->id == 6)
                                        <div class="header-menu">
                                            <h4><a href="{!! route('service.recharge') !!}"><i class="fa fa-{!! $module->name !!} top-fa-{!! $module->name !!}"></i> {!! $module->title !!}</a></h4>
                                        </div>
                                    @else
                                        <div class="header-menu">
                                            <h4><a data-toggle="modal" class="link-{!! $module->name !!}" data-target="#modal-{!! $module->name !!}-services"><i class="fa fa-{!! $module->name !!} top-fa-{!! $module->name !!}"></i> {!! $module->title !!}</a></h4>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li><a data-toggle="modal" class="link-wish" data-target="#modal-wish-services">Meu Desejo</a></li>
        {{--<li><a href="{!! route('404') !!}">Contato</a></li>--}}
    </ul>
</div>