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
                        <li class="active">
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
                        <h4 class="page-title">Add Admin</h4>
                    </div>
                </div>
                <?php if(get("success")):?>
                    <div>
                      <?=App::message("success", "Successful")?>
                    </div>
                    <?php endif;?>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="save_admin.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input class="form-control" type="text" name="name"  >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" type="text" name="phone"  >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="text" name="email"  >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input class="form-control" type="text" name="state"  >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" type="text" name="username"  >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Picture</label>
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label>Admin ID</label>
                                        <input class="form-control" type="text" name="agency_id" value="<?php echo rand(1000,9999); ?>" readonly="">
                                    </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Address</label>
                                <textarea cols="30" rows="4" name="address" class="form-control"></textarea>
                            </div>
                            
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                          
                        </form>
                    </div>
                </div>
                <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">All Admin</h4>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>State</th>
                                        <th>Address</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $loggedInAdminId = $_SESSION['SESS_MEMBER_ID']; // Get the ID of the currently logged-in admin

                                    $result = $db->prepare("SELECT * FROM admin WHERE id <> :loggedInAdminId");
                                    $result->bindParam(':loggedInAdminId', $loggedInAdminId);
                                    $result->execute();

                                    $i = 1;
                                    while ($row = $result->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><img src="../../uploads/<?php echo $row['photo']; ?>" class="rounded-circle m-r-5" width="28" height="28"></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['agency_id']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['state']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td class="text-right">
                                                <a class="btn btn-primary" href="delete_users.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

