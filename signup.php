<?php  
$servername = "localhost";
$username = "root";
$password = "Teru_bozu5162";
$db = "fusion_gallery";

// Create connection
$conn = new mysqli($servername, $username, $password,$db,3307);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_name=$_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$users = "INSERT INTO user(email_address,username,password)
            VALUES('$email','$user_name','$hashed_password')";


if ($conn->query($users) === TRUE ) {
    echo "Successfully signed up.";
    header("Location: landingpage.html");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close the database connection
  $conn->close();




?>