<?php
include("start.php");
include("navbar.php");
?>

<?php

$connection = mysqli_connect('localhost', 'root', '', 'center_manger');
$teacher = $_SESSION['teacher_id'];
if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $group = $_POST['group'];
    $student_sql = "INSERT INTO students (first_name , last_name ,  phone  ) VALUE ('$fname' , '$lname'  , '$phone') ";
    $student_data = mysqli_query($connection, $student_sql);


    $student_id = "SELECT id FROM students ORDER BY id DESC LIMIT 1 ";
    $student_data_last = mysqli_query($connection, $student_id);
    $student_id_array = mysqli_fetch_assoc($student_data_last);
    $last_id = $student_id_array['id'];

    $sql_classes = "INSERT INTO classes (student_id , teacher_id , group_id) VALUE ('$last_id' , '$teacher' , '$group')";
    $class_data = mysqli_query($connection, $sql_classes);
    // header("Location: student_add.php");
}
$sql = "SELECT * FROM groups WHERE id > 0 AND teacher = $teacher ";
$group_data = mysqli_query($connection, $sql);

if (isset($last_id)) {
    $sql2 = "SELECT * FROM `students` where id = '$last_id' ";
    $last_data = mysqli_query($connection, $sql2);
    $last_studnet = mysqli_fetch_assoc($last_data);

} else {
    $null = array("first_name" => "لا يوجد", "last_name" => "لا يوجد", "phone" => "لا يوجد");

    $last_studnet = $null;
}
//////////////////////// مهم فشخولا

// $result = mysqli_query($connection , "SELECT * FROM `students` WHERE teacher_id = $teacher_id");
// $storeArray = Array();
// while ($row = mysqli_fetch_assoc($result)) {
//     $storeArray[] =  $row['id'];  
// }
// $last_id =  end($storeArray); ;
// // echo $last_id ;
// // echo $teacher_id ;

//////////////////////// مهم فشخولا
?>

<?php


?>
<div class="container box arabic">
    <div class="row">
        <div class="col-lg-6 col-sm-12 ">
            <form action="student_add.php" method="post">

                <h1 class=" font-weight-bold text-success mt-5">اضافه طالب</h1>

                <div class="form-group col-lg-10 mt-4">
                    <label for="fname">اسم الطالب :</label>
                    <input class="form-control mt-2" id="fname" name="fname" type="text" required>
                </div>

                <div class="form-group col-lg-10 mt-4">
                    <label for="lname">اسم ولي الامر :</label>
                    <input class="form-control mt-2" id="lname" name="lname" type="text" required>
                </div>

                <div class="form-group col-lg-10 mt-4">
                    <label for="teacher">المدرس :</label>
                    <input class="form-control mt-2" id="lname" name="teacher" type="text"
                           placeholder="<?php echo $teacher_full_name; ?>" disabled>
                </div>

                <div class="form-group col-lg-10 mt-4">
                    <label for="group">المجموعه :</label>
                    <select class="form-select col-3" name='group'>
                        <option value='0' selected>اختيار مجموعة</option>
                        <?php while ($group_info = mysqli_fetch_assoc($group_data)) { ?>
                            <option value="<?php if (isset($group_info)) {
                                echo $group_info['id'];
                            } ?>"><?php if (isset($group_info)) {
                                    echo $group_info['name'];
                                } ?></option>
                        <?php }; ?>
                    </select>
                </div>

                <div class="form-group col-lg-10 mt-4">
                    <label for="phone">رقم ولي الامر :</label>
                    <input class="form-control mt-2" id="phone" name="phone" type="text" required>
                </div>

                <div class="form-group col-lg-10 mt-4">
                    <button type="submit" class="btn btn-success col-12">إنشاء</button>
                </div>
            </form>
        </div>
        <div class="col-lg-6 col-sm-12 ">
            <h1 class=" font-weight-bold text-danger mt-5">معلومات اخر طالب</h1>

            <div class="form-group col-lg-9 mt-4">
                <label for="fname2">اسم الطالب :</label>
                <input class="form-control mt-2" type="text" placeholder="<?php echo $last_studnet['first_name']; ?>"
                       disabled>
            </div>

            <div class="form-group col-lg-9 mt-4">
                <label for="lname2">اسم ولي الامر :</label>
                <input class="form-control mt-2" type="text" placeholder="<?php echo $last_studnet['last_name']; ?>"
                       disabled>
            </div>

            <div class="form-group col-lg-9 mt-4">
                <label for="teacher2">المدرس :</label>
                <input class="form-control mt-2" type="text" placeholder="<?php if (isset($teacher_full_name)) {
                    echo $teacher_full_name;
                } ?>" disabled>
            </div>

            <div class="form-group col-lg-9 mt-4">
                <label for="group">المجموعه :</label>
                <input class="form-control mt-2" type="text" placeholder=" <?php if (isset($group)) {
                    echo $group;
                }; ?>" disabled>
            </div>

            <div class="form-group col-lg-9 mt-4">
                <label for="phone2">رقم ولي الامر :</label>
                <input class="form-control mt-2" type="text" placeholder="<?php echo $last_studnet['phone']; ?>"
                       disabled>
            </div>
            <div class="form-group col-lg-12 mt-4 d-flex justify-content-center">
                <a href="students.php" class="btn btn-primary m-1 col-6">جميع الطلاب</a>
                <a href="student_edit.php?id=<?php if (isset($last_id)) {
                    echo $last_id;
                } ?>" class="btn btn-danger  m-1 col-6">تعديل</a>
            </div>
        </div>
    </div>
</div>
<?php
include("end.php");

?>

