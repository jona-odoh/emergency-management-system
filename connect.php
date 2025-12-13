<?php
// Configuration
$projectName = "EMERGENCY MANAGEMENT SYSTEM";
$projectShortName = "EMS";
$developerName = "Jonathan Odoh";
$version = "2.0";
$lastUpdated = "December 2025";

// Database Configuration
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_database = "ems";
$db_charset = "utf8mb4";

// Database connection options
$db_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
    PDO::ATTR_PERSISTENT => false // Set to true for persistent connections if needed
];

// Include ORM if it exists
$orm_path = __DIR__ . "/idiorm.php";
if (file_exists($orm_path)) {
    include $orm_path;
    // Configure ORM if included
    ORM::configure("mysql:host={$db_host};dbname={$db_database};charset={$db_charset}");
    ORM::configure("username", $db_user);
    ORM::configure("password", $db_pass);
    ORM::configure("driver_options", [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
}

// Create database connections with improved error handling
try {
    // Create PDO connection
    $dsn = "mysql:host={$db_host};dbname={$db_database};charset={$db_charset}";
    $db = new PDO($dsn, $db_user, $db_pass, $db_options);
    
    // Create MySQLi connection for legacy compatibility
    $conn = mysqli_init();
    mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_database);
    
    if (mysqli_connect_errno()) {
        throw new Exception("MySQLi connection failed: " . mysqli_connect_error());
    }
    
    // Set MySQLi character set
    mysqli_set_charset($conn, $db_charset);
    
    // Create object-oriented MySQLi connection
    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);
    
    if ($mysqli->connect_errno) {
        throw new Exception("MySQLi OOP connection failed: " . $mysqli->connect_error);
    }
    
    $mysqli->set_charset($db_charset);
    
    // Test connections
    $db->query("SELECT 1");
    mysqli_query($conn, "SELECT 1");
    $mysqli->query("SELECT 1");
    
} catch (PDOException $e) {
    displayDatabaseError("PDO Exception", $e->getMessage());
} catch (mysqli_sql_exception $e) {
    displayDatabaseError("MySQLi Exception", $e->getMessage());
} catch (Exception $e) {
    displayDatabaseError("Connection Error", $e->getMessage());
}

/**
 * Display formatted database error page
 */
