<?php 
include 'includes/head.php'; 
?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
         
        <div class="page-wrapper">
            <!-- Success/Error Messages -->
            <?php if(isset($_GET['success'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Emergency status updated successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['failed'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Failed to update emergency status.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">All Emergency Reports</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="report-emergency.php" class="btn btn-primary btn-rounded float-right">
                            <i class="fa fa-plus"></i> Report New Emergency
                        </a>
                    </div>
                </div>
                
                <!-- Filter Form -->
                <div class="row filter-section mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Filter Emergency Reports</h5>
                                <form id="filterForm" class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datetimepicker" name="from_date" id="from_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datetimepicker" name="to_date" id="to_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Agency</label>
                                            <select class="form-control select2" name="agency" id="agency">
                                                <option value="">All Agencies</option>
                                                <?php
                                                $result = $db->query("SELECT * FROM agency ORDER BY agency_name");
                                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                    echo '<option value="' . $row['agency_id'] . '">' . htmlspecialchars($row['agency_name']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">All Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Resolved">Resolved</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Case Severity</label>
                                            <select class="form-control" name="severity" id="severity">
                                                <option value="">All Severity</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Critical">Critical</option>
                                                <option value="Danger">Danger</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <button type="button" class="btn btn-primary" id="search-btn">
                                                <i class="fa fa-search"></i> Search
                                            </button>
                                            <button type="button" class="btn btn-secondary" id="reset-btn">
                                                <i class="fa fa-refresh"></i> Reset
                                            </button>
                                            <button type="button" class="btn btn-info" id="print-btn">
                                                <i class="fa fa-print"></i> Print
                                            </button>
                                            <button type="button" class="btn btn-success" id="export-btn">
                                                <i class="fa fa-download"></i> Export
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Emergency Reports Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="emergencyTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Case ID</th>
                                        <th>Agency</th>
                                        <th>Emergency Type</th>
                                        <th>Location</th>
                                        <th>Reporter</th>
                                        <th>Case Severity</th>
                                        <th>Status</th>
                                        <th>Date/Time</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                    $result = $db->prepare("SELECT e.*, a.agency_name FROM emergency e 
                                                           INNER JOIN agency a ON e.agency_id = a.agency_id 
                                                           ORDER BY e.dates DESC, e.id DESC");
                                    $result->execute();
                                    
                                    if($result->rowCount() > 0):
                                        $i = 1;
                                        while($row = $result->fetch()):
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($row['emergency_id']); ?></strong>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['agency_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['emergency_category']); ?></td>
                                        <td>
                                            <small><?php echo htmlspecialchars($row['state']); ?></small><br>
                                            <small class="text-muted"><?php echo htmlspecialchars(substr($row['address'], 0, 30)); ?>...</small>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['name']); ?><br>
                                            <small class="text-muted"><?php echo htmlspecialchars($row['phone_number']); ?></small>
                                        </td>
                                        <td>
                                            <?php 
                                            $severity_class = '';
                                            if($row['case_severity'] == 'Danger') $severity_class = 'badge-danger';
                                            elseif($row['case_severity'] == 'Critical') $severity_class = 'badge-warning';
                                            else $severity_class = 'badge-info';
                                            ?>
                                            <span class="badge <?php echo $severity_class; ?>">
                                                <?php echo htmlspecialchars($row['case_severity']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            if($row['status'] == "Pending"){
                                                echo '<span class="badge badge-warning"><i class="fa fa-clock-o"></i> Pending</span>';
                                            } else {
                                                echo '<span class="badge badge-success"><i class="fa fa-check"></i> Resolved</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($row['dates'])); ?><br>
                                            <small class="text-muted"><?php echo date('h:i A', strtotime($row['dates'])); ?></small>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="make_action.php?id=<?php echo $row['id']; ?>">
                                                        <i class="fa fa-eye m-r-5"></i> View Details
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#statusModal_<?php echo $row['id']; ?>">
                                                        <i class="fa fa-edit m-r-5"></i> Update Status
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteModal_<?php echo $row['id']; ?>">
                                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Status Update Modal -->
                                    <div id="statusModal_<?php echo $row['id']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Emergency Status</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="update_status.php" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <div class="form-group">
                                                            <label>Emergency ID</label>
                                                            <input type="text" class="form-control" value="<?php echo $row['emergency_id']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Current Status</label>
                                                            <input type="text" class="form-control" value="<?php echo $row['status']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Update Status</label>
                                                            <select class="form-control" name="status" required>
                                                                <option value="Pending" <?php echo $row['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                                <option value="Resolved" <?php echo $row['status'] == 'Resolved' ? 'selected' : ''; ?>>Resolved</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Remarks (Optional)</label>
                                                            <textarea class="form-control" name="remarks" rows="2" placeholder="Add any remarks..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div id="deleteModal_<?php echo $row['id']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <img src="../assets/img/sent.png" alt="" width="50" height="46">
                                                    <h3>Delete Emergency Report?</h3>
                                                    <p>Are you sure you want to delete emergency report #<?php echo $row['emergency_id']; ?>?</p>
                                                    <div class="m-t-20">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                        <a href="delete_emergency.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <div class="empty-state">
                                                <i class="fa fa-exclamation-triangle fa-3x text-muted mb-3"></i>
                                                <h4>No Emergency Reports Found</h4>
                                                <p class="text-muted">No emergency reports have been submitted yet.</p>
                                                <a href="report-emergency.php" class="btn btn-primary">
                                                    <i class="fa fa-plus me-2"></i>Report First Emergency
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            
                            <!-- Statistics Summary -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Emergency Statistics</h5>
                                            <div class="row text-center">
                                                <div class="col-md-3">
                                                    <div class="stat-box bg-info text-white p-3 rounded">
                                                        <h3 class="mb-0">
                                                            <?php
                                                            $total = $db->query("SELECT COUNT(*) FROM emergency")->fetchColumn();
                                                            echo $total;
                                                            ?>
                                                        </h3>
                                                        <p class="mb-0">Total Reports</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="stat-box bg-warning text-white p-3 rounded">
                                                        <h3 class="mb-0">
                                                            <?php
                                                            $pending = $db->query("SELECT COUNT(*) FROM emergency WHERE status = 'Pending'")->fetchColumn();
                                                            echo $pending;
                                                            ?>
                                                        </h3>
                                                        <p class="mb-0">Pending</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="stat-box bg-success text-white p-3 rounded">
                                                        <h3 class="mb-0">
                                                            <?php
                                                            $resolved = $db->query("SELECT COUNT(*) FROM emergency WHERE status = 'Resolved'")->fetchColumn();
                                                            echo $resolved;
                                                            ?>
                                                        </h3>
                                                        <p class="mb-0">Resolved</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="stat-box bg-danger text-white p-3 rounded">
                                                        <h3 class="mb-0">
                                                            <?php
                                                            $critical = $db->query("SELECT COUNT(*) FROM emergency WHERE case_severity = 'Danger'")->fetchColumn();
                                                            echo $critical;
                                                            ?>
                                                        </h3>
                                                        <p class="mb-0">Critical Cases</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/message.php'; ?>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>    
    
    <script>
    $(document).ready(function () {
        // Initialize datepickers
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

        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select Agency",
            allowClear: true
        });

        // Handle search button click
        $('#search-btn').click(function () {
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();
            var agency = $('#agency').val();
            var status = $('#status').val();
            var severity = $('#severity').val();

            // Show loading
            $('#tableBody').html('<tr><td colspan="10" class="text-center"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></td></tr>');

            // Perform AJAX search
            $.ajax({
                url: 'search_emergency.php',
                method: 'POST',
                data: {
                    from_date: fromDate,
                    to_date: toDate,
                    agency: agency,
                    status: status,
                    severity: severity
                },
                success: function (response) {
                    $('#tableBody').html(response);
                },
                error: function () {
                    $('#tableBody').html('<tr><td colspan="10" class="text-center text-danger">Error loading data. Please try again.</td></tr>');
                }
            });
        });

        // Handle reset button
        $('#reset-btn').click(function () {
            $('#filterForm')[0].reset();
            $('.select2').val(null).trigger('change');
            location.reload();
        });

        // Handle print button
        $('#print-btn').click(function () {
            var printContents = $('#emergencyTable').clone();
            
            // Remove action column
            printContents.find('.text-right').remove();
            
            // Create print window
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                <head>
                    <title>Emergency Reports</title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                    <style>
                        @media print {
                            body { margin: 20px; }
                            .print-title { text-align: center; margin-bottom: 20px; }
                            .print-summary { margin-bottom: 20px; }
                            table { width: 100%; border-collapse: collapse; }
                            th { background-color: #f8f9fa !important; }
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h2 class="print-title">Emergency Reports</h2>
                        <div class="print-summary">
                            <p><strong>Generated on:</strong> ${new Date().toLocaleString()}</p>
                        </div>
                        ${printContents.html()}
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.onload = function () {
                printWindow.print();
                printWindow.close();
            };
        });

        // Handle export button (CSV)
        $('#export-btn').click(function () {
            var fromDate = $('#from_date').val();
            var toDate = $('#to_date').val();
            var agency = $('#agency').val();
            var status = $('#status').val();
            var severity = $('#severity').val();

            // Create export URL with parameters
            var exportUrl = 'export_emergency.php?';
            if (fromDate) exportUrl += 'from_date=' + fromDate + '&';
            if (toDate) exportUrl += 'to_date=' + toDate + '&';
            if (agency) exportUrl += 'agency=' + agency + '&';
            if (status) exportUrl += 'status=' + status + '&';
            if (severity) exportUrl += 'severity=' + severity;

            window.location.href = exportUrl;
        });

        // Auto-refresh every 30 seconds for new emergencies
        setInterval(function() {
            var hasPending = $('#emergencyTable').find('.badge-warning').length > 0;
            if (hasPending) {
                $('#search-btn').click();
            }
        }, 30000); // 30 seconds
    });
    </script>
</body>
</html>