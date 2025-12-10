<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>   
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
												<img alt="" src="../assets/img/user.jpg">
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
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
			<?php include 'includes/message.php'; ?>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>


<!-- add-doctor24:06-->
</html>
