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
                            <span>Send to Approval</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
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

                                    <div class="col-md-4 col-lg-3">
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
                                        <label for="fromDate">From Date</label>
                                        <input type="date" id="fromDate" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <label for="toDate">To Date</label>
                                        <input type="date" id="toDate" class="form-control form-control-sm">
                                    </div>

                                    <div class="col-md-4 col-lg-3">
                                        <label for="bdm">BD Team Member</label>
                                        <select id="bdm" class="form-control form-control-sm" <?php if($statuscheck != 1) echo 'disabled'; ?> >
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
                                <div class="col-12">
                                    <div class="scrollbar pb-3" id="style-2">
                                        <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="selectAll"></th>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <!-- <th>Itinerary Type</th> -->
                                                    <th>Itinerary Category</th>
                                                    <th>Itinerary Status</th>
                                                    <th>Revenue potental</th>
                                                    <th>Location</th>
                                                    <th>Activity In Detail</th>
                                                    <th>Meet Location</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button id="insertDataButton" class="btn btn-primary btn-sm">Send to Approve</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
                    className: 'btn btn-primary btn-sm',
                    title: '',
                    filename: 'Send_to_approve_Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9,10]
                    },
                    customize: function (doc) {
                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'landscape';
                        
                        doc.content.splice(0, 0, {
                            image: base64,
                            width: 140, 
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
                        });
                        doc.content.splice(1, 0, {
                            text: 'Send to Approve',
                            fontSize: 16,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 10, 0, 10]
                        });

                        var table = doc.content[doc.content.length - 1].table;
                        if (table && table.body && table.body.length > 0) {
                            table.widths = ['2%', '*', '*', '*', '*', '*', '*', '*', '*', '*']; 
                        }

                        doc.content[doc.content.length - 1].layout = {
                            hLineWidth: function () { return 0; },
                            vLineWidth: function () { return 0; },
                            hLineColor: function () { return 'white'; },
                            vLineColor: function () { return 'white'; }
                        };

                        doc.styles.tableHeader = {
                            fillColor: '#003087',
                            fontSize: 13,
                            color: 'white',
                            alignment: 'left',
                            bold: true
                        };
                        // doc.styles.tableBodyEven = {
                        //     alignment: 'center'
                        // };
                        // doc.styles.tableBodyOdd = {
                        //     alignment: 'center'
                        // };
                 }
                },
             {
					extend: 'excel',
					className: 'btn btn-success btn-sm',
					title: 'Send to Approve Information',
					text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
				},
                {
					extend: 'csv',
					className: 'btn btn-info btn-sm',
					title: 'Send to Approve Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
            ],
    ajax: {
        url: "<?php echo base_url() ?>scripts/sendtoapprove.php",
        type: "POST", 
        data: function(d) {
            d.bdm = $('#bdm').val();   
            d.month = $('#monthSelect').val(); 
            d.year = $('#yearSelect').val(); 
            d.fromDate = $('#fromDate').val(); 
            d.toDate = $('#toDate').val(); 
        }
    },
    "order": [[2, "desc"]], 
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
            "orderable": false,
            "searchable": false,
            "render": function(data, type, row, meta) {
                return meta.row + 1 + meta.settings._iDisplayStart;
            }
        },
        { "data": "start_date" },
        { "data": "start_time" },
        { "data": "end_time" },
        // { "data": "itenary_type" },
        { "data": "itenary_category" },
        { "data": "group" },
        { "data": "task" },
        { "data": "location" },
        { "data": "itenary" },
        { "data": "meet_location" }
    ],
    drawCallback: function(settings) {
        $('[data-toggle="tooltip"]').tooltip();
    }
});

$('#yearSelect,#monthSelect, #bdm, #fromDate,#toDate').change(function() {
            table.draw(); 
});

$('#insertDataButton').on('click', function () {
    let selectedIds = [];

    $('.rowCheckbox:checked').each(function () {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
          Swal.fire({
            icon: "warning",
            title: "Please Selecet atleast one for send to approval",
            showConfirmButton: false,
            timer: 2000
            });
        return;
        return;
    }

    $.ajax({
        url: "<?php echo site_url('Sendtoapprove/updateApprovalStatus'); ?>",
        type: "POST",
        data: { ids: selectedIds },
        success: function (response) {
            let result = JSON.parse(response);
            if (result.status === 'success') {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Sent To approve Successfully!",
                    showConfirmButton: false,
                    timer: 1500
                    });
                $('#dataTable').DataTable().ajax.reload();
            } else {
                // alert('Failed to update data: ' + result.message);
                  Swal.fire({
                    icon: "error",
                    title: "Failed to update data",
                    showConfirmButton: false,
                    timer: 2000
                    });
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
<?php include "include/base64.php";?>
<?php include "include/footer.php"; ?> 
