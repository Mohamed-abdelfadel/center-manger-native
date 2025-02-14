<?php
include("start.php");
include("navbar.php");
?>

<?php
$connection = mysqli_connect('localhost', 'root', '', 'center_manger');
if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $teacher = $_SESSION['teacher_id'];
    $student_sql = "INSERT INTO students (first_name , last_name ,  phone  ) VALUE ('$fname' , '$lname'  , '$phone') ";
    $student_data = mysqli_query($connection, $student_sql);
    $student_id = "SELECT id FROM students ORDER BY id DESC LIMIT 1 ";
    $student_data_last = mysqli_query($connection, $student_id);
    $student_id_array = mysqli_fetch_assoc($student_data_last);
    $last_id = $student_id_array['id'];
    // echo $last_id . "<br>" . $teacher ;


    $sql_classes = "INSERT INTO classes (student_id , teacher_id) VALUE ('$last_id' , '$teacher')";
    $class_data = mysqli_query($connection, $sql_classes);

    // print_r(array_values($student_id_array));
    // header('Location:student_add.php') ;
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
if (isset($last_id)) {
    $sql2 = "SELECT * FROM `students` where id = '$last_id' ";
    $last_data = mysqli_query($connection, $sql2);
    $last_studnet = mysqli_fetch_assoc($last_data);
} else {
    $null = array("first_name" => "", "last_name" => "", "phone" => "");

    $last_studnet = $null;
}

//////////////////////// مهم فشخولا


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
                <label for="phone2">رقم ولي الامر :</label>
                <input class="form-control mt-2" type="text" placeholder="<?php echo $last_studnet['phone']; ?>"
                       disabled>
            </div>
            <div class="form-group col-lg-12 mt-4 d-flex justify-content-center">
                <a href="students.php" class="btn btn-primary m-1 col-6">جميع الطلاب</a>
                <a href="students.php" class="btn btn-danger  m-1 col-6">تعديل</a>
            </div>
        </div>
    </div>
</div>
<?php
include("end.php")
?>

