<?php
include('start.php');
include('navbar.php');
?>

<!-- $connection = mysqli_connect('localhost' , 'root' , '' , 'center_manger') ; 
$last_group_id = "SELECT * FROM classes WHERE teacher_id = '$teacher_id'" ;
$last_group_query = mysqli_query($connection, $last_group_id);

if(isset($last_group_query)){
  while($last_group_assoc = mysqli_fetch_assoc($last_group_query)){
    $groups[] = $last_group_assoc['group_id']  ;
  }
  // echo implode(',', $groups) ;
  $sql = "SELECT * FROM groups WHERE id > 0 AND id  IN (" . implode(',', $groups) . ")" ;
  $group_data = mysqli_query($connection , $sql) ;
} -->

<?php
$connection = mysqli_connect('localhost', 'root', '', 'center_manger');
$sql = "SELECT * FROM groups WHERE id > 0 AND teacher = $teacher_id ";
$group_data = mysqli_query($connection, $sql);

if (isset($_GET['group'])) {
    $group = $_GET['group'];
    $_SESSION['group'] = $group;
    $sql_title = "SELECT * FROM groups WHERE id = $group ";
    $group_data_title = mysqli_query($connection, $sql_title);
    $group_title = mysqli_fetch_assoc($group_data_title);
    // print_r($group_title) ;

}
$group_id = "SELECT id FROM groups ORDER BY id DESC LIMIT 1  ";
$group_data_last = mysqli_query($connection, $group_id);
$group_id_array = mysqli_fetch_assoc($group_data_last);
if (isset($group_id_array)) {
    $last_id = $group_id_array['id'];
}


if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $sql_add = "INSERT INTO groups (name , description , price , teacher) VALUE ('$name' ,' $description', $price  ,'$teacher_id' )";
    $add_group = mysqli_query($connection, $sql_add);
    header("Location:student_groups.php");
}


if (isset($last_id)) {
    $sql2 = "SELECT * FROM groups where id = '$last_id'  ";
    $last_data = mysqli_query($connection, $sql2);
    $last_group = mysqli_fetch_assoc($last_data);

}
// else{
//   $null = array("first_name"=> "", "last_name"=> "", "phone"=>"");

//   $last_studnet = $null ;
// }


?>
<?php
if (isset($_POST['exam'])) {
    $exam = $_POST['exam'];
    $group = $_SESSION['group'];
    $student_sql = "SELECT * FROM classes where group_id = '$group' ";
    $exam_query = mysqli_query($connection, $student_sql);
    while ($exam_info = mysqli_fetch_assoc($exam_query)) {
        if (isset($exam_info)) {
            $student_id2 = $exam_info['student_id'];
            $exam_sql = "UPDATE students SET exam = '$exam' WHERE ID = '$student_id2 ' ";
            $exam_query = mysqli_query($connection, $exam_sql);
        }
    }

}


// }

