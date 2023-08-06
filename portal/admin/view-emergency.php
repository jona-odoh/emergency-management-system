<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="">
                            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="">
                            <a href="agency.php"><i class="fa fa-user-md"></i> <span>Agency</span></a>
                        </li>
                        <li>
                            <a href="emergency_type.php"><i class="fa fa-wheelchair"></i> <span>Emergency Types</span></a>
                        </li>
                        <?php
                        // include('../connect.php');
                        $result = $db->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'  ORDER BY id DESC ");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>  
                        <li class="active">
                            <a href="view-emergency.php"><i class="fa fa-file"></i> <span>View Emergency</span> <span class="badge badge-pill bg-primary float-right"><?php echo $row['total'] ;?></span></a>
                        </li>
                    <?php } ?>
                        <li>
                            <a href="report-emergency.php"><i class="fa fa-heartbeat"></i> <span>Reports Emergency</span></a>
                        </li>
                        <li>
                            <a href="report_history.php"><i class="fa fa-file-text-o"></i> <span>Reports History</span></a>
                        </li>
                        <li>
                            <a href="users.php"><i class="fa fa-user-plus"></i> <span>Manage Admin</span></a>
                        </li>
                       <li>
                            <a href="information.php"><i class="fa fa-info-circle"></i> <span>Project information</span></a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>    
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">All Emergency Report</h4>
                    </div> 
                    
                </div> 
				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From Date</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" name="from_date" id="from_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To Date</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datetimepicker" name="to_date" id="to_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agency</label>
                            <select class="form-control" name="agency" id="agency">
                                <option value="">All</option>
                                <?php
                                // Fetch the agencies from the database
                                $result = $db->query("SELECT * FROM agency");
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['agency_name'] . '">' . $row['agency_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&nbsp;</label>
                                <button class="btn btn-primary" id="search-btn"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>


					<div class="col-md-12">
                        <div class="table-responsive print-table">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Case ID</th>
                                        <th>Agency</th>
                                        <th>Issue</th>
                                        <th>Address</th>
                                        <th>Case Severity</th>
                                        <th>Status</th>
                                        <th>Date/Time</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $db->prepare("SELECT e.*, a.agency_name FROM emergency e INNER JOIN agency a ON e.agency_id = a.agency_id");
                                $result->execute();
                                for($i=1; $row = $result->fetch(); $i++){ 
                                ?> 
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['emergency_id']; ?></td>
                                        <td><?php echo $row['agency_name']; ?></td>
                                        <td><?php echo $row['emergency_category']; ?></td>
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['case_severity']; ?></td>
                                        <td> 
                                            <?php
                                            if($row['status'] == "Pending"){
                                                echo "<p class='status-red'>Pending</p>";   
                                            } else {
                                                echo "<p class='status-green'>Resolved</p>";
                                            }     
                                            ?>   
                                        </td>
                                        <td><?php echo $row['dates']; ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-primary" href="make_action.php?id=<?php echo $row['id'];?>"><i class="fa fa-eye m-r-5"></i> View Details</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

						</div>
					</div>
                    <div class="col-md-12 non-printable">
                        <div class="form-group">
                            <button class="btn btn-primary" id="print-btn"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>

                    <script>
                    $(document).ready(function () {
                        // ...existing code...

                        // Handle the print button click event
                        $('#print-btn').click(function () {
                            $('.non-printable').hide();
                            $('.print-table').addClass('printable');
                            window.print();
                            $('.non-printable').show();
                            $('.print-table').removeClass('printable');
                        });

                        // ...existing code...
                    });
                    </script>
                </div>
            </div>
           <?php include 'includes/message.php'; ?>
        </div>
          </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
        <script>
    $(document).ready(function () {
        // Initialize the datepickers
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-crosshairs',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });

        // Handle the search button click event
        $('#search-btn').click(function () {
        var fromDate = $('#from_date').val();
        var toDate = $('#to_date').val();
        var agency = $('#agency').val();
        var status = $('#status').val();

            // Perform the search via AJAX
            $.ajax({
            url: 'search_emergency.php', // Replace with the actual search PHP file
            method: 'POST',
            data: {
                from_date: fromDate,
                to_date: toDate,
                agency: agency,
                status: status
            },
            success: function (response) {
                // Update the table with the search results
                $('#myTable tbody').html(response);
            }
        });
		
        
    });
        // Handle the print button click event
    $('#print-btn').click(function () {
        var printContents = $('.table-responsive').clone();
        
        // Remove action column and pagination
        printContents.find('.text-right').remove();
        printContents.find('.dataTables_paginate').remove();
        printContents.find('.dataTables_info').remove();

        // Remove "Show entries" label and select
        printContents.find('label').remove();
        printContents.find('.dataTables_length').remove();
        
        var originalContents = $('body').html();

        // Create a new window to print
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write('<style>@media print {.emergency-heading {font-weight: bold;}}</style>');
        printWindow.document.write('<link rel="stylesheet" href="assets/css/bootstrap.min.css">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="col-md-12">');
        printWindow.document.write('<h2 class="emergency-heading">Emergency Reports</h2>');
        printWindow.document.write('<div class="table-responsive">');
        printWindow.document.write(printContents.html());
        printWindow.document.write('</div></div></body></html>');
        printWindow.document.close();

        // Wait for the window to load and then print
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
        };

        // Restore the original contents
        $('body').html(originalContents);
    });
    
});

</script>




</body>


<!-- patients23:19-->
</html>
