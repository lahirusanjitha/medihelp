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
                            <span>Approval</span>
                        </h1>
                    </div>
                </div>
                </div>
            <div class="container-fluid mt-2 p-0 p-2">
            <div class="card">
            <div class="card-body p-2">
            <div class="row align-items-end">  
                <div class="col-md-6 col-lg-3">
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
                        <option value="<?php echo $_SESSION['userid'];?>" style="display:none;">
                            <?php echo $_SESSION['name'];?>
                        </option>
                        <?php foreach ($user->result() as $users) { ?>
                            <option value="<?php echo $users->idtbl_res_user; ?>">
                                <?php echo $users->name; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <hr>
            <div class="mt-3">
                <div class="scrollbar pb-3" id="style-2">
                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>#</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Itinerary Type</th>
                                <th>Itinerary Category</th>
                                <th>Itinerary Status</th>
                                <th>Task</th>
                                <th>Location</th>
                                <th>Itinerary</th>
                                <th>Meet Location</th>
                               <!-- <th class="text-right">Actions</th>-->
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="mt-3">
                        <button style="float: right; margin-left: 5px;" id="rejectAllBtn" class="btn btn-danger btn-sm">Reject</button>
                        <button style="float: right;" id="approveAllBtn" class="btn btn-primary btn-sm">Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

<!-- Reject Reason Modal -->
<div class="modal fade" id="rejectReasonModal" tabindex="-1" role="dialog" aria-labelledby="rejectReasonModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter Reject Reason</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="rejectReasonInput" class="form-control" rows="4" placeholder="Type reason here..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" id="submitRejectBtn" class="btn btn-danger">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
					title: 'Approval Information',
					text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
				},
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    filename: 'Approval Level Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9,10,11]
                    },
                    customize: function (doc) {
                        
                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'landscape';

                        doc.content.splice(0, 0, {
                            text: 'Approval Information Report - MediHelp Hospital',
                            fontSize: 13,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
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
                            fillColor: '#34495e',
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
                url: "<?php echo base_url() ?>scripts/jobconfirm.php",
                type: "POST", 
                "data": function(d) {
                d.bdm = $('#bdm').val();   
                d.month = $('#monthSelect').val(); 
                d.year = $('#yearSelect').val(); 
            }
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
                { "data": "location"},
                { "data": "itenary"},
                { "data": "meet_location"}
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
$('#yearSelect,#monthSelect, #bdm').change(function() {
            table.draw(); 
});

$('#approveAllBtn').on('click', function () {
    let selectedIds = [];

    $('.rowCheckbox:checked').each(function () {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
            Swal.fire({
            icon: "warning",
            title: "Please Selecet atleast one",
            showConfirmButton: false,
            timer: 2000
            });
        return;
        return;
    }

    $.ajax({
        url: "<?php echo site_url('Confirmjob/ApprovalStatus'); ?>",
        type: "POST",
        data: { ids: selectedIds },
        success: function (response) {
            let result = JSON.parse(response);
            if (result.status === 'success') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Itinary Approved Successfully",
                    showConfirmButton: false,
                    timer: 2000
                    });
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

let selectedIds = [];

$('#rejectAllBtn').on('click', function () {
    selectedIds = [];

    $('.rowCheckbox:checked').each(function () {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
        Swal.fire({
            icon: "warning",
            title: "Please select at least one",
            showConfirmButton: false,
            timer: 2000
        });
        return;
    }

    // Show the modal to enter reject reason
    $('#rejectReasonInput').val(''); // Clear previous input
    $('#rejectReasonModal').modal('show');
});

$('#submitRejectBtn').on('click', function () {
    let reason = $('#rejectReasonInput').val().trim();

    if (reason === '') {
        Swal.fire({
            icon: "warning",
            title: "Reject reason is required",
            showConfirmButton: false,
            timer: 2000
        });
        return;
    }

    // Send AJAX request with selected IDs and reason
    $.ajax({
        url: "<?php echo site_url('Confirmjob/rejectApproval'); ?>",
        type: "POST",
        data: {
            ids: selectedIds,
            reason: reason
        },
        success: function (response) {
            let result = JSON.parse(response);
            if (result.status === 'success') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Itinerary rejected successfully",
                    showConfirmButton: false,
                    timer: 2000
                });
                $('#rejectReasonModal').modal('hide');
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


</script>
<?php include "include/footer.php"; ?>
