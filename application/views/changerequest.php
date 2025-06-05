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
                            <span>Approve Change List</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
            <div class="card-body p-2">
            
                    <div class="card-body p-0 p-2">
                        <div class="row">     
                            <div class="col-12">
                            <div class="scrollbar pb-3" id="style-2">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
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
                                            <th>Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
</div>


<div class="modal fade" id="pospondModal" tabindex="-1" role="dialog" aria-labelledby="dateInputModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateInputModalLabel">Pospond</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('ChangeRequest/pospondRecord'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="modalDateId" name="idtbl_job_list">
                    <div class="form-group">
                        <label for="inputDate" class="font-weight-bold">Select Date</label>
                        <input type="date" class="form-control" name="inputDate" id="inputDate" required>
                    </div>
                    <div class="form-group">
                        <label for="reason" class="font-weight-bold">Reason</label>
                        <input type="text" class="form-control" name="reason" id="reason" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cancel Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('ChangeRequest/CancelRecord'); ?>" method="post" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="modalIdTbljoblistField" name="idtbl_job_list">
                    <div class="form-group">
                        <label for="reson_type" class="font-weight-bold">Reject Reason Type</label>
                        <select class="form-control form-control-sm" name="reson_type" id="reson_type" required>
                              <option value="">Select</option>
                                    <?php foreach ($RejectReason->result() as $reason) { ?>
                                    <option value="<?php echo $reason->idtbl_reason_type; ?>">
                                    <?php echo $reason->reason_type;?></option>
                                    <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">comment</label>
                        <input type="text" class="form-control" name="comment" id="comment" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
                <input type="hidden" name="recordOption" id="recordOption" value="1">
                <input type="hidden" name="recordID" id="recordID" value="">
            </form>
        </div>
    </div>

<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        var addcheck='<?php echo $addcheck; ?>';
        var editcheck='<?php echo $editcheck; ?>';
        var statuscheck='<?php echo $statuscheck; ?>';
        var deletecheck='<?php echo $deletecheck; ?>';

       var table = $('#dataTable').DataTable({
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
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    filename: 'Aprrove Change Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                    customize: function (doc) {
                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'landscape';
                        
                        doc.content.splice(0, 0, {
                            text: 'MediHelp Hospital',
                            fontSize: 18,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
                        });

                        doc.content.splice(1, 0, {
                            text: 'Aprrove Change Information',
                            fontSize: 12,
                            bold: true,
                            alignment: 'left',
                            margin: [0, 0, 0, 10]
                        });

                        var table = doc.content[doc.content.length - 1].table;
                        if (table && table.body && table.body.length > 0) {
                            var colCount = table.body[0].length;
                            table.widths = Array(colCount).fill('*');
                        }

                        doc.content[doc.content.length - 1].layout = {
                            hLineWidth: function () { return 0.5; },
                            vLineWidth: function () { return 0.5; },
                            hLineColor: function () { return '#aaa'; },
                            vLineColor: function () { return '#aaa'; }
                        };

                        doc.styles.tableHeader = {
                            fillColor: '#4e73df',
                            fontSize: 13,
                            color: 'white',
                            alignment: 'center',
                            bold: true
                        };
                        doc.styles.tableBodyEven = {
                            alignment: 'center'
                        };
                        doc.styles.tableBodyOdd = {
                            alignment: 'center'
                        };
                 }
                }
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/approvelist.php",
                type: "POST", 
                data: {
                    userid: <?php echo json_encode($_SESSION['userid']); ?>
                }
            },
            "order": [[ 0, "desc" ]],
            "columns": [
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
                { "data": "actions"},
                
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button='';
                        var request = full['edit_request'];
                        var confirm = full['confirmation'];
                        var editrequest = full['edit_request'];

                        // button += '<button class="btn btn-primary btn-sm btnEdit mr-1 ';
                        // if (!((confirm == 2) || (editcheck == 1 && editrequest == 2))) {
                        //     button += 'd-none';
                        // }
                        // button += '" data-id="'+full['idtbl_job_list']+'"><i class="fa fa-pen"></i></button>';


                        button += '<a href="<?php echo base_url() ?>ChangeRequest/Editrequest/' + full['idtbl_job_list'] + '/1" onclick="return confirm_request()" target="_self" class="btn btn-primary btn-sm mr-1 '
                        if (confirm != 1 || editrequest != 0) {
                            button += 'd-none';
                        }
                        button += '" id="' + full['idtbl_job_list'] + '"><i class="fa fa-paper-plane"></i></a>';
                        
                        button += '<button type="button" class="btn btn-info btn-sm mr-1" data-toggle="modal" data-target="#pospondModal" data-idtbl_job_list="' + full['idtbl_job_list'] + '"><i class="fas fa-pause"></i></button>';

                            if (full['confirmation'] == 1 || full['confirmation'] == 2) {
                                button += '<button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#staticBackdrop" data-idtbl_job_list="' + full['idtbl_job_list'] + '"><i class="fas fa-times"></i></button>';
                            } else if (full['confirmation'] == 3) {
                                button += '<button type="button" class="btn btn-danger btn-sm mr-1"><i class="fas fa-times"></i></button>';
                            }

                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#dataTable tbody').on('click', '.btnEdit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?php echo base_url() ?>Job/Jobedit',
                type: 'POST',
                data: { recordID: id },
                success: function(response) {
                    var obj = JSON.parse(response);
                    $('#recordID').val(obj.id);
                    $('#month').val(obj.month);
                    $('#date').val(obj.start_date);
                    $('#start_time').val(obj.start_time);
                    $('#end_time').val(obj.end_time);
                    $('#type').val(obj.itenary_type);
                    $('#category').val(obj.itenary_category);
                    $('#group').val(obj.group);
                    $('#task').val(obj.task);
                    $('#itenary').val(obj.itenary);
                    $('#location').val(obj.location);
                    $('#meet_location').val(obj.meet_location);

                    $('#recordOption').val('2');
                    $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');

                    $('#editModal').modal('show');
                }
            });
        });


        // $('#yearSelect,#monthSelect, #bdm').change(function() {
        //     table.draw(); 
        // });
    });
    $('#staticBackdrop').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idtbl_job_list = button.data('idtbl_job_list');
    $('#modalIdTbljoblistField').val(idtbl_job_list);
});

    $('#pospondModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var idtbl_job_list = button.data('idtbl_job_list');
        $('#modalDateId').val(idtbl_job_list);
    });





    function deactive_confirm() {
        return confirm("Are you sure want to deconfirm this?");
    }

    function active_confirm() {
        return confirm("Are you sure you want to Confirm this?");
    }

    function delete_confirm() {
        return confirm("Are you sure you want to remove this?");
    }
    function cancel_confirm(){
        return confirm("Are you sure want to cancel this?");
    }
</script>
<?php include "include/footer.php"; ?>
