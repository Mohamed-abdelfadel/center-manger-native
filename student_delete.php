<?php
$connection = mysqli_connect("Localhost", "root", "", "center_manger");
$student_id = $_GET["id"];
$action = $_GET["action"];

if ($action == "trash") {
    $sql = "UPDATE students SET active = 0 WHERE id = '$student_id'";
};
if ($action == "restore") {
    $sql = "UPDATE students SET active = 1 WHERE id = '$student_id'";
};
if ($action == "delete") {
    $sql = "DELETE FROM students WHERE id = '$student_id'";
};
if ($action == "remove_from_group") {
    $sql = "UPDATE classes SET group_id = 0 WHERE id = '$student_id'";
};

if ($action == "delete_group") {
    if ($student_id != 0) {
        $sql = "DELETE FROM groups WHERE id = '$student_id'";
    }
};


if ($action == "add") {
    echo $action;
};

mysqli_query($connection, $sql);
if ($action == "trash") {
    header("Location: students.php");
} else if ($action == "remove_from_group" or $action == "delete_group") {
    header("Location: student_groups.php");
} else {
    header("Location: student_deleted.php");
}
?>
