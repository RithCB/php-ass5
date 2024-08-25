<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get form data
$email = $_POST['email']; 
$password = $_POST['password']; 

// Database connection
$con = new mysqli("localhost", "root", "", "login");

// Check connection
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error); 
} else {
    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT * FROM credencial WHERE email = ?");
    $stmt->bind_param('s', $email); 
    $stmt->execute(); 
    $stmt_result = $stmt->get_result(); 

    // Check if user exists
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc(); 
        
        // Verify the password (assuming it's hashed)
        if ($data['password']===$password) {
            echo "<h1 style='text-align:center; size: 100px'>You successfully login!!</h1>
            <h2 style='text-align:center; color: red; '>Conducted by Soeun Sovannarith</h2>"; 
        } else {
            // echo "<h2>Invalid Email or Password</h2>";
            echo "<h1 style='text-align:center; color: red; margin-top:50px; '>Your Email or Password might be Invalid</h2>
            <h2 style='text-align:center; '>Conducted by Soeun Sovannarith</h2>";
            
        }
    } 
}

?>
