<?php  

// Destroy the session
session_destroy();

// Redirect to the login page or any other page after logout
header("Location: landingpage.html");
exit();



?>