function displayDatabaseError($errorType, $errorMessage) {
    global $projectName, $projectShortName, $developerName, $version, $lastUpdated;
    
    // Log the error (in production, log to file instead of outputting)
    error_log("[$errorType] Database connection failed: " . $errorMessage);
    
    // Determine if we're in development or production
    $isDevelopment = ($_SERVER['SERVER_NAME'] === 'localhost' || 
                      $_SERVER['SERVER_NAME'] === '127.0.0.1' || 
                      isset($_GET['debug']));
    
    http_response_code(503); // Service Unavailable
    
    $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection Error - {$projectName}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .error-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 800px;
            width: 100%;
            overflow: hidden;
        }
        
        .error-header {
            background: linear-gradient(135deg, #f53d3d 0%, #d32f2f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .error-header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .error-header p {
            font-size: 1.1em;
            opacity: 0.9;
        }
        
        .error-content {
            padding: 40px;
        }
        
        .error-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            border-left: 5px solid #f53d3d;
        }
        
        .error-details h3 {
            color: #d32f2f;
            margin-bottom: 15px;
            font-size: 1.3em;
        }
        
        .error-code {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            margin-top: 15px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .error-footer {
            background: #f8f9fa;
            padding: 25px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 0.9em;
            color: #6c757d;
        }
        
        .error-footer strong {
            color: #495057;
            display: block;
            margin-bottom: 5px;
            font-size: 1.1em;
        }
        
        .developer-info {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #dee2e6;
        }
        
        .hidden {
            display: none;
        }
        
        @media (max-width: 768px) {
            .error-header h1 {
                font-size: 2em;
            }
            
            .error-content {
                padding: 20px;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-header">
            <h1>⚠️ Database Connection Error</h1>
            <p>Failed to connect to the database server</p>
        </div>
        
        <div class="error-content">
            <p>The system is currently unable to connect to the database. This could be due to:</p>
            <ul style="margin-left: 20px; margin-top: 10px; color: #495057;">
                <li>Database server is down or restarting</li>
                <li>Incorrect database credentials</li>
                <li>Network connectivity issues</li>
                <li>Database permissions issue</li>
            </ul>
            
            <div class="error-details">
                <h3>Error Details:</h3>
                <p><strong>Error Type:</strong> {$errorType}</p>
                <p><strong>Error Message:</strong> 
HTML;

    // Display error message based on environment
    if ($isDevelopment) {
        $html .= htmlspecialchars($errorMessage);
    } else {
        $html .= "Database connection failed. Please contact the administrator.";
    }
    
    $html .= <<<HTML
                </p>
                
HTML;

    if ($isDevelopment) {
        $html .= <<<HTML
                <div class="error-code">
                    Time: {$GLOBALS['lastUpdated']}<br>
                    File: {$_SERVER['PHP_SELF']}<br>
                    Host: {$_SERVER['HTTP_HOST']}
                </div>
HTML;
    }

    $html .= <<<HTML
            </div>
            
            <div class="actions">
                <a href="javascript:location.reload()" class="btn btn-primary">
                    🔄 Retry Connection
                </a>
                <a href="index.php" class="btn btn-secondary">
                    🏠 Return to Homepage
                </a>
HTML;

    if ($isDevelopment) {
        $html .= <<<HTML
                <button onclick="toggleConfig()" class="btn btn-secondary">
                    ⚙️ Show Configuration
                </button>
HTML;
    }

    $html .= <<<HTML
            </div>
            
HTML;

    if ($isDevelopment) {
        $html .= <<<HTML
            <div id="configDetails" class="error-details hidden">
                <h3>Current Configuration:</h3>
                <div class="error-code">
                    Host: {$GLOBALS['db_host']}<br>
                    Database: {$GLOBALS['db_database']}<br>
                    User: {$GLOBALS['db_user']}<br>
                    Charset: {$GLOBALS['db_charset']}
                </div>
            </div>
HTML;
    }

    $html .= <<<HTML
        </div>
        
        <div class="error-footer">
            <strong>{$projectName} ({$projectShortName})</strong>
            <p>Version: {$version} | Last Updated: {$lastUpdated}</p>
            <div class="developer-info">
                <p>Developer: {$developerName}</p>
                <p>📧 Jonathanodoh3140@gmail.com | 📞 +234 906 363 3140</p>
            </div>
        </div>
    </div>
    
    <script>
        function toggleConfig() {
            const config = document.getElementById('configDetails');
            config.classList.toggle('hidden');
        }
        
        // Auto-retry after 30 seconds
        setTimeout(() => {
            if (confirm('Would you like to retry the database connection?')) {
                location.reload();
            }
        }, 30000);
    </script>
</body>
</html>
HTML;
    
    die($html);
}

// Optional: Create a Database class for better organization
class Database {
    private static $pdo = null;
    private static $mysqli = null;
    private static $conn = null;
    
    public static function getPDO() {
        global $db;
        return $db;
    }
    
    public static function getMySQLi() {
        global $mysqli;
        return $mysqli;
    }
    
    public static function getConnection() {
        global $conn;
        return $conn;
    }
    
    /**
     * Execute a query with parameters (PDO)
     */
    public static function query($sql, $params = []) {
        $stmt = self::getPDO()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    /**
     * Execute a query and fetch all results
     */
    public static function fetchAll($sql, $params = []) {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * Execute a query and fetch one row
     */
    public static function fetchOne($sql, $params = []) {
        $stmt = self::query($sql, $params);
        return $stmt->fetch();
    }
    
    /**
     * Get last inserted ID
     */
    public static function lastInsertId() {
        return self::getPDO()->lastInsertId();
    }
    
    /**
     * Begin transaction
     */
    public static function beginTransaction() {
        return self::getPDO()->beginTransaction();
    }
    
    /**
     * Commit transaction
     */
    public static function commit() {
        return self::getPDO()->commit();
    }
    
    /**
     * Rollback transaction
     */
    public static function rollback() {
        return self::getPDO()->rollback();
    }
}

// Optional: Global helper functions
/**
 * Sanitize input data
 */
function sanitize($data) {
    global $conn;
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    $data = trim($data);
    $data = stripslashes($data);
    return mysqli_real_escape_string($conn, htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
}

/**
 * Check if database connection is active
 */
function isDatabaseConnected() {
    try {
        Database::getPDO()->query('SELECT 1');
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Set timezone (adjust as needed)
date_default_timezone_set('Africa/Lagos');

// Enable error reporting in development
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Optional: Set session settings for security
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');

?>