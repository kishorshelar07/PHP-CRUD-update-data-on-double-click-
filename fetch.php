<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dbuser'; // Your database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="editable" data-column="usr_id" data-id="'.$row['usr_no'].'">'.$row['usr_id'].'</td>';
        echo '<td class="editable" data-column="usr_name" data-id="'.$row['usr_no'].'">'.$row['usr_name'].'</td>';
        echo '<td class="editable" data-column="usr_email" data-id="'.$row['usr_no'].'">'.$row['usr_email'].'</td>';
        echo '<td><button class="delete-btn" data-id="'.$row['usr_no'].'">Delete</button></td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="4">No records found.</td></tr>';
}

$conn->close();
?>
