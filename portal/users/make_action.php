<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Emergency Detail</h4>
                    </div>
                </div>
                <?php if(get("success")):?>
                    <div>
                      <?=App::message("success", "Your request has been successfully submitted help is on the way")?>
                    </div>
                    <?php endif;?>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?php
               $id=$_GET['id'];
    $result = $db->prepare("SELECT * FROM emergency where id= :post_id");
    $result->bindParam(':post_id', $id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){                        
?>
                    <form action="" method="post" enctype="multipart/form-data">
                     <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency ID</label>
                                        <input class="form-control" type="text"  value="<?php echo $row['emergency_id']; ?>" readonly="">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                       <input class="form-control" type="text"  value="<?php echo $row['name']; ?>" readonly="">
                                    </div>
                                </div> 
                            
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Case Severity</label>
                                        <input class="form-control" type="text"  value="<?php echo $row['case_severity']; ?>" readonly="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Category </label>
                                       <input class="form-control" type="text"  value="<?php echo $row['emergency_category']; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input class="form-control" type="text"  value="<?php echo $row['state']; ?>" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                       <input class="form-control" type="text"  value="<?php echo $row['phone_number']; ?>" readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                       <input class="form-control" type="text"  value="<?php echo $row['email']; ?>" readonly="">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input class="form-control" type="text"  value="<?php echo $row['status']; ?>" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Description</label>
                                    <p readonly><?php echo $row['description']; ?></p> 
                                
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <p readonly><?php echo $row['address']; ?></p>
                                    
                                    </div>
                                </div>
                            </div><br><br>

                            <div style="text-align:center;">
                                <h3>Emergency Image</h3>
                                <?php
                                if (!empty($row['photo'])) {
                                    echo '<img src="../../uploads/' . $row['photo'] . '" width="500px" height="300px">';
                                } else {
                                    echo '<img src="../../img/default.jpg" width="500px" height="300px">';
                                }
                                ?>
                            </div>

                                
                                <br>
                            


                             
                            
                           


                        </form>
                    <?php } ?>
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
	<script>
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'

                });
            });
     </script>
</body>


<!-- add-appointment24:07-->
</html>
