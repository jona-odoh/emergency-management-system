
<?php include 'includes/head.php'; ?>
<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    	<?php
		                // include('../connect.php');
						$result = $db->prepare("SELECT count(*) as total FROM emergency");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
		                ?>
                        <div class="dash-widget">
							<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
							<div class="dash-widget-info text-right">
								<h3><?php echo $row['total']; ?></h3>
								<span class="widget-title1">Emergency <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                        <?php } ?>
                    </div>
                
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    	<?php
		                // include('../connect.php');
						$result = $db->prepare("SELECT count(*) as total FROM users");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
		                ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $row['total'] ;?></h3>
                                <span class="widget-title2">Users <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    <?php } ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    	<?php
		                // include('../connect.php');
						$result = $db->prepare("SELECT count(*) as total FROM agency");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
		                ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $row['total'] ;?></h3>
                                <span class="widget-title3">Agency <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    	<?php
		                // include('../connect.php');
						$result = $db->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
		                ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $row['total'] ;?></h3>
                                <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Agency</h4> <a href="agency.php" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table mb-0">
										<thead class="">
											<tr>
												<th>Agency</th>
												<th>Contact</th>
												<th>Person In Charge</th>
												
											</tr>
										</thead>
										<tbody>
											<?php
			                $result = $db->prepare("SELECT * FROM agency ORDER BY id DESC Limit 5");
			                $result->execute();
			                for($i=1; $row = $result->fetch(); $i++){ 
			               
			               ?> 
											<tr>
												<td style="min-width: 200px;">
													 <a href="#" title=""><img src="../../uploads/<?php echo $row['photo']; ?>" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
													<h2><a href="#"><?php echo $row['agency_name']; ?> <span><?php echo $row['state']; ?></span></a></h2>
												</td>                 
												<td>
													<h5 class="time-title p-0"><?php echo $row['email']; ?></h5>
													<p><?php echo $row['phone_number']; ?></p>
												</td>
												<td>
													<h5 class="time-title p-0"><?php echo $row['personincharge']; ?></h5>
													<!-- <p>7.00 PM</p> -->
												</td>
												
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Users</h4>
							</div>
                            <div class="card-body">
			                 	<?php
			                $result = $db->prepare("SELECT * FROM users ");
			                $result->execute();
			                for($i=1; $row = $result->fetch(); $i++){ 
			               
			               ?> 
                                <ul class="contact-list">
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="#" title="John Doe"><img src="../../uploads/<?php echo $row['photo']; ?>" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis"><?php echo $row['name']; ?></span>
                                                <span class="contact-date"><?php echo $row['state']; ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            <?php } ?>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <!-- <a href="add_user" class="text-muted">Add Users</a> -->
                            </div>
                        </div>
                    </div>
				</div>
            </div>
            <?php include 'includes/Message.php'; ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>

</body>


<!-- index22:59-->
</html>