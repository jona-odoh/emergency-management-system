<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                
                <!-- Dashboard -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                    <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                
                <!-- Agency -->
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                $emergency_pages = ['agency.php', 'add-agency.php'];
                ?>

                <li class="<?php echo (in_array($current_page, $emergency_pages)) ? 'active' : ''; ?>">
                    <a href="agency.php"><i class="fa fa-user-md"></i> <span>Agency</span></a>
                </li>
                
                <!-- Emergency Types -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'emergency_type.php') ? 'active' : ''; ?>">
                    <a href="emergency_type.php"><i class="fa fa-wheelchair"></i> <span>Emergency Types</span></a>
                </li>
                
                <!-- View Emergency -->
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                $emergency_pages = ['view_emergency.php', 'make_action.php'];
                $result = $db->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'");
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                ?>
                <li class="<?php echo (in_array($current_page, $emergency_pages)) ? 'active' : ''; ?>">
                    <a href="view_emergency.php"><i class="fa fa-file"></i> <span>View Emergency</span> 
                        <span class="badge badge-pill bg-primary float-right"><?php echo $row['total']; ?></span>
                    </a>
                </li>
                <?php } ?>
                
                <!-- Reports Emergency -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'report-emergency.php') ? 'active' : ''; ?>">
                    <a href="report-emergency.php"><i class="fa fa-heartbeat"></i> <span>Reports Emergency</span></a>
                </li>
                
                <!-- Reports History -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'report_history.php') ? 'active' : ''; ?>">
                    <a href="report_history.php"><i class="fa fa-file-text-o"></i> <span>Reports History</span></a>
                </li>
                
                <!-- Manage Admin -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'users.php') ? 'active' : ''; ?>">
                    <a href="users.php"><i class="fa fa-user-plus"></i> <span>Manage Admin</span></a>
                </li>
                
                <!-- Project information -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'information.php') ? 'active' : ''; ?>">
                    <a href="information.php"><i class="fa fa-info-circle"></i> <span>Project information</span></a>
                </li>
                
                <!-- Logout -->
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'active' : ''; ?>">
                    <a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>