/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$(function () {
    $("input").on('keyup', function () {
        var str = $(this).val();
        var s = str.search("<script>");
        var e = str.search("</script>");

        if (s > -1 || e > -1) {
            $(this).val("")
        }

    });
    $("textarea").on('keyup', function () {
        var str = $(this).val();
        var s = str.search("<script>");
        var e = str.search("</script>");

        if (s > -1 || e > -1) {
            $(this).val("")
        }

    });
    var dt = $('#datatable');
  
    if (dt) {

        $('#datatable').DataTable({

            "bDestroy": true,
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            buttons: {
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-sm'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-sm'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-sm'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm'
                    }
                ]
            },
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
             
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    }
    var ss = $(".select2-dd").select2();
    var st = $(".select2-tag").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
    var ctx = document.getElementById("myChart2").getContext('2d');
    if (ctx != null) {
        const commission = JSON.parse($('#myChart2').attr('data-commission'))
        const labels = JSON.parse($('#myChart2').attr('data-month'))
        const earning = JSON.parse($('#myChart2').attr('data-earning'))
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Instructor Earning',
                    data: earning,
                    borderWidth: 2,
                    backgroundColor: 'rgba(63,82,227,.8)',
                    borderColor: 'transparent',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }, {
                    label: 'Commission',
                    data: commission,
                    borderWidth: 2,
                    backgroundColor: 'rgba(254,86,83,.7)',
                    borderColor: 'rgba(254,86,83,.7)',

                    borderWidth: 0,
                    pointBackgroundColor: '#999',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    }

});
