<?php
include("start.php");
include("navbar.php");
?>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'center_manger');
if (isset($_GET['new_value'])) {
    echo $new_value = $_GET['new_value'];
    $sql_add_total = "UPDATE students SET total = (total+$new_value) ";
    $query_add_total = mysqli_query($connection, $sql_add_total);
    header("Location:student_bills.php");
}


if (isset($_GET['bill_value'])) {
    echo $bill_value = $_GET['bill_value'];
    $sql_bill_total = "UPDATE students SET paid = (paid+$bill_value) where id= 3 ";
    $query_bill_total = mysqli_query($connection, $sql_bill_total);
// header("Location:student_bills.php") ;
}
?>

<div class="container arabic box " id="printableArea">
    <div class="row">
        <form action="student_bills.php" method="GET" class="col-6">
            <div class="form-group ">
                <div class="col-lg-6"><label for="new_value"> مصاريف جديده</label></div>
                <div class="col-lg-6"><input type="number" id="new_value" name="new_value" class="form-control  "
                                             placeholder="المصاريف"></div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-outline-primary ">إضافه</button>
                </div>
            </div>
        </form>
        <form action="student_bills.php" method="GET" class="col-6">
            <div class="form-group  ">
                <div class="col-lg-6"><label for="bill_value"> مبلغ الدفع</label></div>
                <div class="col-lg-6"><input type="number" id="bill_value" name="bill_value" class="form-control  "
                                             placeholder="مبلغ الدفع"></div>
            </div>
        </form>


    </div>

    <table class="table table-stripped table-responsive-sm   ">
        <tr>
            <th>رقم الطالب</th>
            <th> اسم الطالب</th>
            <th> اسم ولي الامر</th>
            <th> رقم المدرس</th>
            <th>المجموعه</th>
            <th> رقم ولي الامر</th>
            <th> المصروفات المدفوعه</th>
            <th> المصروفات الكليه</th>
            <th class="noprint"> اعدادات</th>
        </tr>

        <?php
        $teacher_id = $_SESSION['teacher_id'];
        $connection = mysqli_connect('localhost', 'root', '', 'center_manger');
        $sql = " SELECT * FROM classes WHERE teacher_id =  $teacher_id ";
        $students_list = mysqli_query($connection, $sql);
        // print_r(mysqli_fetch_assoc($students_list)) ;
        while ($students_list_assoc = mysqli_fetch_assoc($students_list)) {
            $student_id = $students_list_assoc['student_id'];
            $group = $students_list_assoc['group_id'];

            $sql_title = "SELECT * FROM groups WHERE id = $group";
            $group_data_title = mysqli_query($connection, $sql_title);
            $group_title = mysqli_fetch_assoc($group_data_title);
// print_r($group_title) ;

            $student_group_name = $group_title['name'];

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
                    <td><?php if (isset($student['paid'])) {
                            echo $student['paid'];
                        } ?></td>
                    <td><?php if (isset($student['total'])) {
                            echo $student['total'];
                        } ?></td>
                    <form action="student_delete.php" method="get">
                        <td class="noprint row">
                            <button href="student_delete.php?id=<?php echo $student['id']; ?>"
                                    class="btn btn-success col-4">دفع المبلغ
                            </button>
                            <div class="col-4">
                                <input type="text " class="form-control col-1" value="">
                            </div>
                        </td>
                    </form>
                </tr>

            <?php }
        } ?>
    </table>
    <div class="noprint">
        <input class="btn btn-outline-success" type="button" onclick="printDiv('printableArea')" value="طباعه"/>

    </div>
</div>
</div>
<?php include("end.php"); ?>
