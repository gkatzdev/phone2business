/*
 *
 *   INSPINIA - Responsive Admin Theme
 *   version 2.4
 *
 */


$(document).ready(function () {

    function checkCpf(docNumber){
        var isValid = false;
        docNumber = docNumber.replace('-', '');
        docNumber = docNumber.replace('.', '');
        docNumber = docNumber.replace('.', '');

        $.ajax({
            method: 'get',
            url: 'user/checkcpf/'+docNumber,
            dataType: "json",
            async: false,
            success: function(data){
                isValid = data;
            },
            error: function(){
                //window.location.href = '{!! route('500') !!}';
            },
            fail: function(data){
                isValid = data;
            }
        });
        if(isValid){
            isValid = false;
        } else {
            isValid = true;
        }
        return isValid;
    }

    function checkCard(cardNumber){
        var isValid = false;

        $.ajax({
            method: 'get',
            url: 'user/checkcard/'+cardNumber,
            dataType: "json",
            async: false,
            success: function(data){
                isValid = data;
            },
            error: function(){
                //window.location.href = '{!! route('500') !!}';
            },
            fail: function(data){
                isValid = data;
            }
        });
        if(isValid){
            isValid = false;
        } else {
            isValid = true;
        }
        return isValid;
    }

    // Full height of sidebar
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

        var navbarHeigh = $('nav.navbar-default').height();
        var wrapperHeigh = $('#page-wrapper').height();

        if(navbarHeigh > wrapperHeigh){
            $('#page-wrapper').css("min-height", navbarHeigh + "px");
        }

        if(navbarHeigh < wrapperHeigh){
            $('#page-wrapper').css("min-height", $(window).height()  + "px");
        }

        if ($('body').hasClass('fixed-nav')) {
            if (navbarHeigh > wrapperHeigh) {
                $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
            } else {
                $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
            }
        }

    }


    $(window).bind("load resize scroll", function() {
        if(!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    // Move right sidebar top after scroll
    $(window).scroll(function(){
        if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav') ) {
            $('#right-sidebar').addClass('sidebar-top');
        } else {
            $('#right-sidebar').removeClass('sidebar-top');
        }
    });

    setTimeout(function(){
        fix_height();
    })

    // MetsiMenu
    $('#side-menu').metisMenu();

    // Collapse ibox function
    $('.collapse-link').click(function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        var content = ibox.find('div.ibox-content');
        content.slideToggle(200);
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        ibox.toggleClass('').toggleClass('border-bottom');
        setTimeout(function () {
            ibox.resize();
            ibox.find('[id^=map-]').resize();
        }, 50);
    });

    // Close ibox function
    $('.close-link').click(function () {
        var content = $(this).closest('div.ibox');
        content.remove();
    });

    // Fullscreen ibox function
    $('.fullscreen-link').click(function () {
        var ibox = $(this).closest('div.ibox');
        var button = $(this).find('i');
        $('body').toggleClass('fullscreen-ibox-mode');
        button.toggleClass('fa-expand').toggleClass('fa-compress');
        ibox.toggleClass('fullscreen');
        setTimeout(function () {
            $(window).trigger('resize');
        }, 100);
    });

    // Close menu in canvas mode
    $('.close-canvas-menu').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // Run menu of canvas
    $('body.canvas-menu .sidebar-collapse').slimScroll({
        height: '100%',
        railOpacity: 0.9
    });

    // Open close right sidebar
    $('.right-sidebar-toggle').click(function () {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    // Initialize slimscroll for right sidebar
    $('.sidebar-container').slimScroll({
        height: '100%',
        railOpacity: 0.4,
        wheelStep: 10
    });

    // Small todo handler
    $('.check-link').click(function () {
        var button = $(this).find('i');
        var label = $(this).next('span');
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        label.toggleClass('todo-completed');
        return false;
    });


    // Minimalize menu
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // Move modal to body
    // Fix Bootstrap backdrop issu with animation.css
    $('.modal').appendTo("body");

    if ($.support.pjax) {
        $.pjax.defaults.timeout = 10; // time in milliseconds
    }

    $("[data-toggle=popover]")
        .popover();

    // Add slimscroll to element
    $('.full-height-scroll').slimscroll({
        height: '100%'
    })

    if (localStorageSupport) {

        var collapse = localStorage.getItem("collapse_menu");
        var fixedsidebar = localStorage.getItem("fixedsidebar");
        var fixednavbar = localStorage.getItem("fixednavbar");
        var boxedlayout = localStorage.getItem("boxedlayout");
        var fixedfooter = localStorage.getItem("fixedfooter");

        var body = $('body');

        if (fixedsidebar == 'on') {
            body.addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        }

        if (collapse == 'on') {
            if (body.hasClass('fixed-sidebar')) {
                if (!body.hasClass('body-small')) {
                    body.addClass('mini-navbar');
                }
            } else {
                if (!body.hasClass('body-small')) {
                    body.addClass('mini-navbar');
                }

            }
        }

        if (fixednavbar == 'on') {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            body.addClass('fixed-nav');
        }

        if (boxedlayout == 'on') {
            body.addClass('boxed-layout');
        }

        if (fixedfooter == 'on') {
            $(".footer").addClass('fixed');
        }
    }

    $.validator.addMethod("cpf", function(value) {
        // Removing special characters from value
        value = value.replace(/([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "");

        // Checking value to have 11 digits only
        if (value.length !== 11) {
            return false;
        }

        var sum = 0,
            firstCN, secondCN, checkResult, i;

        firstCN = parseInt(value.substring(9, 10), 10);
        secondCN = parseInt(value.substring(10, 11), 10);

        checkResult = function(sum, cn) {
            var result = (sum * 10) % 11;
            if ((result === 10) || (result === 11)) {result = 0;}
            return (result === cn);
        };

        // Checking for dump data
        if (value === "" ||
            value === "00000000000" ||
            value === "11111111111" ||
            value === "22222222222" ||
            value === "33333333333" ||
            value === "44444444444" ||
            value === "55555555555" ||
            value === "66666666666" ||
            value === "77777777777" ||
            value === "88888888888" ||
            value === "99999999999"
        ) {
            return false;
        }

        // Step 1 - using first Check Number:
        for ( i = 1; i <= 9; i++ ) {
            sum = sum + parseInt(value.substring(i - 1, i), 10) * (11 - i);
        }

        // If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
        if ( checkResult(sum, firstCN) ) {
            sum = 0;
            for ( i = 1; i <= 10; i++ ) {
                sum = sum + parseInt(value.substring(i - 1, i), 10) * (12 - i);
            }
            return checkResult(sum, secondCN);
        }
        return false;

    }, "Informe um CPF válido");

    $.validator.addMethod("extension", function(value, element, param) {
        return param = "string" == typeof param ? param.replace(/,/g,"|") : "png|jpe?g|gif",
        this.optional(element) || value.match(new RegExp("\\.("+param+")$","i"))
    }, "Extensão inválida.");

    $.validator.addMethod("checkCpf", function(value) {
        if(value == ''){
            return true;
        } else {
            return checkCpf(value);
        }

    }, "CPF já cadastrado");

    $.validator.addMethod("checkCard", function(value) {
        if(value == ''){
            return true;
        } else {
            return checkCard(value);
        }
    }, "Cartão já cadastrado");

    $.validator.addMethod("checkSequencePass", function(value) {
        var len = value.length;
        var isValid = false;

        if(!len || isNaN(value) || value == 0){
            return false;
        }

        for(var i = 1; i < len; i++ )
        {
            if(parseInt(value[0])+i != parseInt(value[i]) && (parseInt(value[0]) != parseInt(value[i]))){
                isValid = true;
            }
        }
        return isValid;
    }, "Para sua segurança, a senha não deve ser sequencial");

    $.validator.addMethod("cnpj", function(value) {
        var str = value.replace('.','');
        str = str.replace('.','');
        str = str.replace('.','');
        str = str.replace('-','');
        str = str.replace('/','');
        var cnpj = str;
        var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
        digitos_iguais = 1;
        if (cnpj.length < 14 && cnpj.length < 15)
            return false;
        for (i = 0; i < cnpj.length - 1; i++)
            if (cnpj.charAt(i) != cnpj.charAt(i + 1))
            {
                digitos_iguais = 0;
                break;
            }
        if (!digitos_iguais)
        {
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0,tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--)
            {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--)
            {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
            return true;
        }
        else
            return false;

    }, "Informe um CNPJ válido");

});

// Minimalize menu when screen is less than 768px
$(function() {
    $(window).bind("load resize", function() {
        if ($(this).width() < 769) {
            $('body').addClass('body-small')
        } else {
            $('body').removeClass('body-small')
        }
    })
})

// check if browser support HTML5 local storage
function localStorageSupport() {
    return (('localStorage' in window) && window['localStorage'] !== null)
}

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
        // Hide menu in order to smoothly turn on when maximize menu
        $('#side-menu').hide();
        // For smoothly turn on menu
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 200);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(400);
            }, 100);
    } else {
        // Remove all inline style from jquery fadeIn function to reset menu state
        $('#side-menu').removeAttr('style');
    }
}
