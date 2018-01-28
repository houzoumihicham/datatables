var TableDatatablesAjax = function () {

    var grid = new Datatable();

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var intiDatatable = function () {

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Recherche en cours...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "iDisplayLength": 20, // default record count per page
                "ajax": {
                    "url": "/products/info", // ajax source
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                "columnDefs": [ {
                    "targets": [1,3],
                    "orderable": false
                } ],

                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/French.json"
                },



            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('change', '.table-group-action-submit', function (e) {
            alert('test t ytdsgvsdfsdtgvfusdtv');
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                $.bootstrapGrowl("Please select an action", {
                    ele: 'body',
                    type: 'danger',
                    offset: {from: 'top', amount: 20},
                    align: 'right',
                    width: 250,
                    delay: 4000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                });

            } else if (grid.getSelectedRowsCount() === 0) {
                $.bootstrapGrowl("No record selected", {
                    ele: 'body',
                    type: 'danger',
                    offset: {from: 'top', amount: 20},
                    align: 'right',
                    width: 250,
                    delay: 4000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                });
            }
        });

        //grid.setAjaxParam("customActionType", "group_action");
        //grid.getDataTable().ajax.reload();
        // grid.clearAjaxParams();
    }

    var deleteProducts= function(){
        $("table").delegate(".remove_model","click", function() {
            var id=$(this).data("id");
            swal({
                title: 'Êtes-vous sûr?',
                text: "Vous voulez vraiment supprimer!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Supprimer!',
                cancelButtonText: 'Annulé!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    url: "/products/"+id+"/delete",

                    type: "get",
                    success: function(response) {

                        if ($.trim(response) == "true") {

                            swal(
                                'Supprimer!',
                                'bien supprimer',
                                'success'
                            ).then(function () {

                                $('#datatable_ajax').DataTable().draw(false)
                            });


                        } else {
                            swal(
                                'No pas supprimer',
                                'il a une erreur',
                                'error'
                            )
                        }
                    }

                });
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay',
                // 'close', and 'timer'
                if (dismiss === 'cancel') {
                    swal(
                        'Annulé',
                        'Operation annulée :)',
                        'error'
                    )
                }
            })
        } );

    };


    return {

        //main function to initiate the module
        init: function () {

            intiDatatable();
            deleteProducts();


        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesAjax.init();
});