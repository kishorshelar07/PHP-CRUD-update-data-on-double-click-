<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dbuser'; // Your database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['usr_id']) && isset($_POST['usr_name']) && isset($_POST['usr_email'])) {
    $usr_id = $conn->real_escape_string($_POST['usr_id']);
    $usr_name = $conn->real_escape_string($_POST['usr_name']);
    $usr_email = $conn->real_escape_string($_POST['usr_email']);

    $sql = "INSERT INTO user (usr_id, usr_name, usr_email) VALUES ('$usr_id', '$usr_name', '$usr_email')";

    if ($conn->query($sql) === TRUE) {
        echo "User added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
