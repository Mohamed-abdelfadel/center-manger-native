<?php
include('start.php') ;
include('navbar.php') ;
?>
<?php
$connection = mysqli_connect('localhost' , 'root' , '' , 'center_manger') ; 
$sql_group = "SELECT * FROM groups WHERE id > 0 AND teacher = $teacher_id " ;
$group_data = mysqli_query($connection , $sql_group) ;

if(isset($_GET['id'])){

    $student_id = $_GET['id'] ;
    $sql = "SELECT * FROM students WHERE id = '$student_id'" ;
    $student_info = mysqli_query($connection , $sql) ;
    $student_data = mysqli_fetch_assoc($student_info) ;
    
    $sql_class = "SELECT * FROM classes WHERE id = '$student_id'" ;
    $class_info = mysqli_query($connection , $sql_class) ;
    $class_data = mysqli_fetch_assoc($class_info) ;
    // print_r($class_data['group_id']) ;

    if(isset( $_POST['fname'])){
        $fname =   $_POST['fname']  ;
        $lname =  $_POST['lname']; 
        $phone =  $_POST['phone'] ;
        $teacher =$_SESSION['teacher_id'] ; 
        $student_sql = "UPDATE students SET first_name = '$fname' , last_name = '$lname' , phone = '$phone' WHERE id = '$student_id'" ;
        $student_update = mysqli_query($connection, $student_sql);
        $group = $_POST['group'] ;
        $group_sql = "UPDATE classes SET group_id = '$group' WHERE id = '$student_id'" ;
        $student_update = mysqli_query($connection, $group_sql);
    
    }


    $_SESSION['student_id'] = $student_id ;

}
else{

    $student_id = $_SESSION['student_id'] ;
    $sql = "SELECT * FROM students WHERE id = '$student_id'" ;
    $student_info = mysqli_query($connection , $sql) ;
    $student_data = mysqli_fetch_assoc($student_info) ;
    $fname =   $_POST['fname'] ; ;
    $lname =  $_POST['lname']; 
    $phone =  $_POST['phone'] ;
    $teacher =$_SESSION['teacher_id'] ; 
    $group = $_POST['group'] ;
    echo $fname . "<br>" . $lname  . "<br>" . $phone . "<br>" . $teacher . "<br>" . $group ;
    $student_sql = "UPDATE students SET first_name = '$fname' , last_name = '$lname' , phone = '$phone' WHERE id = '$student_id'" ;
    $student_update = mysqli_query($connection, $student_sql);


    $group_sql = "UPDATE classes SET group_id = '$group' WHERE id = '$student_id'" ;
    $student_update = mysqli_query($connection, $group_sql);
    header('Location:students.php') ;
    $_SESSION['student_id'] = $student_id ;
}




?>
<div class="container box arabic">
  <div>
    <h1 class=" font-weight-bold text-secondary mt-5"> تعديل الطالب  </h1>
  </div>
  <div class="row">
  <form action="student_edit.php" method="post">
    <div class="form-group col-lg-12 mt-4" >
      <label for="fname" >اسم الطالب</label>  
      <input class="form-control mt-2" id="fname" name="fname" type="text" value="<?php echo $student_data['first_name'] ;?>"  >
    </div>

    <div class="form-group col-lg-12 mt-4" >
      <label for="lname" >اسم ولي الامر</label>  
      <input class="form-control mt-2" id="lname" name="lname" type="text" value="<?php echo $student_data['last_name'] ;?>"  >
    </div>

    <div class="form-group col-lg-12 mt-4" >
      <label for="phone" >رقم ولي الامر </label>  
      <input class="form-control mt-2" id="phone" name="phone" type="text" value="<?php echo $student_data['phone'] ;?>"  >
    </div>

    <div class="form-group col-lg-12 mt-4" >
      <label for="teacher_id" > رقم المدرس</label>  
      <input class="form-control mt-2" id="teacher_id"  type="text" value="<?php echo $teacher_id ;?> " disabled >
    </div>

    <div class="form-group col-lg-12 mt-4" >
      <label for="teacher_name" > اسم المدرس</label>  
      <input class="form-control mt-2" id="teacher_name" type="text" value="<?php echo $teacher_full_name ;?>"disabled  >
    </div>

    <div class="form-group col-lg-12 mt-4" >
                <label for="group" >المجموعه :</label>  
                <select class="form-select col-3" name='group' value= "3">
                  <option value='0' selected>اختيار مجموعة</option>
                  <?php while ($group_info = mysqli_fetch_assoc($group_data)) {?>
                  <option <?php if($class_data['group_id'] == $group_info['id'] ){ echo "selected" ;} ?>  value="<?php if(isset($group_info)){ echo $group_info['id'] ; } ?>"><?php if(isset($group_info)){ echo $group_info['name'] ; } ?></option>
                  <?php }; ?>
                </select>
              </div>
    <div class="form-group col-lg-12 mt-4" >
      <label for="attendance" >عدد ايام الحضور</label>
      <input class="form-control mt-2" id="attendance" name="attendance" type="text" value="<?php echo $student_data['attendance'] ;?>"disabled  >
    </div>

    <div class="form-group col-lg-12 mt-4" >
      <label for="absence" >عدد ايام الغياب</label>  
      <input class="form-control mt-2" id="absence" name="absence" type="text" value="<?php echo $student_data['absence'] ;?>" disabled >
    </div>

    <div class="form-group col-lg-12 mt-4" >
      <label for="name" >المصاريف</label>  
      <input class="form-control mt-2" id="name" name="name" type="text" value="" disabled  >
    </div>

    <div class="form-group col-lg-12 mt-2 d-flex justify-content-center row" >
        <button type='submit' class="btn btn-primary col-lg-4 col-sm-10 m-3 p-3 "> تعديل </button>
        <a href="students.php" class="btn btn-danger col-lg-4 col-sm-10 m-3 p-3 "> رجوع </a>
   
    </div>
    </form>
  </div>
</div>

<?php
include('end.php') ;
?>