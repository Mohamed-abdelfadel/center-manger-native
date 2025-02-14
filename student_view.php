<?php
include('start.php');
include('navbar.php');
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'center_manger');


$location = $_GET["location"];

$student_id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$student_info = mysqli_query($connection, $sql);
$student_data = mysqli_fetch_assoc($student_info);

$sql_class = "SELECT * FROM classes WHERE id = '$student_id'";
$class_info = mysqli_query($connection, $sql_class);
$class_data = mysqli_fetch_assoc($class_info);
$group_id = $class_data['group_id'];
// echo $group_id ;
$sql_group = "SELECT * FROM groups WHERE id = '$group_id'";
$group_info = mysqli_query($connection, $sql_group);
$group_data = mysqli_fetch_assoc($group_info);
// print_r($group_data) ;
?>
    <div class="container box arabic">
        <div>
            <h1 class=" font-weight-bold text-success mt-5"> معلومات الطالب </h1>
        </div>
        <div class="row">

            <div class="form-group col-lg-12 mt-4">
                <label for="name">اسم الطالب</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $student_data['first_name']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name">اسم ولي الامر</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $student_data['last_name']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name">رقم ولي الامر </label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $student_data['phone']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name"> رقم المدرس</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $teacher_id; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name"> اسم المدرس</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $teacher_full_name; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name">المجموعه</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php if (isset($group_data['name'])) echo $group_data['name']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name">عدد ايام الحضور</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $student_data['attendance']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name">عدد ايام الغياب</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $student_data['absence']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-4">
                <label for="name">المصاريف</label>
                <input class="form-control mt-2" id="name" name="name" type="text"
                       placeholder="<?php echo $group_data['price']; ?>" disabled>
            </div>

            <div class="form-group col-lg-12 mt-2 d-flex justify-content-center">
                <a href="<?php echo $location; ?>" class="btn btn-danger col-lg-4 col-sm-10 m-3 p-3 "> عوده </a>
            </div>
        </div>
    </div>

<?php
include('end.php');
?>