?>
<div class="container box arabic">
    <h1 class="font-weight-bold text-black mt-5">المجموعات</h1>
    <div class="row">
        <div class="col-12">
            <form action="student_exams.php" method="get">
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

                <div class="form-group col-lg-12 mt-2 d-flex justify-content-center">
                    <button class="btn btn-success col-lg-4 col-sm-10 m-3 p-3  ">بحث</button>
                </div>
            </form>
        </div>
    </div>


    <form action="student_exams.php" class="form-inline" method="POST">
        <div class="form-group row">
            <div class="col-lg-9 col-sm-12">
                <label for="fname" class="col-lg-2  col-sm-4">تعيين الدرجه النهائيه </label>
                <input type="text" name="exam" class=" col-lg-2 p-1 col-sm-2">
                <button type="submit" class=" btn btn-success  col-lg-2 col-sm-3">تعيين</button>
            </div>
        </div>
    </form>


    <?php if (isset($group_title['id']) && isset($group_title['name'])) {
        $student_group_id = $group_title['id'];
        $student_group_name = $group_title['name'];
        $student_group_price = $group_title['price'];
        $student_group_description = $group_title['description'];

        ?>
        <div class='row'>
            <h5 class="font-weight-bold text-black mt-5 col-lg-3 col-sm-12 ">رقم المجموعه : <span
                        class="text-primary"><?php echo $student_group_id; ?></span></h5>
            <h5 class="font-weight-bold text-black mt-5 col-lg-3 col-sm-12 ">اسم المجموعه : <span
                        class="text-primary"><?php echo $student_group_name; ?></span></h5>
            <h5 class="font-weight-bold text-black mt-5 col-lg-6 col-sm-12 ">وصف المجموعه : <span
                        class="text-primary"><?php echo $student_group_description; ?></span></h5>
        </div>
        <div class='row'>
            <h5 class="font-weight-bold text-black col-lg-3 col-sm-12 ">مصروفات المجموعه: <span
                        class="text-primary"><?php echo $student_group_price . " ج.م "; ?></span></h5>
            <h5 class="font-weight-bold text-black col-lg-3 col-sm-12 "> ميعاد امتحان المجموعه : <span
                        class="text-primary"><?php ?></span></h5>
        </div>
    <?php } ?>


    <div class="container arabic">
        <table class="table table-stripped table-responsive-sm  ">
            <tr>
                <th>رقم الطالب</th>
                <th> اسم الطالب</th>
                <th> اسم ولي الامر</th>
                <th> رقم ولي الامر</th>
                <th>درجه الامتحان</th>
                <th>اضافه الدرجه</th>
            </tr>

            <?php


            if (isset($student_group_id)) {
                $teacher_id = $_SESSION['teacher_id'];

                $sql = " SELECT * FROM classes WHERE teacher_id =  '$teacher_id' AND group_id = $student_group_id ";
                $students_list = mysqli_query($connection, $sql);

                while ($students_list_assoc = mysqli_fetch_assoc($students_list)) {
                    $student_id = $students_list_assoc['student_id'];
// echo ($students_list_assoc['student_id']);
                    $sql2 = " SELECT * FROM students WHERE id =  $student_id AND active = 1";
                    $student_data = mysqli_query($connection, $sql2);
                    while ($student = mysqli_fetch_assoc($student_data)) { ?>


                        <tr>
                            <td><?php if (isset($student['id'])) {
                                    echo $student['id'];
                                } ?></td>
                            <td><?php if (isset($student['first_name'])) {
                                    echo $student['first_name'];
                                } ?></td>
                            <td><?php if (isset($student['last_name'])) {
                                    echo $student['last_name'];
                                } ?></td>
                            <td><?php if (isset($student['phone'])) {
                                    echo $student['phone'];
                                } ?></td>
                            <td><?php if (isset($student['exam'])) {
                                    echo $student['exam'];
                                } ?>/
                            </td>
                            <td>
                                <form action="post" class="form-inline" action="student_exams.php">
                                    <div class="form-group row">
                                        <div class="col-lg-9 col-sm-12">
                                            <input type="text" name="exam" class=" ">
                                            <button type="submit" class=" btn btn-success  ">اضافه</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>

                    <?php }
                }
            } ?>
        </table>
    </div>
    <div>
        <?php
        if (isset($student_group_id)) {
            if (isset($_POST['update-group-stage'])) {
                $name_update = $_POST['name_update'];
                $description_update = $_POST['description_update'];
                $price_update = $_POST['price_update'];
                $update_sql = "UPDATE groups SET name = '$name_update' , description = '$description_update' , price = $price_update WHERE id = $student_group_id";
                $update_query = mysqli_query($connection, $update_sql);

            }
            echo "<button href='#' class='btn btn-outline-danger p-3' data-toggle='modal' data-target='#delete'>حذف المجموعه</button>";
            ?>


            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <a href='student_delete.php?id=<?php echo $student_group_id; ?>& action=delete_group '
                               class='btn btn-danger col-12 p-3'> حذف المجموعه نهائي</a>

                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo "<button href='#' class='btn btn-outline-primary p-3' data-toggle='modal' data-target='#edit'>تعديل المجموعه</button>";
        }
        ?>

        <!-- <a href="student_delete.php?id=<?php echo $student_group_id; ?>& action=edit_group " class="btn btn-outline-primary p-3"> تعديل المجموعه</a> -->

        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">


                </div>
            </div>
        </div>

    </div>

</div>
</div>
<?php
include('end.php')
?>
