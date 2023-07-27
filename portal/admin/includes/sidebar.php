<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
						<li>
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