// tests/DatabaseTest.php
<?php

use PHPUnit\Framework\TestCase;
require_once(__DIR__ . '/../includes/constants.php');
//require_once '../includes/constants.php';  // Make sure this path is correct

class TestDatabaseConnection extends TestCase
{
    protected $conn;

    // Set up a connection before each test
    protected function setUp(): void
    {
        $this->conn = new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    }

    // Test that the connection works
    public function testDatabaseConnection()
    {
    	 $this->assertNotNull($this->conn);
    }
    
    public function testDatabaseQuery()
    {
        // Run a query to fetch all subjects
        $query = "SELECT * FROM subjects ORDER BY position ASC";
        $subject_set = $this->conn->query($query);

        // Ensure the query was successful and we got a result set
        $this->assertTrue($subject_set instanceof mysqli_result);

        // Fetch and dump results (optional, for debugging)
        while ($subject = mysqli_fetch_array($subject_set)) {
            //var_dump($subject); // Dump each result row
        }

        // Optionally, check if results are returned (e.g., check number of rows)
        $this->assertGreaterThan(0, $subject_set->num_rows, "No subjects found.");
    }


    // Optionally, you can test specific queries or constraints
    

    // Close the connection after each test
    protected function tearDown(): void
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
