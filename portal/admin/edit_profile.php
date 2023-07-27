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
                        $result = $db->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>  
                        <li class="">
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Emergency Details</h4>
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
    $result = $db->prepare("SELECT * FROM admin where id= :post_id");
    $result->bindParam(':post_id', $id);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){                        
?>
<form action="update_admin.php" method="post" enctype="multipart/form-data"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Admin ID</label>
                                        <input class="form-control" type="text"  value="<?php echo $_SESSION['SESS_AGENCY_ID']; ?>">
                                    </div>
                                </div>
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                       <input class="form-control" type="text" name="name"  value="<?php echo $row['name']; ?>">
                                        
                                    </div>

                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input class="form-control" type="text" name="email" value="<?php echo $row['email']; ?>">
                                    </div>
                                
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number  </label>
                                       <input class="form-control" type="text" name="phone"  value="<?php echo $row['phone']; ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input class="form-control" type="text"  value="<?php echo $row['state']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>Upload image of emergency</label>
                                        <div class="profile-upload">
                                            <div class="upload-img">
                                                <img alt="" src="../../uploads/<?php echo $_SESSION['SESS_PRO_PIC'];?>">
                                            </div>
                                            <div class="upload-input">
                                                <input type="file" name="photo" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                            </div>


                           
                                
                         <div class="form-group">
                            <label>Address</label>
                            <textarea cols="30" rows="4" name="address" class="form-control"><?php echo $row['address']; ?></textarea>
                        </div>

                            

                                
                                <br>
                            


                             
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Status</button>
                            </div>
                          


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
