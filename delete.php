<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dbuser'; // Your database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);

    $sql = "DELETE FROM user WHERE usr_no = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
