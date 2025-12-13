<?php 
include 'includes/head.php';


?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
         
        <div class="page-wrapper">
            <!-- Success Message -->
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
            
            <div class="content">
                <div class="row">
                    <div class="col-sm-6 col-3">
                        <h4 class="page-title">Emergency Details</h4>
                    </div>
                    <div class="col-sm-6 col-9 text-right m-b-20">
                        <a href="view-emergency.php" class="btn btn-secondary btn-rounded">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                        <button onclick="window.print()" class="btn btn-info btn-rounded">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php
                                       $id=$_GET['id'];
                            $result = $db->prepare("SELECT * FROM emergency where id= :post_id");
                            $result->bindParam(':post_id', $id);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){                        
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Emergency Report Details</h5>
                                <p class="card-subtitle text-muted">Emergency ID: <?php echo htmlspecialchars($row['emergency_id'] ?? 'N/A'); ?></p>
                            </div>
                            <div class="card-body">
                                <form action="update_status.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Emergency ID</label>
                                                <h5><?php echo htmlspecialchars($row['emergency_id'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Reported On</label>
                                                <h5>
                                                    <?php 
                                                    if(isset($row['dates']) && !empty($row['dates'])) {
                                                        echo date('F j, Y h:i A', strtotime($row['dates']));
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Reporter Name</label>
                                                <h5><?php echo htmlspecialchars($row['name'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Contact Number</label>
                                                <h5>
                                                    <?php if(isset($row['phone_number']) && !empty($row['phone_number'])): ?>
                                                        <a href="tel:<?php echo htmlspecialchars($row['phone_number']); ?>">
                                                            <?php echo htmlspecialchars($row['phone_number']); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Email Address</label>
                                                <h5>
                                                    <?php if(isset($row['email']) && !empty($row['email'])): ?>
                                                        <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>">
                                                            <?php echo htmlspecialchars($row['email']); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Assigned Agency</label>
                                                <h5><?php echo htmlspecialchars($row['agency_name'] ?? 'N/A'); ?></h5>
                                                <?php if(isset($row['agency_phone']) && !empty($row['agency_phone'])): ?>
                                                <small class="text-muted">
                                                    Agency Contact: 
                                                    <a href="tel:<?php echo htmlspecialchars($row['agency_phone']); ?>">
                                                        <?php echo htmlspecialchars($row['agency_phone']); ?>
                                                    </a>
                                                </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Emergency Type</label>
                                                <h5><?php echo htmlspecialchars($row['emergency_category'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Case Severity</label>
                                                <?php 
                                                if(isset($row['case_severity']) && !empty($row['case_severity'])) {
                                                    $severity_class = '';
                                                    if($row['case_severity'] == 'Danger') $severity_class = 'badge-danger';
                                                    elseif($row['case_severity'] == 'Critical') $severity_class = 'badge-warning';
                                                    else $severity_class = 'badge-info';
                                                    
                                                    echo '<h5><span class="badge ' . $severity_class . '">' . 
                                                         htmlspecialchars($row['case_severity']) . 
                                                         '</span></h5>';
                                                } else {
                                                    echo '<h5><span class="badge badge-secondary">N/A</span></h5>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Location - State</label>
                                                <h5><?php echo htmlspecialchars($row['state'] ?? 'N/A'); ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Status</label>
                                                <div class="form-group">
                                                    <select class="form-control" name="status" required>
                                                        <option value="Pending" <?php echo (isset($row['status']) && $row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="Resolved" <?php echo (isset($row['status']) && $row['status'] == 'Resolved') ? 'selected' : ''; ?>>Resolved</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Emergency Description</label>
                                                <div class="description-box p-3 bg-light rounded">
                                                    <?php 
                                                    if(isset($row['description']) && !empty($row['description'])) {
                                                        echo nl2br(htmlspecialchars($row['description']));
                                                    } else {
                                                        echo '<span class="text-muted">No description provided</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Full Address</label>
                                                <div class="address-box p-3 bg-light rounded">
                                                    <?php 
                                                    if(isset($row['address']) && !empty($row['address'])) {
                                                        echo nl2br(htmlspecialchars($row['address']));
                                                    } else {
                                                        echo '<span class="text-muted">No address provided</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Emergency Image -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Emergency Images</label>
                                                <div class="image-container text-center">
                                                    <?php if(isset($row['photo']) && !empty($row['photo'])): ?>
                                                        <img src="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" 
                                                             alt="Emergency Image" 
                                                             class="img-fluid rounded shadow"
                                                             style="max-height: 400px;"
                                                             onerror="this.src='../assets/img/default.jpg'">
                                                        <div class="mt-2">
                                                            <a href="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" 
                                                               target="_blank" 
                                                               class="btn btn-sm btn-outline-primary">
                                                                <i class="fa fa-expand"></i> View Full Size
                                                            </a>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="no-image p-4 bg-light rounded">
                                                            <i class="fa fa-image fa-3x text-muted mb-2"></i>
                                                            <p class="text-muted">No image uploaded for this emergency</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Additional Information -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="info-box mb-4">
                                                <label class="form-label text-muted">Additional Information</label>
                                                <div class="additional-info p-3 bg-light rounded">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <strong>Report ID:</strong> <?php echo htmlspecialchars($row['id'] ?? 'N/A'); ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Agency ID:</strong> <?php echo htmlspecialchars($row['agency_id'] ?? 'N/A'); ?>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Victim ID:</strong> <?php echo htmlspecialchars($row['victim_id'] ?? 'N/A'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <?php if(isset($row['phone_number']) && !empty($row['phone_number'])): ?>
                                                    <a href="tel:<?php echo htmlspecialchars($row['phone_number']); ?>" 
                                                       class="btn btn-success">
                                                        <i class="fa fa-phone"></i> Call Reporter
                                                    </a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if(isset($row['agency_phone']) && !empty($row['agency_phone'])): ?>
                                                    <a href="tel:<?php echo htmlspecialchars($row['agency_phone']); ?>" 
                                                       class="btn btn-warning">
                                                        <i class="fa fa-phone"></i> Call Agency
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-save"></i> Update Status
                                                    </button>
                                                    <a href="view-emergency.php" class="btn btn-secondary">
                                                        <i class="fa fa-times"></i> Cancel
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        var status = document.querySelector('select[name="status"]').value;
        if(!status) {
            e.preventDefault();
            alert('Please select a status');
            return false;
        }
        return true;
    });
    </script>
</body>
</html>