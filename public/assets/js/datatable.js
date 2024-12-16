"use strict";
var KTDatatablesExample = function () {
    var table;
    var datatable;
    var initDatatable = function () {
        const tableRows = table.querySelectorAll('tbody tr');
        datatable = $(table).DataTable({
            "info": true,
            'order': [],
            'pageLength': 10,
            "columnDefs": [{
                "targets": -1,
                "orderable": false
            }],
            "language": {
                "info": "Gösterilen _START_  / _END_ Toplam Kayıt",
                "infoEmpty": "Gösterilecek Kayıt Bulunamadı.",
                "infoFiltered": "(_MAX_ Kayıt Arasında Arandı.)"
            },
            responsive:true
            
        });
    }
    var exportButtons = () => {
        const documentTitle = '';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: 'copyHtml5'
                , title: documentTitle
            }
                , {
                extend: 'excelHtml5'
                , title: documentTitle
            }
                , {
                extend: 'csvHtml5'
                , title: documentTitle
            }
                , {
                extend: 'pdfHtml5'
                , title: documentTitle
            }
            ]
        }).container().appendTo($('#kt_datatable_example_buttons'));
        const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();
                const exportValue = e.target.getAttribute('data-kt-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                target.click();
            });
        });
    }
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }
    return {
        init: function () {
            table = document.querySelector('#kt_datatable_example');
            if (!table) {
                return;
            }
            initDatatable();
            exportButtons();
            handleSearchDatatable();
        }
    };
}();
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesExample.init();
});
