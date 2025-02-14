<?php
session_start();
$teacher_name = $_SESSION['teacher_fname'];
$teacher_full_name = $_SESSION['teacher_full_name'];
$teacher_id = $_SESSION['teacher_id'];

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top arabic">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php" title="اتمني لك يوما سعيدا">اهلا بك , <?php echo $teacher_name ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item items">
                    <a class="nav-link active" aria-current="page" href="index.php">الرئيسيه</a>
                </li>
                <li class="nav-item dropdown items">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        الطلاب
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item " href="students.php">عرض الطلاب</a></li>
                        <li><a class="dropdown-item" href="student_groups.php">عرض المجموعات</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="student_add.php">إضافه طالب</a></li>
                        <li><a class="dropdown-item" href="student_deleted.php">حذف طالب</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex m-4 mt-0 mb-0">
                <!-- <input class="form-control me-2" type="search" placeholder="بحث ..." aria-label="Search"> -->
                <a href="logout.php" class="btn btn-outline-danger form-control  m-4 mt-0 mb-0 " type="submit">تسجيل
                    خروج</a>
            </form>
        </div>
    </div>
</nav>
<body>