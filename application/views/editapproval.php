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
                            <span>Edit Request Approval </span>
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
                                            <th>Itinerary Category</th>
                                            <!-- <th>Itinerary Sub Category</th> -->
                                            <th>Itinerary Status</th>
                                            <th>Task</th>
                                            <th>Itinerary</th>
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
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
</div>
<!-- postponed request approve modal -->
<div class="modal fade" id="postponedModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Postponed Request Details</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Postponed Date</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Reason</th>
            </tr>
          </thead>
          <tbody id="postponed-data">
            <!-- AJAX data here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="postponed-job-id" name="postponed-job-id">
        <button type="button" id="approve-postponed" class="btn btn-primary">Approve Postponed</button>
        <button type="button" id="reject-postponed" class="btn btn-danger">Reject Postponed</button>
      </div>
    </div>
  </div>
</div>

<!-- cancel approve modal -->

<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cancel Request Details</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Requested Date</th>
              <th>Reason Type</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody id="cancel-data">
            <!-- AJAX data here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="cancel-job-id" name="cancel-job-id">
        <button type="button" id="approve-cancel" class="btn btn-primary">Approve Cancel</button>
        <button type="button" id="reject-cancel" class="btn btn-danger">Reject Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- edit approval modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Request Details</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Requested Date</th>
              <th>Reason Type</th>
              <th>Comment</th>
            </tr>
          </thead>
          <tbody id="edit-data">
            <!-- AJAX data here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="edit-job-id" name="edit-job-id">
        <button type="button" id="approve-edit" class="btn btn-primary">Approve Cancel</button>
        <button type="button" id="reject-edit" class="btn btn-danger">Reject Cancel</button>
      </div>
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
            "buttons": [{
					extend: 'excel',
					className: 'btn btn-success btn-sm',
					title: 'Edit Approval Information',
					text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
				},
                {
					extend: 'csv',
					className: 'btn btn-warning btn-sm',
					title: 'Edit Approval Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    filename: 'Edit Approval Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    },
                    customize: function (doc) {
                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'landscape';
                        
                        doc.content.splice(0, 0, {
                            image: base64,
                            width: 100, 
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
                        });
                        doc.content.splice(1, 0, {
                            text: 'Edit Approval Information Report',
                            fontSize: 13,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 10, 0, 10]
                        });


                        var table = doc.content[doc.content.length - 1].table;
                        if (table && table.body && table.body.length > 0) {
                            var colCount = table.body[0].length;
                            table.widths = Array(colCount).fill('*');
                        }

                        doc.content[doc.content.length - 1].layout = {
                            hLineWidth: function () { return 0; },
                            vLineWidth: function () { return 0; },
                            hLineColor: function () { return 'white'; },
                            vLineColor: function () { return 'white'; }
                        };

                        doc.styles.tableHeader = {
                            fillColor: '#202ba8',
                            fontSize: 12,
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
                url: "<?php echo base_url() ?>scripts/editapproval.php",
                type: "POST"
                // data: {
                //     userid: <?php// echo json_encode($_SESSION['userid']); ?>
                // }
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
                // { "data": "itenary_type"},
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

                        // button+='<a href="<?php echo base_url() ?>ChangeRequest/Editrequest/'+full['idtbl_job_list']+'/2" onclick="return confirm_request()" target="_self" class="btn btn-primary btn-sm mr-1 ';
                        //     if(statuscheck!=1 || request!=1)
                        //     {
                        //         button+='d-none';
                        //     }
                        //         button+='"><i class="fa fa-check""></i></a>';
                            
                            button += '<button type="button" class="btn btn-primary btn-sm view-modal-btn" ';
                            button += 'data-id="' + full['idtbl_job_list'] + '" ';
                            button += 'data-edit="' + full['edit_request'] + '" ';
                            button += 'data-cancel="' + full['cancel_request'] + '" ';
                            button += 'data-postponed="' + full['postponed_request'] + '" ';
                            button += '><i class="fa fa-eye"></i></button>';

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

        $('#yearSelect,#monthSelect, #bdm').change(function() {
            table.draw(); 
        });

        $('#approve-postponed').on('click', function () {
            var jobId = $('#postponed-job-id').val(); 
            $.ajax({
                url: "<?php echo base_url('ChangeRequest/approvePostponedRequest') ?>", 
                type: "POST",
                data: { job_id: jobId },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved!',
                        text: 'The postponed request was approved.'
                    });
                    $('#postponedModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload(null, false); 
                },
                error: function () {
                    alert('Failed to approve postponed request.');
                }
            });
        });

        $('#approve-cancel').on('click', function () {
            var jobId = $('#cancel-job-id').val(); 
            $.ajax({
                url: "<?php echo base_url('ChangeRequest/approveCancelRequest') ?>", 
                type: "POST",
                data: { job_id: jobId },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved!',
                        text: 'The Cancel request was approved.'
                    });
                    $('#cancelModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload(null, false); 
                },
                error: function () {
                    alert('Failed to approve Cancel request.');
                }
            });
        });

        $('#reject-cancel').on('click', function () {
            var jobId = $('#cancel-job-id').val(); 
            $.ajax({
                url: "<?php echo base_url('ChangeRequest/rejectCancelRequest') ?>", 
                type: "POST",
                data: { job_id: jobId },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Rejected!',
                        text: 'The Cancel request was Rejected.'
                    });
                    $('#cancelModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload(null, false); 
                },
                error: function () {
                    alert('Failed to reject Cancel request.');
                }
            });
        });
        $('#reject-postponed').on('click', function () {
            var jobId = $('#postponed-job-id').val(); 
            $.ajax({
                url: "<?php echo base_url('ChangeRequest/rejectPostponedRequest') ?>", 
                type: "POST",
                data: { job_id: jobId },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Rejected!',
                        text: 'The Posponed request was Rejected.'
                    });
                    $('#postponedModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload(null, false); 
                },
                error: function () {
                    alert('Failed to reject Pospoed request.');
                }
            });
        });
        $('#reject-edit').on('click', function () {
            var jobId = $('#edit-job-id').val(); 
            $.ajax({
                url: "<?php echo base_url('ChangeRequest/rejectEditRequest') ?>", 
                type: "POST",
                data: { job_id: jobId },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Rejected!',
                        text: 'The Cancel request was Rejected.'
                    });
                    $('#editModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload(null, false); 
                },
                error: function () {
                    alert('Failed to reject edit request.');
                }
            });
        });

        $('#approve-edit').on('click', function () {
            var jobId = $('#edit-job-id').val(); 
            $.ajax({
                url: "<?php echo base_url('ChangeRequest/approveEditRequest') ?>", 
                type: "POST",
                data: { job_id: jobId },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved!',
                        text: 'The Edit request was approved.'
                    });
                    $('#editModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload(null, false); 
                },
                error: function () {
                    alert('Failed to approve Edit request.');
                }
            });
        });


    });
    $(document).on('click', '.view-modal-btn', function () {
            var jobId = $(this).data('id');
            var postponed = parseInt($(this).data('postponed'));
            var canceled = parseInt($(this).data('cancel'));
            var edit = parseInt($(this).data('edit'));

            if (postponed === 1) {
                $('#postponed-job-id').val(jobId);

                $.ajax({
                    url: "<?php echo base_url('ChangeRequest/getPostponedData') ?>",
                    type: "POST",
                    data: { job_id: jobId },
                    dataType: "json",
                    success: function (response) {
                        let html = '';
                        if (response.length > 0) {
                            response.forEach(function (row) {
                                html += `<tr>
                                    <td>${row.postponed_date}</td>
                                    <td>${row.postponed_starttime}</td>
                                    <td>${row.postponed_endtime}</td>
                                    <td>${row.reason}</td>
                                </tr>`;
                            });
                        } else {
                            html = '<tr><td colspan="3">No postponed records found.</td></tr>';
                        }
                        $('#postponed-data').html(html);
                        $('#postponedModal').modal('show');
                    },
                    error: function () {
                        alert('Failed to fetch postponed data.');
                    }
                });
            } else if(canceled === 1){
                 $('#cancel-job-id').val(jobId);

                $.ajax({
                    url: "<?php echo base_url('ChangeRequest/getCancelData') ?>",
                    type: "POST",
                    data: { job_id: jobId },
                    dataType: "json",
                    success: function (response) {
                        let html = '';
                        if (response.length > 0) {
                            response.forEach(function (row) {
                                html += `<tr>
                                    <td>${row.insertdatetime}</td>
                                    <td>${row.reason_type}</td>
                                    <td>${row.comment}</td>
                                </tr>`;
                            });
                        } else {
                            html = '<tr><td colspan="3">No Cancel records found.</td></tr>';
                        }
                        $('#cancel-data').html(html);
                        $('#cancelModal').modal('show');
                    },
                    error: function () {
                        alert('Failed to fetch cancel data.');
                    }
                });


            }else if(edit === 1)
            {
                $('#edit-job-id').val(jobId);

                $.ajax({
                    url: "<?php echo base_url('ChangeRequest/getEditData') ?>",
                    type: "POST",
                    data: { job_id: jobId },
                    dataType: "json",
                    success: function (response) {
                        let html = '';
                        if (response.length > 0) {
                            response.forEach(function (row) {
                                html += `<tr>
                                    <td>${row.request_date}</td>
                                    <td>${row.reason_type}</td>
                                    <td>${row.comment}</td>
                                </tr>`;
                            });
                        } else {
                            html = '<tr><td colspan="3">No Cancel records found.</td></tr>';
                        }
                        $('#edit-data').html(html);
                        $('#editModal').modal('show');
                    },
                    error: function () {
                        alert('Failed to fetch edit data.');
                    }
                });

            }
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
<?php include "include/base64.php"; ?>
<?php include "include/footer.php"; ?>
