<?php
	session_start();
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
		$host = 'localhost';  // Database host
$username = 'root';  // Database username
$password = 'test';  // Database password
$dbname = 'widget_corp';  // Database name
$migration_folder = '../migracijas/';  // Directory to store the dump file

	// Create a timestamp for the filename
$timestamp = date('Y-m-d_H-i-s');  // Format: YYYY-MM-DD_HH-MM-SS

// Set the filename with the timestamp
$dump_filename = $migration_folder . 'dump_' . $timestamp . '.sql';

// Ensure the migrations folder exists
if (!is_dir($migration_folder)) {
    mkdir($migration_folder, 0777, true);  // Create directory if it doesn't exist
}

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Open the dump file for writing
$file = fopen($dump_filename, 'w');
if (!$file) {
    die("Unable to open the file for writing.");
}

// Write database dump header
fwrite($file, "-- Database dump of $dbname\n");
fwrite($file, "-- Generated on " . date('Y-m-d H:i:s') . "\n\n");

// Get the list of tables in the database
$tables_result = $conn->query("SHOW TABLES");

if (!$tables_result) {
    die("Failed to get table list: " . $conn->error);
}

// Iterate over each table and generate the dump
while ($table = $tables_result->fetch_array(MYSQLI_NUM)) {
    $table_name = $table[0];

    // Write the CREATE TABLE statement
    $create_table_result = $conn->query("SHOW CREATE TABLE `$table_name`");
    $create_table_row = $create_table_result->fetch_assoc();
    fwrite($file, "\n\n-- Table: $table_name\n");
    fwrite($file, $create_table_row['Create Table'] . ";\n\n");

    // Write the INSERT INTO statements
    $select_result = $conn->query("SELECT * FROM `$table_name`");
    $column_count = $select_result->field_count;

    while ($row = $select_result->fetch_row()) {
        $insert_values = [];
        for ($i = 0; $i < $column_count; $i++) {
            $insert_values[] = "'" . $conn->real_escape_string($row[$i]) . "'";
        }
        $insert_query = "INSERT INTO `$table_name` VALUES (" . implode(", ", $insert_values) . ");\n";
        fwrite($file, $insert_query);
    }
}

// Close the database connection and file
$conn->close();
fclose($file);

echo "Database dump created successfully: $dump_filename";

header("Location: ../login.php?success=2");
        exit();
	} else {
		header("Location: ../login.php");
    	exit();
	}
	
?>
