<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <!-- Success/Error Messages -->
            <?php if(isset($_GET['success'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Agency has been deleted successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['failed'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Failed to delete agency.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">All Agencies</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-agency.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Agency</a>
                    </div>
                </div>
                
				<div class="row doctor-grid">
                    <?php 
                    if(!isset($_GET["page"])) {
                        $_GET["page"] = 1;
                    }
                    $tbl_name = "agency";
                    
                    // Get total count
                    $count_query = $db->prepare("SELECT COUNT(*) as total FROM $tbl_name");
                    $count_query->execute();
                    $count_result = $count_query->fetch();
                    $total_pages = $count_result['total'];
                    
                    // Pagination setup
                    $targetpage = "agency.php";
                    $limit = 10;
                    $page = $_GET['page'];
                    
                    if($page) {
                        $start = ($page - 1) * $limit;
                    } else {
                        $start = 0;
                    }
                    
                    // Get data with pagination
                    $result = $db->prepare("SELECT * FROM agency ORDER BY id DESC LIMIT $start, $limit");
                    $result->execute();
                    
                    // Pagination variables
                    if ($page == 0) $page = 1;
                    $prev = $page - 1;
                    $next = $page + 1;
                    $lastpage = ceil($total_pages / $limit);
                    $lpm1 = $lastpage - 1;
                    ?>
                    
                    <?php for($i=1; $row = $result->fetch(); $i++): ?>
                    <div class="col-md-4 col-sm-4 col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="#">
                                    <img alt="" src="../uploads/<?php echo $row['photo']; ?>" onerror="this.src='../assets/img/default-agency.jpg'">
                                </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_agency_<?php echo $row['id']; ?>">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis">
                                <a href="#"><?php echo htmlspecialchars($row['agency_name']); ?></a>
                            </h4>
                            <div class="doc-prof">
                                <?php echo htmlspecialchars($row['email']); ?>, <?php echo htmlspecialchars($row['phone_number']); ?>
                            </div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> 
                                <?php echo htmlspecialchars($row['state']); ?>, <?php echo htmlspecialchars($row['address']); ?>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                
				<!-- Pagination -->
				<div class="row">
                    <div class="col-sm-12">
                        <div class="see-all">
                            <span class="see-all-btn">
                                Showing 
                                <?php 
                                $showing_start = $start + 1;
                                $showing_end = min($page * $limit, $total_pages);
                                echo $showing_start . " - " . $showing_end . " of " . $total_pages;
                                ?>
                            </span>
                            
                            <div class="btn-group">
                                <?php if($page > 1): ?>
                                    <a class="btn btn-default" href="?page=<?php echo $prev; ?>">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if($page < $lastpage): ?>
                                    <a class="btn btn-default" href="?page=<?php echo $next; ?>">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/message.php'; ?>
        </div>
        
        <!-- Generate delete modals for each agency -->
        <?php 
        // Re-query to get all agencies for modals
        $modals_result = $db->prepare("SELECT id FROM agency");
        $modals_result->execute();
        while($modal_row = $modals_result->fetch()):
        ?>
        <div id="delete_agency_<?php echo $modal_row['id']; ?>" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="../assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Agency?</h3>
						<div class="m-t-20"> 
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <a href="deleteagency.php?id=<?php echo $modal_row['id']; ?>" class="btn btn-danger">Delete</a>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endwhile; ?>
        
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>