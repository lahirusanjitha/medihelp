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
                            <span>Feed Back</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                       
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
                                            <!-- <th>Itinary Action</th> -->
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

            <form action="<?php echo base_url('Feedback/Insertfeedback'); ?>" method="post" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="modaltblJobListField" name="idtbl_job_list">

                    <div class="form-group">
                                <label for="feedbacktype" class="font-weight-bold">Feed Back Type</label>
                                <select class="form-control form-control" name="feedbacktype" id="feedbacktype" required>
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



<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog"
     aria-labelledby="feedbackModalLabel" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Feedback Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-tabs" id="feedbackTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="feedback-tab" data-toggle="tab" href="#feedbackDetails" role="tab" aria-controls="feedbackDetails" aria-selected="true">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="manage-tab" data-toggle="tab" href="#manageFeedbackDetails" role="tab" aria-controls="manageFeedbackDetails" aria-selected="false">Manager Feedback</a>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="feedbackTabContent">
                    <div class="tab-pane fade show active" id="feedbackDetails" role="tabpanel" aria-labelledby="feedback-tab">
                        <div id="feedbackTableContainer">
                            <p class="text-muted text-center">Loading feedback...</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="manageFeedbackDetails" role="tabpanel" aria-labelledby="manage-tab">
                        <div id="manageTableContainer">
                            <p class="text-muted text-center">Loading manager feedback...</p>
                        </div>
                    </div>
                </div>

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
            "buttons": [{
					extend: 'csv',
					className: 'btn btn-success btn-sm',
					title: 'FeedBack Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: '',
                    filename: 'Feedback information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10]
                    },
                    customize: function (doc) {

                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'landscape';

                        doc.content.splice(0, 0, {
                            text: 'Feedback information Report - MediHelp Hospital',
                            fontSize: 13,
                            bold: true,
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
                        });




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
                url: "<?php echo base_url() ?>scripts/feedback.php",
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
                // { "data": "actions"},

                
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {

                        var confirm = full['confirmation'];
                        var editrequest = full['edit_request'];
                        var button = '';

                      
                        button += '<button type="button" class="btn btn-success btn-sm mr-1" data-toggle="modal" data-target="#staticBackdrop" data-idtbl_job_list="' + full['idtbl_job_list'] + '"><i class="far fa-comment"></i></button>';

                        button += '<button class="btn btn-dark btn-sm btnview mr-1"  id="' + full['idtbl_job_list'] + '"><i class="fas fa-eye"></i></button>';
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
       

    let feedbackRecordID = null;

    $(document).on('click', '.btnview', function () {
        feedbackRecordID = $(this).attr('id');
        $('#feedbackModal').modal('show');

        // Activate Feedback tab and load default
        $('#feedback-tab').tab('show');
        loadFeedbackTab('feedback');
    });

    $('#feedback-tab').on('shown.bs.tab', function () {
        if (feedbackRecordID) loadFeedbackTab('feedback');
    });

    $('#manage-tab').on('shown.bs.tab', function () {
        if (feedbackRecordID) loadFeedbackTab('manage');
    });

    function loadFeedbackTab(type) {
        const isAdmin = (type === 'feedback') ? 0 : 1;
        const container = (isAdmin === 0) ? '#feedbackTableContainer' : '#manageTableContainer';

        $(container).html('<p class="text-muted text-center">Loading...</p>');

        $.ajax({
            url: 'Feedback/feedbackdetails', 
            method: 'POST',
            data: { recordID: feedbackRecordID, is_admin: isAdmin },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $(container).html(response.html);
                } else {
                    $(container).html('<p class="text-center text-muted">No feedback available.</p>');
                }
            },
            error: function () {
                $(container).html('<p class="text-danger text-center">Error loading feedback.</p>');
            }
        });
    }

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
