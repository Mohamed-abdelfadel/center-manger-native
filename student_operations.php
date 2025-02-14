<?php
$connection = mysqli_connect("Localhost", "root", "", "center_manger");
$student_id = $_GET["id"];
$action = $_GET["action"];
$value = $_GET["value"];

if (isset($action)) {
    $sql = "UPDATE students SET paid = (paid+$value) WHERE id = $student_id";
    $query = mysqli_query($connection, $sql);
    header("Location:student_bills.php");
}


?>
