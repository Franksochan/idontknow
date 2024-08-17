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
 Steps to create your MySQL database and tables:

    1. Open your MySQL Shell.

    2. Switch to SQL mode by typing the following command:
    
       \sql

    3. Connect to your MySQL server running on localhost by entering:
    
       \connect root@localhost
       
       (This will prompt you to enter your MySQL root password to log in.)

    4. After successfully connecting, create your database with the following command:
    
       CREATE DATABASE user_db;
    
       (This command creates a new database named `user_db`. 
       If you prefer a different name, replace `user_db` with your chosen name.)

    5. Select your newly created database with:
    
       USE user_db;

    6. Now, create the `users` table by running the following command:
    
       CREATE TABLE users (
           id INT AUTO_INCREMENT PRIMARY KEY,     
           username VARCHAR(50) NOT NULL,         
           email VARCHAR(100) NOT NULL UNIQUE,    
           password VARCHAR(255) NOT NULL,        
           role ENUM('user', 'admin') NOT NULL DEFAULT 'user'  
       );

    7. After creating the `users` table, you can proceed to create the `posts` table:
    
       CREATE TABLE posts (
           id INT AUTO_INCREMENT PRIMARY KEY,                   
           user_id INT NOT NULL,                                
           category ENUM('Stress', 'Anxiety', 'Panic Attack', 'Depression') NOT NULL, 
           content TEXT NOT NULL,                              
           status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',  
           FOREIGN KEY (user_id) REFERENCES users(id)         
       );

    8. Your database and tables are now set up! You can start inserting data or querying the tables.
*/
?>
