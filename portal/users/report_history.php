<?php include 'includes/head.php'; ?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>    
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My History</h4>
                    </div>

                   
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box mb-0">
                            <h3 class="card-title">History</h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                     <?php
                $result = $db->prepare("SELECT * FROM emergency WHERE victim_id = {$_SESSION['SESS_USERS_ID']} AND status = 'Resolved'  ");
                $result->execute();
                for($i=1; $row = $result->fetch(); $i++){ 
               
               ?> 
                                   
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">You Reported <?php echo $row['case_severity']; ?> <?php echo $row['emergency_category']; ?> 
                                            <div class="timeline-content">at <?php echo $row['address']; ?>, <?php echo $row['state']; ?>
                                                <span class="time"><?php echo $row['date']; ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>
            
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- profile23:03-->
</html>