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
                        <li class="active">
                            <a href="agency.php"><i class="fa fa-user-md"></i> <span>Agency</span></a>
                        </li>
                        <li>
                            <a href="emergency_type.php"><i class="fa fa-wheelchair"></i> <span>Emergency Types</span></a>
                        </li>
                        <?php
                        // include('../connect.php');
                        $result = $db->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>  
                        <li>
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
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Agency</h4>
                    </div>
                </div>
                 <?php if(get("success")):?>
                    <div>
                      <?=App::message("success", "Agency has been added successfully")?>
                    </div>
                    <?php endif;?>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="save_agency.php" enctype="multipart/form-data">
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agency ID</label>
                                        <input class="form-control" type="text" name="agency_id" value="<?php echo rand(1000,9999); ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Agency Name</label>
                                        <input class="form-control" name="agency_name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Emergency Number</label>
                                        <input class="form-control" name="phone_number" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Person in Charge</label>
                                        <input class="form-control" name="personincharge" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="password" type="password">
                                    </div>
                                </div>								
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input class="form-control" name="state" type="text">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
									<div class="form-group">
										<label>Logo</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" name="photo" class="form-control">
											</div>
										</div>
									</div>
                                </div>
                            </div>
							<div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" rows="3" cols="30"></textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Add Agency</button>
                            </div>
                        </form>
                    </div>
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
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-doctor24:06-->
</html>
