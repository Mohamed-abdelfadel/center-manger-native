<?php
session_start();
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
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

    if ($user = user_exist($_POST['email'])) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['teacher_id'] = $user['id'];
            $_SESSION['teacher_fname'] = $user['first_name'];
            $_SESSION['teacher_full_name'] = $user['first_name'] . " " . $user['last_name'];

            header("location:home.php");
        } else {
            $error = "<p class=' alert alert-danger col-12 ' id='signup_red'> كلمه السر غير صحيحه </p> ";
            // $error = $password ." ... " . $user['password'] ;
        }
    } else {
        $error = "<p class=' alert alert-warning col-12 ' id='signup_red'> البريد الالكتروني غير صحيح او في انتظار الموافقه </p>";

    }


};

?>

<?php
include("start.php");
?>


    <div class="container  arabic  mt-5 box arabic">

        <div class="d-flex justify-content-center ">
            <h1 class="font-weight-bold text-success  ">تسجيل الدخول</h1>

        </div>

        <div class="d-flex justify-content-center">

            <form action="login.php" method="post" class="col-lg-3 col-sm-12">

                <div class="form-group col-12  mt-2">
                    <label for="email" class="mt-5">البريد الالكتروني :</label>
                    <input class="form-control mt-2" id="email" name="email" type="email">
                </div>

                <div class="form-group col-lg-12  mt-4">
                    <label for="password">كلمه السر :</label>
                    <input class="form-control mt-2" id="password" name="password" type="password">
                </div>


                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-success mt-5 col-10 login">دخول</button>

                </div>
        </div>
        </form>

        <div class="d-flex justify-content-center">
            <?php
            if (isset($error)) {
                echo $error;
            } else {
                echo "  <div class=' alert alert-danger col-5 '>
                  <p class='d-flex justify-content-center'> لا تمتلك حساب ؟ </p>
                  
                  <p class='d-flex justify-content-center'> <a href='sign-up.php'>إنشاء حساب </a> </p>                  
                  </div>";
            }

            ?>

        </div>
        <div>
            <p class='d-flex justify-content-center'><a href='index.php'>الصفحه الرئيسية </a></p>
        </div>
    </div>

<?php
include("end.php");
?>