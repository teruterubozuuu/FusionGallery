<?php
session_start(); // Start or resume existing session

$servername = "localhost";
$username = "root";
$password = "Teru_bozu5162";
$db = "fusion_gallery";

// Create connection
$conn = new mysqli($servername, $username, $password, $db, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imgTitle = $_POST['imgTitle'];
    $description = $_POST['textarea'];
    $category = $_POST['category'];
    $imgFile = $_FILES['imgFile']['tmp_name'];


        // Determine the table name based on the selected category
        switch ($category) {
            case "TraditionalArt":
                $tableName = "traditional_art";
                break;
            case "DigitalArt":
                $tableName = "digital_art";
                break;
            case "Photography":
                $tableName = "photography";
                break;
            default:
                // Handle invalid category selection
                echo "Invalid category selected";
                exit();
        }

        // Read the image file as binary data
        $imgData = file_get_contents($imgFile);

        // Insert data into the appropriate table without specifying the 'id' column
        $stmt = $conn->prepare("INSERT INTO $tableName (id,title, description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $imgTitle, $description, $imgData);
        if ($stmt->execute()) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
    } else {
        echo "Please select a category";
    }

    $stmt->close();
    $conn->close();



?>
