<?php
$conn = new mysqli("localhost", "root", "", "dormitory");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>