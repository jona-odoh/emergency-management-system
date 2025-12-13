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
                        <strong>Success!</strong> Agency has been added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['failed'])): ?>
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Failed to add agency. Please try again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Agency</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" action="save_agency.php" enctype="multipart/form-data" id="agencyForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agency ID</label>
                                        <input class="form-control" type="text" name="agency_id" value="AG-<?php echo rand(1000,9999); ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agency Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="agency_name" type="text" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Emergency Contact Number <span class="text-danger">*</span></label>
                                        <input class="form-control" name="phone_number" type="text" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" type="email" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Person in Charge <span class="text-danger">*</span></label>
                                        <input class="form-control" name="personincharge" type="text" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" name="username" type="text" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input class="form-control" name="password" type="password" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input class="form-control" name="confirm_password" type="password" required>
                                    </div>
                                </div>
                                
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
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="agencyLogo" name="photo" accept="image/*">
                                            <label class="custom-file-label" for="agencyLogo">Choose file</label>
                                        </div>
                                        <small class="form-text text-muted">Recommended size: 300x300px. Max file size: 2MB</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Add Agency</button>
                                <button type="reset" class="btn btn-secondary">Clear Form</button>
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
    document.getElementById('agencyLogo').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
    
    // Password confirmation validation
    document.getElementById('agencyForm').addEventListener('submit', function(e) {
        var password = document.getElementsByName('password')[0].value;
        var confirmPassword = document.getElementsByName('confirm_password')[0].value;
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
            document.getElementsByName('confirm_password')[0].focus();
            return false;
        }
        
        if (password.length < 6) {
            e.preventDefault();
            alert('Password must be at least 6 characters long!');
            document.getElementsByName('password')[0].focus();
            return false;
        }
        
        return true;
    });
    
    // Preview image before upload
    document.getElementById('agencyLogo').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imgElement = document.querySelector('.upload-img img');
                if (imgElement) {
                    imgElement.src = e.target.result;
                }
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>