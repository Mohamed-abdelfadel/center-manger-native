<?php
include("start.php") ;
include("navbar.php") ;
?>


<div class="container arabic box " id="printableArea">
    <table class="table table-stripped table-responsive-sm   ">
        <tr>
        <th>رقم الطالب</th>
            <th> اسم الطالب</th>
            <th> اسم ولي الامر</th>
            <th> رقم المدرس</th>
            <th>المجموعه</th>
            <th> رقم ولي الامر</th>
            <th> المصروفات المدفوعه</th>
            <th> المصروفات المتبقيه</th>
            <th class="noprint" > اعدادات </th>
        </tr>

        <?php
$teacher_id = $_SESSION['teacher_id'] ;
$connection = mysqli_connect('localhost' , 'root' , '' , 'center_manger') ;
$sql = " SELECT * FROM classes WHERE teacher_id =  $teacher_id " ;
$students_list = mysqli_query($connection, $sql);
// print_r(mysqli_fetch_assoc($students_list)) ;
while($students_list_assoc = mysqli_fetch_assoc($students_list )){
$student_id = $students_list_assoc['student_id'] ;
$group = $students_list_assoc['group_id'] ;

$sql_title = "SELECT * FROM groups WHERE id = $group";
$group_data_title = mysqli_query($connection , $sql_title) ;
$group_title = mysqli_fetch_assoc($group_data_title) ;
// print_r($group_title) ;

$student_group_name = $group_title['name'] ;

// echo ($students_list_assoc['student_id']);
$sql2 = " SELECT * FROM students WHERE id =  $student_id AND active = 0"  ;
$student_data = mysqli_query($connection, $sql2);
while($student = mysqli_fetch_assoc($student_data)){  ?>
        <tr>
            <td><?php if(isset($student['id']) ){ echo $student['id'] ;} ?></td>
            <td><?php if(isset($student['first_name']) ){ echo $student['first_name'] ;}?></td>
            <td><?php if(isset($student['last_name']) ){ echo $student['last_name'] ;}?></td>
            <td><?php if(isset($teacher_id) ){ echo $teacher_id;}?></td>
            <td><?php if(isset($student_group_name) ){ echo $student_group_name ;}?></td>
            <td><?php if(isset($student['phone']) ){ echo $student['phone'] ;}?></td>
            <td><?php if(isset($student['attendance']) ){ echo $student['attendance'] ;}?></td>
            <td><?php if(isset($student['absence']) ){ echo $student['absence'] ; }?></td>
            <td><a href="student_delete.php?id=<?php echo $student['id']; ?>& action=restore" class="btn btn-success">إعاده</a>
                <a href="student_delete.php?id=<?php echo $student['id']; ?>& action=delete" class="btn btn-danger">حذف مدي الحياه</a>
            </td>
        </tr>

        <?php }}?>
    </table>
</div>

<?php include("end.php") ;?>




