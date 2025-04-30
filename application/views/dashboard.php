
<head>
    <?php include "include/header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-container {
            background-color: #f9f9f9;
            padding: 20px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
        }

        .table-container {
            overflow-x: auto;
        }

        .summary-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        #summaryPieChart {
            max-width: 300px;
            max-height: 300px;
        }
    </style>
</head>

<body>
    <?php include "include/topnavbar.php"; ?>

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
                                <div class="page-header-icon"><i class="fas fa-desktop"></i></div>
                                <span>Dashboard</span>
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="dashboard-container">
                    <h3 class="mb-4">Itinerary Status</h3>
                    <div class="row mb-4">

                    <div class="col-md-6 col-lg-3">
                <label for="yearSelect">Select Year</label>
                <select id="yearSelect" class="form-control form-control-sm">
                    <option value="">All Years</option>
                    <?php
                        $currentYear = date("Y");
                        for ($i = $currentYear; $i >= $currentYear - 10; $i--) { 
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
                            <label for="bdm">Select Bdm</label>
                            <select name="bdm" id="bdm" class="form-control form-control-sm" >
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

                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card p-3">
                                <ul class="nav nav-tabs" id="detailsTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="postponed-tab" data-toggle="tab" href="#postponedDetails" role="tab" aria-controls="postponedDetails" aria-selected="true">Postponed Records</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="canceled-tab" data-toggle="tab" href="#canceledDetails" role="tab" aria-controls="canceledDetails" aria-selected="false">Canceled Records</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completedDetails" role="tab" aria-controls="completedDetails" aria-selected="false">Completed Records</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="missing-tab" data-toggle="tab" href="#missingDetails" role="tab" aria-controls="missingDetails" aria-selected="false">Missing Records</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3 table-container" id="detailsTabContent">
                                    <div class="tab-pane fade show active" id="postponedDetails" role="tabpanel" aria-labelledby="postponed-tab">
                                        <table id="postponedTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Month</th>
                                                    <!-- <th>Start Date</th> -->
                                                    <th>Task</th>
                                                    <th>Itinerary Type</th>
                                                    <th>Itinerary Category</th>
                                                    <th>Itinerary Status</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="canceledDetails" role="tabpanel" aria-labelledby="canceled-tab">
                                        <table id="canceledTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Month</th>
                                                   <!-- <th>Start Date</th> -->
                                                    <th>Task</th>
                                                    <th>Itinerary Type</th>
                                                    <th>Itinerary Category</th>
                                                    <th>Itinerary Status</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="completedDetails" role="tabpanel" aria-labelledby="completed-tab">
                                        <table id="completedTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Month</th>
                                                   <!-- <th>Start Date</th> -->
                                                    <th>Task</th>
                                                    <th>Itinerary Type</th>
                                                    <th>Itinerary Category</th>
                                                    <th>Itinerary Status</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="missingDetails" role="tabpanel" aria-labelledby="missing-tab">
                                        <table id="missingTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Month</th>
                                                  <!--  <th>Start Date</th> -->
                                                    <th>Task</th>
                                                    <th>Itinerary Type</th>
                                                    <th>Itinerary Category</th>
                                                    <th>Itinerary Status</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card p-3">
                                <h4 class="text-center">Summary</h4>
                                <div class="summary-container">
                                    <div id="noDataMessage" style="display:none; text-align: center; font-size: 16px;">No Records available.</div> 
                                    <canvas id="summaryPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include "include/footerbar.php"; ?>
    <?php include "include/footerscripts.php"; ?>
</body>


<script>
        function updatePieChart(postponedCount, canceledCount, completedCount, missingCount) {
            if (postponedCount === 0 && canceledCount === 0 && completedCount === 0 && missingCount === 0) {
                $('#summaryPieChart').hide(); 
                $('#noDataMessage').show(); 
                return; 
            } else {
                $('#summaryPieChart').show(); 
                $('#noDataMessage').hide(); 
            }
            var ctx = document.getElementById('summaryPieChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Postponed', 'Canceled', 'Completed', 'Missing'],
                    datasets: [{
                        data: [postponedCount, canceledCount, completedCount, missingCount],
                        backgroundColor: ['#f39c12', '#e74c3c', '#2ecc71', '#3498db'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                    hover: {
                         mode: null 
                    }
                },
            });
        }

        function loadRecords(endpoint, tableId, countType) {
            var selectedYear = $('#yearSelect').val();
            var selectedMonth = $('#monthSelect').val();
            var selectedBdm = $('#bdm').val();
            $.ajax({
                url: "<?php echo base_url(); ?>Dashboard/" + endpoint,
                type: 'POST',
                data: {year:selectedYear, month: selectedMonth, bdm: selectedBdm },
                dataType: 'json',
                success: function(data) {
                    var tableBody = $(tableId + ' tbody');
                    tableBody.empty();

                    if (data.length > 0) {
                    data.forEach(function(record) {
                        var row = '<tr>' +
                            '<td>' + record.id + '</td>' +
                            '<td>' + record.start_date + '</td>' +
                            '<td>' + record.task + '</td>' +
                            '<td>' + record.itenary_type + '</td>' +
                            '<td>' + record.itenary_category + '</td>' +
                            '<td>' + record.group + '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                } else {
                    tableBody.append('<tr><td colspan="6">No records found</td></tr>');
                }

                    if (countType === 'Postponed') postponedCount = data.length;
                    if (countType === 'Canceled') canceledCount = data.length;
                    if (countType === 'Completed') completedCount = data.length;
                    if (countType === 'Missing') missingCount = data.length;

                    updatePieChart(postponedCount, canceledCount, completedCount, missingCount);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to load records. Please try again later.');
                }
            });
            
        }

        $(document).ready(function() {
            var postponedCount = 0;
            var canceledCount = 0;
            var completedCount = 0;
            var missingCount = 0;

            loadRecords('getPostponedRecords', '#postponedTable', 'Postponed');
            loadRecords('getCanceledRecords', '#canceledTable', 'Canceled');
            loadRecords('getCompletedRecords', '#completedTable', 'Completed');
            loadRecords('getMissingRecords', '#missingTable', 'Missing');

            $('#yearSelect, #monthSelect , #bdm').on('change', function() {
                loadRecords('getPostponedRecords', '#postponedTable', 'Postponed');
                loadRecords('getCanceledRecords', '#canceledTable', 'Canceled');
                loadRecords('getCompletedRecords', '#completedTable', 'Completed');
                loadRecords('getMissingRecords', '#missingTable', 'Missing');
            });
        });
    </script>