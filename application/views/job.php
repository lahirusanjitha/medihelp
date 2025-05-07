<?php 
include "include/header.php";  
include "include/topnavbar.php"; 
?>
<head>
<style>
    .highlighted {
  background-color: #d4edda;  
  font-weight: bold;
}
</style>
</head>
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
                            <span>Monthly Itinary</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                        <form action="<?php echo base_url() ?>Job/Jobinsertupdate" method="post" autocomplete="off">
                            <div class="row align-items-end">
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Month*</label>
                                    <input type="month" class="form-control form-control-sm" name="month" id="month" required>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Date*</label>
                                    <input type="date" class="form-control form-control-sm" name="date" id="date" required>
                                </div>
                                <!-- <div class="col-auto">
                                    <label class="small font-weight-bold">Start time*</label>
                                    <input type="time" class="form-control form-control-sm" name="start_time" id="start_time" required>
                                </div> -->
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Start time*</label>
                                    <select class="form-control form-control-sm" name="start_time" id="start_time" required>
                                        <option value="">-- Select Time --</option>
                                        <?= $time;?>
                                    </select>
                                </div>
                                <!-- <div class="col-auto">
                                    <label class="small font-weight-bold">End time*</label>
                                    <input type="time" class="form-control form-control-sm" name="end_time" id="end_time" required>
                                </div> -->
                                <div class="col-auto">
                                    <label class="small font-weight-bold">End time*</label>
                                    <select class="form-control form-control-sm" name="end_time" id="end_time" required>
                                        <option value="">-- Select Time --</option>
                                        <?= $time;?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Itinerary Type*</label>
                                    <select class="form-control form-control-sm" name="type" id="type" required>
                                        <option value="">Select</option>
                                        <?php foreach ($iternarytype->result() as $type) { ?>
                                            <option value="<?php echo $type->idtbl_itenary_type ?>">
                                                <?php echo $type->itenary_type ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Itinerary Category*</label>
                                    <select class="form-control form-control-sm" name="category" id="category" required>
                                        <option value="">Select</option>
                                        <?php foreach ($itenarycategory->result() as $category) { ?>
                                            <option value="<?php echo $category->idtbl_itenary_category ?>">
                                                <?php echo $category->itenary_category ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Itinerary Status*</label>
                                    <select class="form-control form-control-sm" name="group" id="group" required>
                                        <option value="">Select</option>
                                        <?php foreach ($Itenarygroup->result() as $group) { ?>
                                            <option value="<?php echo $group->tblid_itenary_group ?>">
                                                <?php echo $group->group ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="small font-weight-bold">Itinerary*</label>
                                    <textarea class="form-control form-control-sm" name="itenary" id="itenary" rows="4" maxlength="320" required></textarea>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Task*</label>
                                    <input type="number" class="form-control form-control-sm" name="task" id="task" required>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Location*</label>
                                    <select class="form-control form-control-sm" name="location" id="location" required>
                                        <option value="">Select</option>
                                        <?php foreach ($locationdetails->result() as $location) { ?>
                                            <option value="<?php echo $location->idtbl_location ?>">
                                                <?php echo $location->name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label class="small font-weight-bold">Meet Location*</label>
                                    <input type="text" class="form-control form-control-sm" name="meet_location" id="meet_location" required>
                                </div>
                                <div class="col-auto text-right">
                                    <button type="submit" id="submitBtn" class="btn btn-primary btn-sm px-4" <?php if ($addcheck == 0) { echo 'disabled'; } ?>>
                                        <i class="far fa-save"></i>&nbsp;Add
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="recordOption" id="recordOption" value="1">
                            <input type="hidden" name="recordID" id="recordID" value="">
                            <hr>
                        </form>
                        <div class="col-12">
                            <div class="scrollbar pb-3" id="style-2">
                                <table class="table table-bordered table-sm nowrap" id="dataTable" width="100%">
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

<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Feed back</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?php echo base_url('Job/Insertfeedback'); ?>" method="post" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="modaltblJobListField" name="idtbl_job_list">

                    <div class="form-group">
                                <label for="feedbacktype" class="font-weight-bold">Feed Back Type</label>
                                <select class="form-control form-control-sm" name="feedbacktype" id="feedbacktype" required>
                                    <option value="">Select</option>
                                    <?php foreach ($feedbacktype->result() as $ftype) { ?>
                                        <option value="<?php echo $ftype->idtbl_feedback_type ?>">
                                            <?php echo $ftype->feedback_type ?>
                                        </option>
                                    <?php } ?>
                                </select>
                    </div>

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

<div class="modal fade" id="feedbackviewmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Feed Back</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="viewhtml"></div>
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

        // $("#start_time").select2();

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
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
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
                            text: 'Monthly Itinary Information',
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
                url: "<?php echo base_url() ?>scripts/joblist.php",
                type: "POST", 
                data: {
                    userid: <?php echo json_encode($_SESSION['userid']); ?>
                }
            },

            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_job_list"
                },  
            //     {  
            // "data": null,
            // "render": function(data, type, row, meta) {
            //     return meta.row + 1 + meta.settings._iDisplayStart;
            // } 
        // },                                
                { "data": "start_date" },    
                { "data": "start_time" }, 
                { "data": "end_time"},
                { "data": "itenary_type"},
                { "data": "itenary_category" },                    
                { "data": "group" },
                { "data": "task"},
                { "data": "location"},
                { "data": "itenary"},
                { "data": "meet_location"},

                
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {

                        var confirm = full['confirmation'];
                        var editrequest = full['edit_request'];
                        var button = '';

                        button += '<button class="btn btn-primary btn-sm btnEdit mr-1 ';
                        if (!((confirm == 2) || (editcheck == 1 && editrequest == 2))) {
                            button += 'd-none';
                        }
                        button += '" id="' + full['idtbl_job_list'] + '"><i class="fas fa-pen"></i></button>';

                        button += '<a href="<?php echo base_url() ?>ChangeRequest/Editrequest/' + full['idtbl_job_list'] + '/1" onclick="return confirm_request()" target="_self" class="btn btn-primary btn-sm mr-1 '
                        if (confirm != 1 || editrequest != 0) {
                            button += 'd-none';
                        }
                        button += '" id="' + full['idtbl_job_list'] + '"><i class="fa fa-paper-plane"></i></a>';

                        return button;
                    }

                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
         "rowCallback": function(row, data, index) {
        
        if (data.feedback == 1) {
            $(row).addClass('highlighted');  
        }
    }
    
        });
        $('#dataTable tbody').on('click', '.btnview', function () {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>Job/feedbackdetails',
                data: {
                    recordID: id
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'nodata') {
                        alert('No feedback data found.');
                    } else {
                        $('#feedbackviewmodal').modal('show');  
                        $('#viewhtml').html(response.html);  
                    }
                },
                error: function () {
                    alert('Error occurred while loading feedback.');
                }
            });
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
                    success: function(result) { 
                        var obj = JSON.parse(result);
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
                        $('#meet_location').val(obj.meet_location);                     
                        $('#location').val(obj.location);
                        $('#recordOption').val('2');
                        $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
                    }
                });
            }
        });
        
    //     $('#start_time').select2({
    // });

    });
 
    $('#staticBackdrop').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    var idtbl_job_list = button.data('idtbl_job_list');

    $('#modaltblJobListField').val(idtbl_job_list);
});


    function pause_confirm() {
        return confirm("Are you sure you want to pause this?");
    }

    function unpause_confirm() {
        return confirm("Are you sure you want to unpause this?");
    }

    function delete_confirm() {
        return confirm("Are you sure you want to remove this?");
    }
    function cancel_confirm(){
        return confirm("Are you sure you want to cancel this?");
    }
    function confirm_request(){
        return confirm("Are you sure you want to request edit?");
    }
</script>
<?php include "include/footer.php"; ?>
