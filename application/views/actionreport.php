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
                            <span>Action Report</span>
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
                <label for="bdm">Select DB Team Member</label>
                <select id="bdm" class="form-control form-control-sm" <?php if($statuscheck != 1) echo 'disabled'; ?>>
                    <?php foreach ($user->result() as $users) { ?>
                        <option value="<?php echo $_SESSION['userid'];?>" style="display:none;">
                            <?php echo $_SESSION['name'];?>
                        </option>
                        <option value="<?php echo $users->idtbl_res_user; ?>">
                            <?php echo $users->name; ?>
                        </option>
                    <?php } ?>
                </select>
                </div>

                <div class="col-md-6 col-lg-3">
                    <label for="statusSelect">Select Status</label>
                    <select id="statusSelect" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        <option value="1">Completed</option>
                        <option value="2">Not Approved</option>
                        <option value="3">Canceled</option>
                        <option value="4">Approved - Not Completed</option>
                        <option value="5">Postponed</option>
                    </select>
                </div>


            </div>
            <hr>
                    <div class="card-body p-0 p-2">
                        <div class="row">     
                            <div class="col-12">
                            <div class="scrollbar pb-3" id="style-2">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>Date</th>
                                            <!-- <th>Start Time</th> -->
                                            <th>Time</th> 
                                            <th>Itinerary Type</th>
                                            <th>Itinerary Category</th> 
                                            <th>Itinerary Status</th>
                                            <th>Task</th>
                                            <th>Location</th> 
                                            <th>Itinerary</th>
                                            <th>Meet Location</th>
                                            <th>Status</th>
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
					extend: 'excel',
					className: 'btn btn-success btn-sm',
					title: 'Action Report Information',
					text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
				},
                {
					extend: 'csv',
					className: 'btn btn-warning btn-sm',
					title: 'Action Report Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    filename: 'Action Status Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,8,9,10]
                    },
                    customize: function (doc) {
                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'landscape';
                        
                        var bdmSelect = document.getElementById("bdm");
                        var selectedUsername = bdmSelect.options[bdmSelect.selectedIndex].text;

                        doc.content.splice(0, 0, {
                            image: base64,
                            width: 100, 
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
                        });
                        doc.content.splice(1, 0, {
                            text: 'Action Status Information',
                            fontSize: 13,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 10, 0, 10]
                        });
                        doc.content.splice(2, 0, {
                            text: 'DB Team Member: ' + selectedUsername, 
                            fontSize: 10,
                            alignment: 'left',
                            margin: [0, 0, 0, 10]
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
                url: "<?php echo base_url() ?>scripts/actionreport.php",
                type: "POST", 
                "data": function(d) {
                d.year = $('#yearSelect').val();
                d.bdm = $('#bdm').val();   
                d.month = $('#monthSelect').val(); 
                d.status = $('#statusSelect').val();
               // d.userid = <?php //echo json_encode($_SESSION['userid']); ?>;
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
                // { "data": "start_time" }, 
                { "data": "time_range"},
                { "data": "itenary_type"},
                { "data": "itenary_category" },                    
                { "data": "group" },
                { "data": "task"},
                { "data": "location"},
                { "data": "itenary"},
                { "data": "meet_location"},
                { "data": "actions"}
                
                
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#yearSelect,#monthSelect, #bdm, #statusSelect').change(function() {
            table.draw(); 
        });
    });



</script>
<?php include "include/base64.php"; ?>
<?php include "include/footer.php"; ?>
