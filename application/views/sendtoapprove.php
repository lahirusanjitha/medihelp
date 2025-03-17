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
                            <span>Send to Approval Level</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
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

                                    <div class="col-md-4 col-lg-3">
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

                                <hr>
                                <div class="col-12">
                                    <div class="scrollbar pb-3" id="style-2">
                                        <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                            <thead>
                                                <tr>
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
                url: "<?php echo base_url() ?>scripts/sendtoapprove.php",
                type: "POST", 
                "data": function(d) {
                d.bdm = $('#bdm').val();   
                d.month = $('#monthSelect').val(); 
                d.year = $('#yearSelect').val(); 
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
        $('#insertDataButton').on('click', function () {
    let table = $('#dataTable').DataTable();
    let displayedRows = table.rows({ filter: 'applied' }).data();
    let idsToUpdate = [];

    displayedRows.each(function (rowData) {
        idsToUpdate.push(rowData.idtbl_job_list); 
    });

    if (idsToUpdate.length === 0) {
        alert('No data available to send for approval.');
        return;
    }

    $.ajax({
        url: "<?php echo site_url('Sendtoapprove/updateApprovalStatus'); ?>",
        type: "POST",
        data: { ids: idsToUpdate },
        success: function (response) {
            let result = JSON.parse(response);
            if (result.status === 'success') {
                alert('Data sent for approval successfully.');
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
</script>
<?php include "include/footer.php"; ?> 
