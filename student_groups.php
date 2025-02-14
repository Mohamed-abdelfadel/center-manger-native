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
<div class="container box arabic">
    <h1 class="font-weight-bold text-black mt-5">المجموعات</h1>
    <div class="row">
        <div class="col-9">
            <form action="student_groups.php" method="get">
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
        <div class='form-group col-lg-3'>
            <button type="button" class="btn btn-success col-3" data-toggle="modal" data-target="#add"> اضافه</button>

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="add"
                 aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">


                        <form action="student_groups.php" method="post">


                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">اضافه مجموعه</h5>

                            </div>
                            <div class="modal-body">

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="fname">رقم المجموعه :</label>
                                    <input class="form-control mt-2" type="text" disabled
                                           placeholder="<?php echo($last_group['id'] + 1) ?>">
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="name">اسم المجموعه :</label><span class="text-secondary">M-T-11</span>
                                    <input class="form-control mt-2" id="name" name="name" type="text" required>
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="description"> وصف المجموعه :</label> <span class="text-secondary">Monday-Tuesday-11:00am</span>
                                    <input class="form-control mt-2" id="description" name="description" type="text"
                                           required>
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="price"> مصاريف المجموعه :</label> <span class="text-secondary"></span>
                                    <input class="form-control mt-2" id="price" name="price" type="number" required>
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="teacher">المدرس :</label>
                                    <input class="form-control mt-2" type="text"
                                           placeholder="<?php echo $teacher_full_name; ?>" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">إضافه</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">خروج</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                    <th> رقم المدرس</th>
                    <th>المجموعه</th>
                    <th> رقم ولي الامر</th>
                    <th> عدد مرات الحضور</th>
                    <th> عدد مرات الغياب</th>
                    <th> اعدادات</th>
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
                                <td><?php if (isset($teacher_id)) {
                                        echo $teacher_id;
                                    } ?></td>
                                <td><?php if (isset($student_group_name)) {
                                        echo $student_group_name;
                                    } ?></td>
                                <td><?php if (isset($student['phone'])) {
                                        echo $student['phone'];
                                    } ?></td>
                                <td><?php if (isset($student['attendance'])) {
                                        echo $student['attendance'];
                                    } ?></td>
                                <td><?php if (isset($student['absence'])) {
                                        echo $student['absence'];
                                    } ?></td>
                                <td>
                                    <a href="student_view.php?id=<?php echo $student['id']; ?> & location=student_groups.php "
                                       class="btn btn-primary">عرض</a>
                                    <a href="student_delete.php?id=<?php echo $student['id']; ?>& action=remove_from_group "
                                       class="btn btn-danger">حذف من المجموعه</a>
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
                                   class='btn btn-danger col-12 p-3'> حذف المجموعه نهائيا</a>

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


                        <form action="#" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">تعديل مجموعه</h5>

                            </div>
                            <div class="modal-body">

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="fname">رقم المجموعه :</label>
                                    <input class="form-control mt-2" type="text" disabled
                                           placeholder="<?php echo $student_group_id ?>">
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="name">اسم المجموعه :</label>
                                    <input class="form-control mt-2" id="name" name="name_update" type="text" required
                                           value="<?php echo $student_group_name; ?>">
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="description"> وصف المجموعه :</label> <span class="text-secondary">Monday-Tuesday-11:00am</span>
                                    <input class="form-control mt-2" id="description" name="description_update"
                                           type="text" required value="<?php echo $student_group_description; ?>">
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="price"> مصاريف المجموعه :</label> <span class="text-secondary"></span>
                                    <input class="form-control mt-2" id="price" name="price_update" type="number"
                                           required value="<?php echo $student_group_price; ?>">
                                </div>

                                <div class="form-group col-lg-10 mt-4">
                                    <label for="teacher">المدرس :</label>
                                    <input class="form-control mt-2" type="text"
                                           placeholder="<?php echo $teacher_full_name; ?>" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary" name="update-group-stage">حفظ</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">خروج</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<?php
include('end.php')
?>
