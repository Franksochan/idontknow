<?php
// connect_db.php

// Database config
$servername = "localhost";  // Change to your database server
$username = "root";         // Change to your database username
$password = "johnlino123";  // Change to your database password
$dbname = "user_db";        // Change to your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*
    Steps to create your database and table:

    1. Open MySQL Shell.

    2. Run this command to create your database:
    
       CREATE DATABASE user_db;
    
       (This will make a new database called `user_db`—change the name if you want, but update `$dbname` here too.)

    3. Then, select your database with:
    
       USE user_db;

    4. Now, create the `users` table with this command (add more attributers depending on your use case):
    
       CREATE TABLE users (
           id INT AUTO_INCREMENT PRIMARY KEY, // Auto-incrementing ID
           username VARCHAR(50) NOT NULL,     // Username (can't be empty)
           email VARCHAR(100) NOT NULL UNIQUE,// Email (must be unique)
           password VARCHAR(255) NOT NULL     // Password (will store the hashed version)
       );

    5. Ayun lang.
*/
?>
