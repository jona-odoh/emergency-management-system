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
                                        <label for="lga">LGA</label>
                                        <select name="state" id="state" class="select" required>
                                            <option value="" disabled selected>Select LGA</option>
                                            <option value="Adavi">Adavi</option>
                                            <option value="Ajaokuta">Ajaokuta</option>
                                            <option value="Ankpa">Ankpa</option>
                                            <option value="Bassa">Bassa</option>
                                            <option value="Dekina">Dekina</option>
                                            <option value="Ibaji">Ibaji</option>
                                            <option value="Idah">Idah</option>
                                            <option value="Igalamela-Odolu">Igalamela-Odolu</option>
                                            <option value="Ijumu">Ijumu</option>
                                            <option value="Kabba-Bunu">Kabba/Bunu</option>
                                            <option value="Kogi">Kogi</option>
                                            <option value="Lokoja">Lokoja</option>
                                            <option value="Mopa-Muro">Mopa-Muro</option>
                                            <option value="Ofu">Ofu</option>
                                            <option value="Ogori-Magongo">Ogori/Magongo</option>
                                            <option value="Okehi">Okehi</option>
                                            <option value="Okene">Okene</option>
                                            <option value="Olamaboro">Olamaboro</option>
                                            <option value="Omala">Omala</option>
                                            <option value="Yagba-East">Yagba East</option>
                                            <option value="Yagba-West">Yagba West</option>
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