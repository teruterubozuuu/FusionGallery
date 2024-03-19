<?php  

$servername = "localhost";
$username = "root";
$password = "Teru_bozu5162";
$db = "fusion_gallery";

// Create connection
$conn = new mysqli($servername, $username, $password,$db,3307);

$email = $_POST['email'];
$password = $_POST['password'];
//$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else {
    $stmt = $conn->prepare("select * from user where email_address = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) { 
        $data = $stmt_result->fetch_assoc();
        if(password_verify($password, $data['password'])) {
            session_start();
            header("Location: home.html");
            exit(); // Add exit() to stop further execution
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}

?>