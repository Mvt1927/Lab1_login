<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans" rel="stylesheet">
    <link href="allstyle2.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <?php
    require_once("cndb.php");
    $noti = "";
    $snoti = "";
    $np = "";
    $nu = "";
    $nrp = "";
    if (isset($_POST["submit"])) {
        $user = $_POST["user"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
        $user = strip_tags($user);
        $user = addslashes($user);
        $password = strip_tags($password);
        $password = addslashes($password);
        $repassword = strip_tags($repassword);
        $repassword = addslashes($repassword);
        if ($user == "") {
            $_SESSION['tempuser2'] = $user;
            $noti = "Username bạn không được để trống!";
            $nu = "error";
            $snoti = "noti";
        } else {
            $_SESSION['tempuser2'] = $user;
            if ($password == "") {
                $_SESSION['temppass2'] = $password;
                $noti = "Password bạn không được để trống!";
                $np = "error";
                $snoti = "noti";
            } else {
                if ($repassword == "") {
                    $_SESSION['temppass2'] = $password;
                    $noti = "Re-enter password bạn không được để trống!";
                    $nrp = "error";
                    $snoti = "noti";
                } else {
                    if ($repassword != $password) {
                        $noti = "Re-enter password và password không trùng khớp!";
                        $nrp = "error";
                        $np = "error";
                        $snoti = "noti";
                    } else {
                        $sql = "SELECT * FROM member WHERE user ='$user'";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) == 0) {
                            $sql = "INSERT INTO `member`.`member` (`user`, `pass`) VALUES ('$user', '$password');";
                            $query = mysqli_query($conn, $sql);
                            $_SESSION['temppass'] = $password;
			                $_SESSION['tempuser'] = $user;
                            $_SESSION['temppass2'] = "";
			                $_SESSION['tempuser2'] = "";
                            header('location:login.php');
                        } else {
                            $noti = "Username đã được sử dụng";
                            $nu = "error";
                            $_SESSION['temppass2'] = "";
                            $snoti = "noti";
                        }
                    }
                }
            }
        }
    }
    ?>

    <div id="khung_ngoai" class="khung_ngoai signup <?php echo $snoti ?>">
        <div class="khung_sign">
            <div class="khung_singin">
                <h4 class="text signin">Sign up</h4>
            </div>
            <div class="khung_singup">
                <button id="btn_signup" class="btn_singup" onclick="location.href='login.php'">
                    Sign in
                </button>
            </div>
        </div>
        <form id="login_form" action="signup.php" method="POST">
            <div class="khung_lable_user">
                <label id="label_user" class="label <?php echo $nu ?>">Your user name</label>
            </div>
            <div class="khung_input_user">
                <input id="inputuser" name="user" class="input_field <?php echo $nu ?>" placeholder="User name" type="user" value="<?php
                                                                                                                                    if (isset($_SESSION['tempuser2'])) {
                                                                                                                                        echo $_SESSION['tempuser2'];
                                                                                                                                    }   ?>">
            </div>
            <div class="khung_lable_pass">
                <label id="label_pass" class="label <?php echo $np ?>">Your password</label>
            </div>
            <div class="khung_input_pass">
                <input id="inputpass" name="password" class="input_field <?php echo $np ?>" placeholder="******" type="password" value="<?php if (isset($_SESSION['temppass2'])) {
                                                                                echo $_SESSION['temppass2'];
                                                                            }   ?>">
            </div>
            <div class="khung_check_save_pass">
                <label id="label_repass" class="khung_label_save_pass <?php echo $nrp ?>">
                    Re-enter your password
                </label>
            </div>
            <div class="khung_input_repass">
                <input id="inputrepass" name="repassword" class="input_field <?php echo $nrp ?>" placeholder="******" type="password" value="">
            </div>
            <div class="khung_signup2">
                <button type="submit" name="submit" id="btn_login" class="btn_login">
                    Register Now
                </button>
            </div>
        </form>
        <div class="khung_noti error">
            <label id="label_pass_check" class="label"><?php echo $noti ?></label>
        </div>
    </div>
    <script src="script2.js"></script>


</body>

</html>