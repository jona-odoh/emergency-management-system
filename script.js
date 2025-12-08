// Sample Alerts Data
const alertsData = [
    {
        id: 1,
        title: 'Severe Weather Alert',
        severity: 'critical',
        location: 'Downtown District',
        timestamp: '2 hours ago',
        description: 'Tornado warning issued for downtown area. All residents in the affected zones should seek shelter immediately.  Emergency shelters have been activated at schools and community centers.',
        affectedAreas: ['Downtown', 'East Side', 'West End'],
        status: 'Active'
    },
    {
        id: 2,
        title: 'Traffic Accident - Highway 101',
        severity: 'high',
        location: 'Highway 101, Mile 45',
        timestamp: '45 minutes ago',
        description: 'Multi-vehicle accident blocking northbound lanes. Emergency services are on scene.  Expect delays and take alternate routes if possible.',
        affectedAreas: ['Highway 101 N'],
        status: 'Active'
    },
    {
        id: 3,
        title: 'Water Main Break',
        severity: 'medium',
        location: 'Central Avenue',
        timestamp: '30 minutes ago',
        description: 'Water service interrupted on Central Avenue between Main and Oak Streets. Repairs in progress. Estimated restoration time: 4 hours.',
        affectedAreas: ['Central Avenue'],
        status: 'In Progress'
    },
    {
        id: 4,
        title: 'Building Fire - Commercial District',
        severity: 'critical',
        location: 'Commercial District',
        timestamp: '15 minutes ago',
        description: 'Structure fire reported in the commercial district. Fire department has arrived and is battling the blaze. Nearby residents are being evacuated.',
        affectedAreas: ['Commercial District', 'Retail Park'],
        status: 'Active'
    },
    {
        id: 5,
        title: 'Power Outage',
        severity: 'high',
        location: 'North District',
        timestamp: '1 hour ago',
        description: 'Power outage affecting several blocks in the North District. Power company is investigating.  Temporary mobile generators have been deployed.',
        affectedAreas: ['North District'],
        status: 'Active'
    }
];

// Initialize alerts when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadAlerts();
    setupFormHandlers();
    setupScrollAnimation();
    initializeTooltips();
});

// Load and display alerts
function loadAlerts() {
    const alertsContainer = document.getElementById('alertsContainer');
    
    if (! alertsContainer) return;
    
    alertsContainer.innerHTML = '';
    
    alertsData.forEach((alert, index) => {
        const alertCard = createAlertCard(alert);
        alertsContainer.appendChild(alertCard);
        
        // Stagger animation
        setTimeout(() => {
            alertCard.classList.add('fade-in');
        }, index * 100);
    });
}

// Create alert card element
function createAlertCard(alert) {
    const card = document.createElement('div');
    card.className = 'col-lg-6 mb-4';
    card.innerHTML = `
        <div class="alert-card" onclick="showAlertDetails(${alert.id})">
            <span class="alert-badge ${alert.severity}">${alert.severity. toUpperCase()}</span>
            <div class="alert-title">${alert.title}</div>
            <div class="alert-meta">
                <i class="fas fa-map-marker-alt"></i> ${alert.location} | 
                <i class="fas fa-clock"></i> ${alert.timestamp}
            </div>
            <div class="alert-description">${alert.description}</div>
            <a href="#" class="text-danger" onclick="showAlertDetails(${alert.id}); return false;">
                View Details <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    `;
    return card;
}

