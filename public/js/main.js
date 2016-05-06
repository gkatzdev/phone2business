/**
 * Created by Gabriela Katz
 * Date: 05/05/2016
 */
jQuery(document).ready(function ($) {
    oTable = $('.table').DataTable({
        dom: 'tipr',
        language:{
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
        }
    });
    $('.input_Filtrar').keyup(function(){
        oTable.search($(this).val()).draw() ;
    })
});

