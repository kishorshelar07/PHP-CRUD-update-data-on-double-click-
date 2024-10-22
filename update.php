<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dbuser'; // Your database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id']) && isset($_POST['column']) && isset($_POST['value'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $column = $conn->real_escape_string($_POST['column']);
    $value = $conn->real_escape_string($_POST['value']);

    $sql = "UPDATE user SET $column = '$value' WHERE usr_no = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
