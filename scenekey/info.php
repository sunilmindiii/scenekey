 <?php
$servername = "69.28.75.159";
$username = "root";
$password = "scenekey@mindiii";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    echo $conn->connect_error;
}
echo "Connected successfully";
?> 