// Show alert details in modal
function showAlertDetails(alertId) {
    const alert = alertsData.find(a => a.id === alertId);
    
    if (!alert) return;
    
    const modalTitle = document.getElementById('alertModalTitle');
    const modalBody = document.getElementById('alertModalBody');
    
    modalTitle.textContent = alert.title;
    
    const affectedAreasHTML = alert.affectedAreas.map(area => 
        `<span class="badge bg-danger me-2 mb-2">${area}</span>`
    ).join('');
    
    modalBody. innerHTML = `
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Severity:</strong> <span class="alert-badge ${alert.severity}">${alert.severity.toUpperCase()}</span></p>
                <p><strong>Location:</strong> ${alert. location}</p>
                <p><strong>Time:</strong> ${alert.timestamp}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Status:</strong> <span class="badge bg-success">${alert.status}</span></p>
            </div>
        </div>
        
        <div class="mb-4">
            <h6><i class="fas fa-info-circle"></i> Full Description</h6>
            <p>${alert.description}</p>
        </div>
        
        <div class="mb-4">
            <h6><i class="fas fa-map"></i> Affected Areas</h6>
            <div>${affectedAreasHTML}</div>
        </div>
        
        <div class="alert alert-info">
            <i class="fas fa-phone-alt"></i> If you need immediate assistance, call <strong>911</strong>
        </div>
        
        <button class="btn btn-danger w-100" onclick="reportAffectedArea()">
            <i class="fas fa-exclamation-triangle"></i> Report Affected Area
        </button>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('alertModal'));
    modal.show();
}

// Setup form handlers
function setupFormHandlers() {
    const emergencyForm = document.getElementById('emergencyForm');
    
    if (emergencyForm) {
        emergencyForm.addEventListener('submit', function(e) {
            e. preventDefault();
            handleEmergencyReport();
        });
    }
}

// Handle emergency report submission
function handleEmergencyReport() {
    const emergencyType = document.getElementById('emergencyType').value;
    const emergencyLocation = document.getElementById('emergencyLocation').value;
    const emergencyDescription = document.getElementById('emergencyDescription').value;
    const emergencyContact = document.getElementById('emergencyContact').value;
    
    if (! emergencyType || !emergencyLocation || !emergencyDescription || !emergencyContact) {
        showAlert('Please fill in all fields', 'warning');
        return;
    }
    
    // Validate phone number
    if (!isValidPhoneNumber(emergencyContact)) {
        showAlert('Please enter a valid phone number', 'warning');
        return;
    }
    
    // Simulate report submission
    const submitButton = event.target.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
    
    setTimeout(() => {
        submitButton.disabled = false;
        submitButton. innerHTML = originalText;
        
        // Show success message
        showAlert('Emergency reported successfully!  Response team has been notified.', 'success');
        
        // Reset form
        document.getElementById('emergencyForm').reset();
        
        // Log the report
        console.log('Emergency Report:', {
            type: emergencyType,
            location: emergencyLocation,
            description: emergencyDescription,
            contact: emergencyContact,
            timestamp: new Date().toISOString()
        });
    }, 2000);
}

// Show alert/toast message
function showAlert(message, type = 'info') {
    const alertHTML = `
        <div class="alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
             role="alert" style="z-index: 9999; min-width: 400px;">
            <i class="fas fa-${getIconForType(type)}"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = alertHTML;
    document.body.appendChild(tempDiv. firstElementChild);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert-dismissible');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}

// Get icon based on alert type
function getIconForType(type) {
    const icons = {
        'success': 'check-circle',
        'warning': 'exclamation-circle',
        'danger': 'times-circle',
        'info': 'info-circle'
    };
    return icons[type] || 'info-circle';
}

// Validate phone number
function isValidPhoneNumber(phone) {
    const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
    return phoneRegex.test(phone. replace(/\s/g, ''));
}

// Report affected area
function reportAffectedArea() {
    showAlert('Your affected area report has been recorded and will help us coordinate resources. ', 'success');
}

// Setup scroll animations
function setupScrollAnimation() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries. forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry. target);
            }
        });
    }, observerOptions);
    
    // Observe service cards and other elements
    document.querySelectorAll('.service-card, .stat-card, .contact-card').forEach(el => {
        observer.observe(el);
    });
}

// Initialize tooltips
function initializeTooltips() {
    // Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            const target = document.querySelector(href);
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Simulate real-time alerts (add new alerts periodically)
function simulateNewAlerts() {
    const newAlertsTitles = [
        'Gas Leak Alert',
        'Medical Emergency Zone',
        'Hazmat Incident',
        'Bridge Closure',
        'Evacuation Order'
    ];
    
    // Optional: Add new alerts every 5 minutes
    setInterval(() => {
        // This is just a simulation - in a real app, you'd receive alerts from a server
        console.log('Checking for new alerts...');
    }, 5 * 60 * 1000);
}

// Initialize real-time alerts
simulateNewAlerts();

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl+Shift+E to quickly open emergency modal
    if (e.ctrlKey && e.shiftKey && e.key === 'E') {
        e.preventDefault();
        const modal = new bootstrap.Modal(document.getElementById('emergencyModal'));
        modal.show();
    }
});

// Log app initialization
console.log('Emergency Management System initialized successfully');