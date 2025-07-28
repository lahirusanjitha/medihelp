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
                            <span>Itinerary Feedback</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
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
                        </div>
                        <hr>
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
                                            <th>Itinerary Category</th>
                                            <!-- <th>Itinerary Sub Category</th> -->
                                            <th>Itinerary Status</th>
                                            <th>Task</th>
                                            <th>Itinerary</th>
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
					title: 'Itinerary Completion Information',
					text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
				},
                {
					extend: 'csv',
					className: 'btn btn-warning btn-sm',
					title: 'Itinerary Completion Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    filename: 'Itinerary Completion Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9]
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
                            text: 'Itinerary Completion Information',
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
                url: "<?php echo base_url() ?>scripts/completionlist.php",
                type: "POST", // you can use GET
                "data": function(d) {
                d.year = $('#yearSelect').val();
                d.bdm = $('#bdm').val();   
                d.month = $('#monthSelect').val(); 

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
                // { "data": "itenary_type"},
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
        $('#yearSelect,#monthSelect, #bdm').change(function() {
            table.draw(); 
        });
        $('#completebuton').on('click', function () {
            let selectedIds = [];

            $('.rowCheckbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
               Swal.fire({
                    icon: "info",
                    title: "Oops...",
                    text: "Select atleast one Itinary!",
                    });
                return;
            }

            $.ajax({
                url: "<?php echo site_url('ItinaryCompletion/ItinaryCmpletionStatus'); ?>",
                type: "POST",
                data: { ids: selectedIds },
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === 'success') {
                        Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Itinary Mark As Completed Successfully!",
                        showConfirmButton: false,
                        timer: 2000
                        });
                        $('#dataTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!"+result.message,
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
    function complete_confirm() {
        return confirm("Are you sure you want to complete this?");
    }
    $('#staticBackdrop').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    var idtbl_job_list = button.data('idtbl_job_list');

    $('#modaltblJobListField').val(idtbl_job_list);
});

</script>
<?php include "include/base64.php"; ?>
<?php include "include/footer.php"; ?>
