<div class="header">
			<div class="header-left">
				<a href="#" class="logo">
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>EMS</span>
				</a>
			</div>

			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <?php
                        // include('../connect.php');
                        $result = $db->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?> 


                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right"><?php echo $row['total'] ;?></span></a>
                <?php } ?>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                       
                        <div class="drop-scroll">
                            
                             <?php
                $result = $db->prepare("SELECT e.*, a.agency_name FROM emergency e INNER JOIN agency a ON e.agency_id = a.agency_id WHERE status = 'Pending' ORDER BY id DESC ");
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){   
               ?> 
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="make_action.php?id=<?php echo $row['id'];?>"> 
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">They is a <?php echo $row['case_severity'] ?> emergency at <span class="noti-title"><?php echo $row['address'] ?>, <?php echo $row['state'] ?></span> the <span class="noti-time"><?php echo $row['agency_name'] ?></span> is needed</p>
												<p class="noti-time"><span class="notification-time"><?php echo $row['date'] ?></span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                
                            </ul>
                            <?php } ?>
                        </div>
                        
                        <div class="topnav-dropdown-footer">
                            <a href="view-emergency.php">View all Emergency</a>
                        </div>
                    </div>
                </li>
                
                <li class="nav-item dropdown has-arrow">
                    
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <?php
                            if (!empty($_SESSION['SESS_PRO_PIC'])) {
                                echo '<img class="rounded-circle" src="../../uploads/' . $_SESSION['SESS_PRO_PIC'] . '" width="24" alt="Admin">';
                            } else {
                                echo '<img class="rounded-circle" src="../../uploads/default.jpg" width="24" alt="Admin">';
                            }
                            ?>
                            <span class="status online"></span>
                        </span>


						<span><?php echo $_SESSION['SESS_FIRST_NAME'];?></span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<!-- <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a> -->
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                   <!--  <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a> -->
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>