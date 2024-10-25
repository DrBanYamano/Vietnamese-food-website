<?php
// config.php
session_start();
define('SITEURL', 'http://localhost/food_order/'); // Ensure the URL ends with a slash
// Database connection details (as before)
define('LOCALHOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USERNAME', getenv('DB_USERNAME') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'food_order');

// Database connection code (as before)
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
    error_log("Database connection error: " . mysqli_connect_error());
    die('Database connection failed. Please try again later.');
}

$db_select = mysqli_select_db($conn, DB_NAME);
if (!$db_select) {
    error_log("Database selection error: " . mysqli_error($conn));
    die('Database selection failed. Please try again later.');
}
?>
