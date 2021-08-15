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
    if (!empty($_SESSION['username'])) {
        if (isset($_SESSION['password'])) {
            $usr = $_SESSION['username'];
            $hash = $_SESSION['password'];
            $sql = "SELECT * FROM member WHERE user ='$usr' AND pass='$hash'";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) > 0) {
                header('location:index.php');
            }
        }
    }
    $_SESSION['temppass2'] = "";
    $_SESSION['tempuser2'] = "";
    $noti = "";
    $snoti = "";
    $np = "";
    $nu = "";
    if (isset($_POST["submit"])) {
        $user = $_POST["user"];
        $password = $_POST["password"];
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        $a_check = ((isset($_POST['checkbox']) != 0) ? 1 : "");
        if ($a_check == 1) {
            $_SESSION['a_check'] = "checked";
        } else {
            $_SESSION['a_check'] = "";
        };

        if ($user == "") {
            $_SESSION['tempuser'] = $user;
            $noti = "Username bạn không được để trống!";
            $nu = "error";
            $snoti = "noti";
        } else {
            $_SESSION['tempuser'] = $user;
            if ($password == "") {
                $noti = "Password bạn không được để trống!";
                $np = "error";
                $snoti = "noti";
            } else {
                $sql = "SELECT * FROM member WHERE user ='$user' AND pass='$password'";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) == 0) {
                    $noti = "Tên đăng nhập hoặc mật khẩu không đúng !";
                    $snoti = "noti";
                } else {
                    $f_user = $user;
                    $f_pass = $password;
                    if ($a_check == 1) {
                        setcookie($cookie_name, 'usr=' . $f_user . '&hash=' . $f_pass, time() + $cookie_time);
                        $_SESSION['password'] = $password;
                    } else $_SESSION['password'] = "";
                    $noti = "";
                    $snoti = "";
                    $_SESSION['username'] = $user;
                    header('Location: index.php');
                }
            }
        }
    }
    ?>

    <div id="khung_ngoai" class="khung_ngoai <?php echo $snoti ?>">
        <div class="khung_sign">
            <div class="khung_singin">
                <h4 class="text signin">Sign in</h4>
            </div>
            <div class="khung_singup">
                <button id="btn_signup" class="btn_singup" onclick="location.href='signup.php'">
                    Sign up
                </button>
            </div>
        </div>
        <form id="login_form" action="login.php" method="POST">
            <div class="khung_lable_user">
                <label id="label_user" class="label <?php echo $nu ?>">Your user name</label>
            </div>
            <div class="khung_input_user">
                <input id="inputuser" name="user" class="input_field <?php echo $nu ?>" placeholder="User name" type="user" value="<?php
                                                                                                                                    if (isset($_SESSION['tempuser'])) {
                                                                                                                                        echo $_SESSION['tempuser'];
                                                                                                                                    }  ?>">
            </div>
            <div class="khung_lable_pass">
                <label id="label_pass" class="label <?php echo $np ?>">Your password</label>
                <a id="text_forgot" class="text forgot" href="#">Forgot?</a>
            </div>
            <div class="khung_input_pass">
                <input id="inputpass" name="password" class="input_field <?php echo $np ?>" placeholder="******" type="password" value="<?php if (isset($_SESSION['temppass'])) {
                                                                                                                                            echo $_SESSION['temppass'];
                                                                                                                                        }  ?>">
            </div>
            <div class="khung_check_save_pass">
                <label class="khung_label_save_pass">
                    <input name="checkbox" id="checkbox" type="checkbox" <?php if (isset($_SESSION['a_check'])) {
                                                                                echo $_SESSION['a_check'];
                                                                            }  ?>>
                    Save password
                </label>
            </div>
            <div class="khung_login">
                <button type="submit" name="submit" id="btn_login" class="btn_login">
                    Login
                </button>
            </div>
        </form>
        <div class="khung_noti error">
            <label id="label_pass_check" class="label"><?php echo $noti ?></label>
        </div>
    </div>
    <script src="script.js"></script>


</body>

</html>