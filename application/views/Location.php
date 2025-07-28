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
                            <span>Location Details</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-3">
                                <form action="<?php echo base_url() ?>Location/Locationinsertupdate" method="post" autocomplete="off">
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold">Location Name*</label>
                                        <input type="text" class="form-control form-control-sm" name="name" id="name" required>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold">Location Type*</label>
                                        <select class="form-control form-control-sm" name="locationtype" id="locationtype" required>
                                            <option value="">Select</option>
                                            <?php foreach ($locationtype->result() as $type) { ?>
                                                <option value="<?php echo $type->idtbl_location_type ?>">
                                                    <?php echo $type->location_type ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold">Address*</label>
                                        <input type="text" class="form-control form-control-sm" name="address" id="address" required>
                                    </div>
                                    <div class="form-group mt-2 text-right">
                                        <button type="submit" id="submitBtn" class="btn btn-primary btn-sm px-4" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                                    </div>
                                    <input type="hidden" name="recordOption" id="recordOption" value="1">
                                    <input type="hidden" name="recordID" id="recordID" value="">
                                </form>
                            </div>
                            <div class="col-9">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Location name</th>
                                            <th>Location Type</th>
                                            <th>Address</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Add Location Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('Location/LocationContact'); ?>" method="post" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="modalIdtblLocationField" name="idtbl_location">
                    <div class="form-group">
                        <label for="contactName" class="font-weight-bold">Name</label>
                        <input type="text" class="form-control" name="contactName" id="contactName" required>
                    </div>
                    <div class="form-group">
                        <label for="contactPhone" class="font-weight-bold">Contact</label>
                        <input type="text" class="form-control" name="contactPhone" id="contactPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="jobTitle" class="font-weight-bold">Email</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="job_tittle" class="font-weight-bold">Job Tittle</label>
                        <select class="form-control form-control-sm" name="job_tittle" id="job_tittle" required>
                              <option value="">Select</option>
                                    <?php foreach ($jobtittle->result() as $jobtittles) { ?>
                                    <option value="<?php echo $jobtittles->tblid_job_tittle; ?>">
                                    <?php echo $jobtittles->job_tittle;?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Contact</button>
                </div>
                <input type="hidden" name="recordOption" id="recordOption" value="1">
                <input type="hidden" name="recordID" id="recordID" value="">
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="contactlocationviewmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Contact Person</h5>
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
					extend: 'excel',
					className: 'btn btn-success btn-sm',
					title: 'Location Information',
					text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
				},
                {
					extend: 'csv',
					className: 'btn btn-info btn-sm',
					title: 'Location Information',
					text: '<i class="fas fa-file-excel mr-2"></i> CSV',
				},
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    title: '',
                    filename: 'Location Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    exportOptions: {
                        columns: [0, 1, 3]
                    },
                    customize: function (doc) {
                        doc.pageSize = 'A4'; 
                        doc.pageOrientation = 'portrait';
                        
                        doc.content.splice(0, 0, {
                            image: base64,
                            width: 100, 
                            alignment: 'center',
                            margin: [0, 0, 0, 5]
                        });
                        doc.content.splice(1, 0, {
                            text: 'Location info Report',
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
                            hLineWidth: function () { return 0; },
                            vLineWidth: function () { return 0; },
                            hLineColor: function () { return 'white'; },
                            vLineColor: function () { return 'white'; }
                        };

                        doc.styles.tableHeader = {
                            fillColor: '#202ba8',
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
                url: "<?php echo base_url() ?>scripts/location.php",
                type: "POST", // you can use GET
                // data: function(d) {}
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {  
                "data": null,
                "render": function(data, type, row, meta) {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                } 
                 },  
                                        
                {
                    "data": "name"
                },
                {
                    "data": "location_type"
                },      
                {
                    "data": "address" 
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button='';
                            button += '<button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#staticBackdrop" data-idtbl_location="' + full['idtbl_location'] + '"><i class="fas fa-plus mr-2"></i></button>';


                            button += '<button class="btn btn-dark btn-sm btnview mr-1"  id="' + full['idtbl_location'] + '"><i class="fas fa-eye"></i></button>';


                            if (full['confirmstatus'] == 1) {
                                button += '<button class="btn btn-success btn-sm mr-1 ';
                                if (statuscheck != 1) {
                                    button += 'd-none';
                                }
                                button += '"><i class="fas fa-check"></i></button>';
                            }

                            button += '<button class="btn btn-info btn-sm btnEdit mr-1 ';
                            if (editcheck != 1) {
                                button += 'd-none';
                            }
                            button += '" id="' + full['idtbl_location'] + '"><i class="fas fa-pen"></i></button>';

                            if (full['status'] == 1) {
                                button += '<a href="<?php echo base_url() ?>Location/Locationstatus/' + full['idtbl_location'] + '/2" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1 ';
                                if (statuscheck != 1) {
                                    button += 'd-none';
                                }
                                button += '"><i class="fas fa-check"></i></a>';
                            } else {
                                button += '<a href="<?php echo base_url() ?>Location/Locationstatus/' + full['idtbl_location'] + '/1" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1 ';
                                if (statuscheck != 1) {
                                    button += 'd-none';
                                }
                                button += '"><i class="fas fa-times"></i></a>';
                            }

                            button += '<a href="<?php echo base_url() ?>Location/Locationstatus/' + full['idtbl_location'] + '/3" onclick="return delete_confirm()" target="_self" class="btn btn-primary btn-sm ';
                            if (deletecheck != 1) {
                                button += 'd-none';
                            }
                            button += '"><i class="fas fa-trash-alt"></i></a>';

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
                    url: '<?php echo base_url() ?>Location/Locationedit',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#name').val(obj.name);      
                        $('#locationtype').val(obj.locationtype);                 
                        $('#address').val(obj.address);                       

                        $('#recordOption').val('2');
                        $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
                    }
                });
            }
        });
        $('#dataTable tbody').on('click', '.btnview', function () {
            var id = $(this).attr('id');
         $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>Location/Locationcontactdetails',
            data: {
                recordID: id 
                },
            success: function (result) {
                $('#contactlocationviewmodal').modal('show');  
                $('#viewhtml').html(result);  
             }
         });
        });
    });
$('#staticBackdrop').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idtbl_location = button.data('idtbl_location');
    $('#modalIdtblLocationField').val(idtbl_location);
});


    function deactive_confirm() {
        return confirm("Are you sure you want to deactive this?");
    }

    function active_confirm() {
        return confirm("Are you sure you want to active this?");
    }

    function delete_confirm() {
        return confirm("Are you sure you want to remove this?");
    }
</script>
<?php include "include/base64.php";?>
<?php include "include/footer.php"; ?>
