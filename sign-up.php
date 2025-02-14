<?php
if (isset($_POST['email'])) {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $password_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $connection = mysqli_connect("localhost", "root", "", "center_manger");


    function user_exist($email)
    {
        $connection = mysqli_connect("localhost", "root", "", "center_manger");
        $sql = "SELECT * FROM teachers WHERE email = '$email'";
        $users_data = mysqli_query($connection, $sql);
        $num_of_users = mysqli_num_rows($users_data);
        if ($num_of_users == 1) {
            $user = mysqli_fetch_assoc($users_data);
            return $user;
        } else {
            return false;
        }
    }

    if (user_exist($_POST['email'])) {
        $error = "<p class=' alert alert-warning col-12  ' > هذا الحساب موجود بالفعل او  في انتظار الموافقة</p>";
    } else {
        if ($password == $re_password) {
            if (strlen($_POST["password"]) <= 8) {
                $error = "<p class=' alert alert-danger col-12 ' > كلمه السر يجب ان تزيد عن 8 حروف  </p>";

            } else {
                $error = "<p class=' alert alert-success col-12 ' > تم حفظ البيانات برجاء انظار الموافقه لتسجيل الدخول <a href='login.php'> تسجيل الدخول من هنا</a> </p>    ";

                $sql = "INSERT INTO teachers (first_name , last_name , email , password ,verified) VALUE ('$first_name' ,'$last_name' , '$email', '$password_hashed', '0' )";

                mysqli_query($connection, $sql);
            }

        } else {
            $error = "<p class=' alert alert-danger col-12 ' > كلمه السر غير متطابقه </p>";
        }

    }

};
?>

<?php
include("start.php");
?>

<div class="container box ">
    <div class="row arabic">
        <h1 class=" font-weight-bold text-danger mt-5">إنشاء حساب</h1>
        <div class="col-lg-6 col-sm-12 ">

            <form action="sign-up.php" class="row" method="post">
                <div class="form-group col-lg-6 mt-4">
                    <label for="fname">الاسم الاول :</label>
                    <input class="form-control mt-2" id="fname" name="fname" type="text" required>
                </div>

                <div class="form-group col-lg-6 col-sm-12 mt-4">
                    <label for="lname">الاسم الاخير :</label>
                    <input class="form-control mt-2" id="lname" name="lname" type="text" required>
                </div>

                <div class="form-group col-12  mt-4">
                    <label for="email">البريد الالكتروني :</label>
                    <input class="form-control mt-2" id="email" name="email" type="email" required>
                </div>

                <div class="form-group col-lg-7 col-sm-12 mt-4">
                    <label for="password">كلمه السر :</label>
                    <input class="form-control mt-2" id="password" name="password" type="password" required>
                </div>

                <div class="form-group col-lg-7 col-sm-12 mt-4">
                    <label for="re_password">أعد كتابه كلمه السر :</label>
                    <input class="form-control mt-2" id="re_password" name="re_password" type="password" required>
                </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="mt-5">

                <?php
                if (isset($error)) {
                    echo $error;
                } else {
                    echo "<p class=' alert alert-secondary col-12 ' id='signup_red'>برجاء إدخال الاسم بطريقه صحيحه (يفضل باللغه العربية) مع مراجعه كل من الاسم و البريد الالكتروني و انشاء كلمه سر قويه و سهله التذكر لصاحب العمل </p>";
                }
                ?>
            </div>

        </div>

        <div class="row d-flex justify-content-center">
            <button type="submit" id="sign_up" class="btn btn-success mt-4 col-4 login">إنشاء</button>
        </div>


        </form>
        <div>
            <p class='d-flex justify-content-center'><a href='index.php'>الصفحه الرئيسية </a></p>
        </div>
    </div>

</div>
</div>


<?php
include("end.php");
?>
