<?php 
include 'includes/head.php'; 
?>

<body>
    <div class="main-wrapper">
        <?php include 'includes/navigation.php'; ?>
        <?php include 'includes/sidebar.php'; ?>
          
        <div class="page-wrapper">
            <!-- Success/Error Messages -->
            <?php if(isset($_GET['success'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your emergency report has been submitted successfully. Help is on the way.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['failed'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Failed to submit emergency report. Please try again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['error']) && $_GET['error'] == 'file_upload'): ?>
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Failed to upload image. Please try again with a valid image file.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
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
                        <form action="save_emergency.php" method="post" enctype="multipart/form-data" id="emergencyForm" onsubmit="return validateForm()">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency ID</label>
                                        <input class="form-control" type="text" name="emergency_id" value="<?php echo 'EMG-' . rand(1000,9999) . '-' . date('Ymd'); ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agency Name <span class="text-danger">*</span></label>
                                        <select class="form-control select" name="agency_id" required>
                                            <option value="">Select Agency</option>
                                            <?php
                                            $result = $db->prepare("SELECT * FROM agency ORDER BY agency_name");
                                            $result->execute();
                                            while($row = $result->fetch()):   
                                            ?> 
                                            <option value="<?php echo $row['agency_id']; ?>"><?php echo htmlspecialchars($row['agency_name']); ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Case Severity <span class="text-danger">*</span></label>
                                        <select class="form-control select" name="case_severity" required>
                                            <option value="">Select Severity</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Critical">Critical</option>
                                            <option value="Danger">Danger</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Category <span class="text-danger">*</span></label>
                                        <select class="form-control select" name="emergency_category" required>
                                            <option value="">Select Category</option>
                                            <?php
                                            $result = $db->prepare("SELECT * FROM emergency_type ORDER BY name");
                                            $result->execute();
                                            while($row = $result->fetch()):   
                                            ?> 
                                            <option value="<?php echo htmlspecialchars($row['name']); ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <select name="state" class="form-control select" required>
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
                                            <!-- Add other states as needed -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input class="form-control" name="phone_number" value="<?php echo isset($_SESSION['SESS_PHONE_NUMBER']) ? htmlspecialchars($_SESSION['SESS_PHONE_NUMBER']) : ''; ?>" type="text" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" value="<?php echo isset($_SESSION['SESS_FIRST_NAME']) ? htmlspecialchars($_SESSION['SESS_FIRST_NAME']) : ''; ?>" readonly type="text">
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
                                        <input class="form-control" name="email" value="<?php echo isset($_SESSION['SESS_EMAIL']) ? htmlspecialchars($_SESSION['SESS_EMAIL']) : ''; ?>" readonly type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload image of emergency</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*">
                                            <label class="custom-file-label" for="photo">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">Max file size: 2MB. Allowed formats: JPG, PNG, GIF</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea cols="30" rows="4" name="description" class="form-control" required placeholder="Please describe the emergency in detail"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea cols="30" rows="4" name="address" class="form-control" required placeholder="Enter the exact location/address of the emergency"></textarea>
                            </div>
                            
                            <!-- Hidden Fields -->
                            <input type="hidden" name="victim_id" value="<?php echo isset($_SESSION['SESS_AGENCY_ID']) ? $_SESSION['SESS_AGENCY_ID'] : ''; ?>">
                            <input type="hidden" name="status" value="Pending">
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn" name="submit">Send Emergency Request</button>
                                <button type="reset" class="btn btn-secondary">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php include 'includes/message.php'; ?>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script>
    // File input label update
    document.getElementById('photo').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
    
    // Form validation
    function validateForm() {
        var description = document.getElementsByName('description')[0].value.trim();
        var address = document.getElementsByName('address')[0].value.trim();
        var agency = document.getElementsByName('agency_id')[0].value;
        var severity = document.getElementsByName('case_severity')[0].value;
        var category = document.getElementsByName('emergency_category')[0].value;
        var state = document.getElementsByName('state')[0].value;
        
        if (!agency || !severity || !category || !state || !description || !address) {
            alert('Please fill all required fields marked with *');
            return false;
        }
        
        if (description.length < 10) {
            alert('Please provide a more detailed description (at least 10 characters)');
            return false;
        }
        
        if (address.length < 5) {
            alert('Please provide a valid address');
            return false;
        }
        
        // File validation
        var fileInput = document.getElementById('photo');
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            var fileSize = file.size / 1024 / 1024; // in MB
            var validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
            
            if (!validTypes.includes(file.type)) {
                alert('Please upload only image files (JPG, PNG, GIF)');
                return false;
            }
            
            if (fileSize > 2) {
                alert('File size should not exceed 2MB');
                return false;
            }
        }
        
        return true;
    }
    
    // Auto-focus first empty required field
    $(document).ready(function() {
        $('form#emergencyForm').on('submit', function() {
            var emptyFields = $(this).find('select[required]:invalid, input[required]:invalid, textarea[required]:invalid');
            if (emptyFields.length > 0) {
                $(emptyFields[0]).focus();
            }
        });
    });
    </script>
</body>
</html>