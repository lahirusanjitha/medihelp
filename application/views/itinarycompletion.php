<?php 
include "include/header.php";  
include "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include "include/menubar.php"; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header page-header-light bg-white shadow">
                <div class="container-fluid">
                    <div class="page-header-content py-3">
                        <h1 class="page-header-title font-weight-light">
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            <span>Completion List</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Itenary Category</th>
                                            <th>Itenary Sub Category</th>
                                            <th>Itenary Group</th>
                                            <th>Task</th>
                                            <th>Itenary</th>
                                            <th>Meet Location</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                            <button id="completebuton" class="btn btn-primary btn-sm">Mark As Complete</button>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Feed back</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?php echo base_url('ItinaryCompletion/Insertfeedback'); ?>" method="post" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="modaltblJobListField" name="idtbl_job_list">

                    <div class="form-group">
                        <label for="feedback" class="font-weight-bold">Comment</label>
                        <input type="text" class="form-control" name="feedback" id="feedback" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <input type="hidden" name="recordOption" id="recordOption" value="1">
                <input type="hidden" name="recordID" id="recordID" value="">
            </form>
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        var addcheck='<?php echo $addcheck; ?>';
        var editcheck='<?php echo $editcheck; ?>';
        var statuscheck='<?php echo $statuscheck; ?>';
        var deletecheck='<?php echo $deletecheck; ?>';

        $('#dataTable').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            "buttons": [
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Job Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Job Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Job Information',
                    className: 'btn btn-primary btn-sm', 
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function ( win ) {
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }, 
                },
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/completionlist.php",
                type: "POST", // you can use GET
                // data: function(d) {}
            },
            "order": [[ 2, "desc" ]],
            "columns": [
                {
                "data": null,
                "orderable": false,
                "searchable": false,
                "render": function(data, type, row) {
                    return '<input type="checkbox" class="rowCheckbox" value="' + row.idtbl_job_list + '">';
                }
                },
                {  
                "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                } 
                 },      
                { "data": "start_date" },    
                { "data": "start_time" }, 
                { "data": "end_time"},
                { "data": "itenary_type"},
                { "data": "itenary_category" },                    
                { "data": "group" },
                { "data": "task"},
                { "data": "itenary"},
                { "data": "location"},
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button = '';
                        
                        button += '<button type="button" class="btn btn-success btn-sm mr-1" data-toggle="modal" data-target="#staticBackdrop" data-idtbl_job_list="' + full['idtbl_job_list'] + '"><i class="far fa-comment"></i></button>';

                        return button;
                    }

                }
                
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#completebuton').on('click', function () {
            let selectedIds = [];

            $('.rowCheckbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                alert('Please select at least one row to send for Complete.');
                return;
            }

            $.ajax({
                url: "<?php echo site_url('ItinaryCompletion/ItinaryCmpletionStatus'); ?>",
                type: "POST",
                data: { ids: selectedIds },
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === 'success') {
                        alert('Itinary Mark As Completed Succesfully.');
                        $('#dataTable').DataTable().ajax.reload();
                    } else {
                        alert('Failed to update data: ' + result.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });
    });

    $('#dataTable').on('change', '#selectAll', function() {
    var checked = $(this).is(':checked');
    $('.rowCheckbox').prop('checked', checked);
    });
    $('#dataTable').on('draw.dt', function() {
        $('#selectAll').prop('checked', false); 
    });
    function complete_confirm() {
        return confirm("Are you sure you want to complete this?");
    }
    $('#staticBackdrop').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    var idtbl_job_list = button.data('idtbl_job_list');

    $('#modaltblJobListField').val(idtbl_job_list);
});

</script>
<?php include "include/footer.php"; ?>
