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
            <div class="row align-items-end"> 
            <div class="col-md-4 col-lg-3">
                    <label for="yearSelect">Select Year</label>
                            <select id="yearSelect" class="form-control form-control-sm">
                                <option value="">All Years</option>
                                    <?php
                                        $currentYear = date("Y");
                                        for ($i = $currentYear; $i >= $currentYear - 5; $i--) { 
                                        echo "<option value='$i'>$i</option>";
                                        }
                                ?>
                    </select>
                </div>

                <div class="col-md-6 col-lg-3">
                    <label for="monthSelect">Select Month</label>
                    <select id="monthSelect" class="form-control form-control-sm">
                        <option value="">All Months</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>

                <div class="col-md-6 col-lg-3">
                    <label for="bdm">Select BDM</label>
                    <select id="bdm" class="form-control form-control-sm">
                        <?php foreach ($user->result() as $users) { ?>
                            <option value="<?php echo $users->idtbl_res_user; ?>">
                                <?php echo $users->name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
                    <div class="card-body p-0 p-2">
                        <div class="row">     
                            <div class="col-12">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
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
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Approval Change List', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Approval Change List', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Approval Change List',
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
                url: "<?php echo base_url() ?>scripts/approvelist.php",
                type: "POST", 
                "data": function(d) {
                d.bdm = $('#bdm').val();   
                d.month = $('#monthSelect').val(); 
                d.year = $('#yearSelect').val(); 
            }
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                                        
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
                        var button='';
                        var request = full['edit_request'];
                        button+='<a href="<?php echo base_url() ?>ChangeRequest/Editrequest/'+full['idtbl_job_list']+'/2" onclick="return confirm_request()" target="_self" class="btn btn-primary btn-sm mr-1 ';
                            if(statuscheck!=1 || request!=1)
                            {
                                button+='d-none';
                            }
                                button+='"><i class="fa fa-check""></i></a>';
                        
                        button += '<button type="button" class="btn btn-info btn-sm mr-1" data-toggle="modal" data-target="#pospondModal" data-idtbl_job_list="' + full['idtbl_job_list'] + '"><i class="fas fa-pause"></i></button>';

                            if (full['confirmation'] == 1 || full['confirmation'] == 2) {
                                button += '<button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#staticBackdrop" data-idtbl_job_list="' + full['idtbl_job_list'] + '"><i class="fas fa-times"></i></button>';
                            } else if (full['confirmation'] == 3) {
                                button += '<button type="button" class="btn btn-danger btn-sm mr-1"><i class="fas fa-times"></i></button>';
                            }
                        button+='<a href="<?php echo base_url() ?>ChangeRequest/Jobstatus/'+full['idtbl_job_list']+'/3" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm ';
                        if(deletecheck!=1){
                            button+='d-none';
                        }
                        button+='"><i class="fas fa-trash-alt"></i></a>';
                        
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#dataTable tbody').on('click', '.btnEdit', function() {
            var r = confirm("Are you sure, You want to Edit this ? ");
            if (r == true) {
                var id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    data: {
                        recordID: id
                    },
                    url: '<?php echo base_url() ?>Job/Jobedit',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#start_date').val(obj.start_date);
                        $('#end_date').val(obj.end_date); 
                        $('#category').val(obj.itenary_category);
                        $('#sub_category').val(obj.sub_category);                        
                        $('#group').val(obj.group);
                        $('#task').val(obj.task);  
                        $('#location').val(obj.location);                     

                        $('#recordOption').val('2');
                        $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
                    }
                });
            }
        });
        $('#yearSelect,#monthSelect, #bdm').change(function() {
            table.draw(); 
        });
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
