<?php
include("start.php");
?>
<?php
include("navbar.php");
?>

    <div class="container-fluid">
        <h1 class="display-1 d-flex justify-content-center home_title">CENTER-MANGER</h1>
    </div>


    <div class="container-fluid arabic">
        <div class="row d-flex justify-content-center">
            <div onclick="location.href = 'student_groups.php';" id="clickdiv"
                 class="col-lg-3 col-sm-6 card p-5 btn btn-outline-secondary">
                <h1 class="mx-auto logo "><i class="fas fa-globe"></i></h1>
                <label class="mx-auto mt-2 home_label"> المجموعات</label>
            </div>
            <div onclick="location.href = 'student_add.php';" class="col-lg-3 col-sm-6 card p-5 btn btn-outline-info">
                <h1 class="mx-auto logo "><i class="far fa-check-circle"></i></h1>
                <label class="mx-auto mt-2 home_label">اضافه طلاب</label>
            </div>
            <div onclick="location.href = 'students.php';" class="col-lg-3 col-sm-6 card p-5 btn btn-outline-primary ">
                <h1 class="mx-auto logo "><i class="fas fa-users"></i></h1>
                <label class="mx-auto mt-2 home_label"> جميع الطلاب</label>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div onclick="location.href = 'student_deleted.php';"
                 class="col-lg-3 col-sm-6 card p-5 btn btn-outline-danger">
                <h1 class="mx-auto logo "><i class="fas fa-user-alt-slash"></i></h1>
                <label class="mx-auto mt-2 home_label"> المطرودين</label>
            </div>
            <div onclick="location.href = 'student_bills.php';"
                 class="col-lg-3 col-sm-6 card p-5 btn btn-outline-success">
                <h1 class="mx-auto logo "><i class="fas fa-coins"></i></h1>
                <label class="mx-auto mt-2 home_label"> المصاريف</label>
            </div>
            <div onclick="location.href = 'student_exams.php';"
                 class="col-lg-3 col-sm-6 card p-5 btn btn-outline-warning">
                <h1 class="mx-auto logo "><i class="fas fa-pencil-alt"></i></h1>
                <label class="mx-auto mt-2 home_label">الامتحانات</label>
            </div>
        </div>
    </div>

<?php
include("end.php");
?>