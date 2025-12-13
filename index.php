<?php
include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Management System - Rapid Response</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-shield-alt"></i> Rapid Response EMS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alerts">Active Alerts</a></li>
                    <li class="nav-item"><a class="nav-link" href="#report">Report Emergency</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-light btn-md" href="sign-in.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section text-white py-5">
        <div class="container-fluid position-relative overflow-hidden">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 z-3">
                    <h1 class="display-3 fw-bold mb-4">Emergency Management System</h1>
                    <p class="lead mb-4">Fast, reliable emergency response coordination at your fingertips.  24/7 support for critical situations.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#emergencyModal">
                            <i class="fas fa-phone"></i> Report Emergency
                        </button>
                        <a href="#services" class="btn btn-outline-light btn-lg">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-animation">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="stats-section py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <h3 class="text-danger">24/7</h3>
                        <p>Available Always</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <h3 class="text-danger">500+</h3>
                        <p>Emergency Responders</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <h3 class="text-danger">2min</h3>
                        <p>Average Response Time</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <h3 class="text-danger">98%</h3>
                        <p>Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Our Emergency Services</h2>
                <p class="lead text-muted">Comprehensive emergency response solutions for all situations</p>
            </div>
            <div class="row g-4">
                <!-- Medical Emergency -->
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <h4>Medical Emergency</h4>
                        <p>Rapid medical response, ambulance dispatch, and emergency care coordination for critical health situations.</p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Learn More</a>
                    </div>
                </div>
                <!-- Fire Emergency -->
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h4>Fire Emergency</h4>
                        <p>Immediate fire department dispatch, hazmat response, and incident command coordination. </p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Learn More</a>
                    </div>
                </div>
                <!-- Security Threat -->
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Security Threat</h4>
                        <p>Law enforcement coordination, threat assessment, and public safety protocols activation.</p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Learn More</a>
                    </div>
                </div>
                <!-- Natural Disaster -->
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-cloud-bolt"></i>
                        </div>
                        <h4>Natural Disaster</h4>
                        <p>Disaster response coordination, evacuation assistance, and emergency shelter management.</p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Learn More</a>
                    </div>
                </div>
                <!-- Traffic Accident -->
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-car-crash"></i>
                        </div>
                        <h4>Traffic Accident</h4>
                        <p>Vehicle incident response, traffic management, and victim assistance coordination.</p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Learn More</a>
                    </div>
                </div>
                <!-- Missing Person -->
                <div class="col-md-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>Missing Person</h4>
                        <p>Search and rescue operations, public alerts, and coordinated investigation support.</p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Agencies Section - Simple Version -->
    <section id="agencies" class="agencies-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Our Emergency Agencies</h2>
                <p class="lead text-muted">Quick access to emergency services in your area</p>
            </div>
            
            <div class="row g-4">
                <?php 
                // include 'includes/connect.php';
                $result = $db->prepare("SELECT * FROM agency ORDER BY id DESC LIMIT 6");
                $result->execute();
                
                while($row = $result->fetch()):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="agency-simple card h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <img src="uploads/<?php echo $row['photo']; ?>" 
                                    alt="<?php echo $row['agency_name']; ?>" 
                                    class="rounded-circle mb-3"
                                    width="80" height="80"
                                    style="object-fit: cover;"
                                    onerror="this.src='assets/img/default-agency.jpg'">
                                <h5 class="card-title"><?php echo $row['agency_name']; ?></h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    <?php echo $row['state']; ?>
                                </p>
                            </div>
                            
                            <div class="agency-contact mb-3">
                                <p class="mb-1">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    <strong>Emergency:</strong> <?php echo $row['phone_number']; ?>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    <strong>Contact:</strong> <?php echo $row['personincharge']; ?>
                                </p>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="tel:<?php echo $row['phone_number']; ?>" 
                                class="btn btn-outline-danger">
                                    <i class="fas fa-phone me-1"></i> Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            
            <!-- View All Agencies Button -->
            <div class="text-center mt-5">
                <a href="agencies.php" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-list me-2"></i>View All Agencies
                </a>
            </div>
        </div>
    </section>
    <!-- Active Alerts Section -->
    <section id="alerts" class="alerts-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Active Alerts</h2>
                <p class="lead text-muted">Current emergency situations and safety advisories</p>
            </div>
            <div class="row g-4" id="alertsContainer">
                <!-- Alerts will be dynamically loaded here -->
            </div>
        </div>
    </section>

    <!-- Report Emergency Section -->
    <section id="report" class="report-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h2 class="display-5 fw-bold mb-4">Report an Emergency</h2>
                    <p class="lead mb-4">Quickly report an emergency and get immediate assistance from our response team.</p>
                    <div class="emergency-info">
                        <div class="info-item mb-4">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>Real-time GPS location tracking</span>
                        </div>
                        <div class="info-item mb-4">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>Immediate responder dispatch</span>
                        </div>
                        <div class="info-item mb-4">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>Live status updates</span>
                        </div>
                        <div class="info-item mb-4">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>Multi-language support</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form id="emergencyForm" class="emergency-form">
                        <div class="mb-3">
                            <label for="emergencyType" class="form-label">Emergency Type</label>
                            <select class="form-select" id="emergencyType" required>
                                <option value="">Select emergency type... </option>
                                <option value="medical">Medical Emergency</option>
                                <option value="fire">Fire Emergency</option>
                                <option value="security">Security Threat</option>
                                <option value="accident">Traffic Accident</option>
                                <option value="disaster">Natural Disaster</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="emergencyLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="emergencyLocation" placeholder="Enter emergency location" required>
                        </div>
                        <div class="mb-3">
                            <label for="emergencyDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="emergencyDescription" rows="4" placeholder="Describe the emergency situation..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="emergencyContact" class="form-label">Your Contact Number</label>
                            <input type="tel" class="form-control" id="emergencyContact" placeholder="Enter your phone number" required>
                        </div>
                        <button type="submit" class="btn btn-danger btn-lg w-100">
                            <i class="fas fa-exclamation-triangle"></i> Submit Emergency Report
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Get in Touch</h2>
                <p class="lead text-muted">Contact us for non-emergency inquiries and general information</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="contact-card">
                        <i class="fas fa-phone text-danger"></i>
                        <h5>Emergency Hotline</h5>
                        <p class="fw-bold">911</p>
                        <p class="text-muted">Available 24/7</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="contact-card">
                        <i class="fas fa-envelope text-danger"></i>
                        <h5>Email</h5>
                        <p><a href="mailto:emergency@rapidresponse.com">emergency@rapidresponse.com</a></p>
                        <p class="text-muted">Response within 1 hour</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="contact-card">
                        <i class="fas fa-map-marker-alt text-danger"></i>
                        <h5>Headquarters</h5>
                        <p>123 Emergency Ave<br>Safety City, SC 12345</p>
                        <p class="text-muted">United States</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <h5><i class="fas fa-shield-alt"></i> Rapid Response EMS</h5>
                    <p class="text-muted">Leading emergency management solutions for communities worldwide. </p>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#home" class="text-muted text-decoration-none">Home</a></li>
                        <li><a href="#services" class="text-muted text-decoration-none">Services</a></li>
                        <li><a href="#alerts" class="text-muted text-decoration-none">Alerts</a></li>
                        <li><a href="#contact" class="text-muted text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Resources</h6>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#" class="text-muted text-decoration-none">Safety Tips</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Training</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Documentation</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Follow Us</h6>
                    <div class="social-links">
                        <a href="#" class="text-danger me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-danger me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-danger me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-danger"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center text-muted">
                <p>&copy; 2025 Rapid Response Emergency Management System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Emergency Report Modal -->
    <div class="modal fade" id="emergencyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Emergency Report</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">For immediate life-threatening emergencies, please call <strong>911</strong> directly.</p>
                    <p>Use this form to report other emergency situations that require coordination and response.</p>
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-info-circle"></i> Your location will be automatically detected for faster response.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="document.getElementById('report').scrollIntoView({behavior: 'smooth'});">
                        <i class="fas fa-plus"></i> Report Emergency
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Details Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="alertModalTitle">Alert Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="alertModalBody">
                    <!-- Alert details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>