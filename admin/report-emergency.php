<?php 
include 'includes/head.php'; 
?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
          
        <div class="page-wrapper">
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    Your emergency report has been submitted successfully.
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['failed'])): ?>
                <div class="alert alert-danger">
                    Failed to submit emergency report. Please try again.
                </div>
            <?php endif; ?>
            
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Report Emergency</h4>
                    </div>
                </div>
                
                <div class="row"> 
                    <div class="col-lg-8 offset-lg-2">
                        <form action="save_emergency.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency ID</label>
                                        <input class="form-control" type="text" name="emergency_id" value="<?php echo rand(1000,9999); ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agency Name</label>
                                        <select class="select" name="agency_id">
                                            <option>Select Agency</option>
                                            <?php
                                            $result = $db->prepare("SELECT * FROM agency ");
                                            $result->execute();
                                            while($row = $result->fetch()):   
                                            ?> 
                                            <option value="<?php echo $row['agency_id']; ?>"><?php echo $row['agency_name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Case Severity</label>
                                        <select class="select" name="case_severity">
                                            <option>Select Severity</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Critical">Critical</option>
                                            <option value="Danger">Danger</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Category</label>
                                        <select class="select" name="emergency_category">
                                            <option>Select Category</option>
                                            <?php
                                            $result = $db->prepare("SELECT * FROM emergency_type ");
                                            $result->execute();
                                            while($row = $result->fetch()):   
                                            ?> 
                                            <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select name="state" class="select">
                                        <option value="">Select State</option>
                                        <option value="Abuja">Abuja FCT</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Kano">Kano</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                        <option value="Cross River">Cross River</option>
                                        <option value="Imo">Imo</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kogi">Kogi</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Abia">Abia</option>
                                        <option value="Kwara">Kwara</option>
                                        <option value="Zamfara">Zamfara</option>
                                        <option value="Gombe">Gombe</option>
                                        <option value="Yobe">Yobe</option>
                                        <option value="Nassarawa">Nassarawa</option>
                                        <option value="Jigawa">Jigawa</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" name="phone_number" value="<?php echo $_SESSION['SESS_PHONE_NUMBER'];?>" type="text" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" value="<?php echo $_SESSION['SESS_FIRST_NAME'];?>" readonly type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control" name="dates" value="<?php echo date('d-m-Y'); ?>" readonly type="text">
                                    </div> 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" value="<?php echo $_SESSION['SESS_EMAIL'];?>" readonly type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload image of emergency</label>
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
                                <label>Description</label>
                                <textarea cols="30" rows="4" name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea cols="30" rows="4" name="address" class="form-control"></textarea>
                            </div>
                            
                            <input type="hidden" name="victim_id" value="<?php echo $_SESSION['SESS_AGENCY_ID'];?>">
                            <input type="hidden" name="status" value="Pending">
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/message.php'; ?>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>