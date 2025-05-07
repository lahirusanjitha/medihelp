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
                            <span>Feedback Report</span>
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
            </div>
            <hr>
                    <div class="card-body p-0 p-2">
                        <div class="row">     
                            <div class="col-12">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                           <!-- <th>Task</th> -->
                                            <th>Itenary</th>
                                            <th>Feedback Type</th>
                                            <th>Comment</th>
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
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
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
                            text: 'Feedback Report Information',
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
                url: "<?php echo base_url() ?>scripts/feedbackreport.php",
                type: "POST", 
                "data": function(d) {
                d.year = $('#yearSelect').val();
                d.bdm = $('#bdm').val();   
                d.month = $('#monthSelect').val(); 
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
                { "data": "start_time" },  
                { "data": "end_time" },  
                //{ "data": "task"},
                { "data": "itenary"},
                { "data": "feedback_type"},
                { "data": "comment"}
                
                
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#yearSelect,#monthSelect, #bdm').change(function() {
            table.draw(); 
        });
    });



</script>
<?php include "include/footer.php"; ?>
