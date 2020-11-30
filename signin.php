<?php ob_start(); ?>
<?php
session_start();
include_once('connect.php');
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link href="signin.css" rel="stylesheet">

</head>
<style>
    html,
    body {
        height: 100%;
        background-color: #f5f5f5;
    }

    .main {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-bottom: 40px;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>


<body class="text-center">
    <h1 class="h3 mb-3 font-weight-normal" style="padding-top: 32px; font-size:32px;">ระบบจัดการบริการวิชาการแบบครบวงจร
    </h1>

    <div class="main">
        <h1 class="h3 mb-3 font-weight-normal"></h1>
        <form class="form-signin" action="" method="POST"> 
            <img class="mb-4" src="Webp.net-resizeimage (1).png" style="width : 100%; ">
            <img class="mb-4" src="psu_passport.png" style="width : 70%; ">
            <h4 style="padding-top: 5px; padding-bottom: 20px; font-size: 18px;"></h4>
            <label for="Username" class="sr-only">Username</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" required="" autofocus="">
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required="">
            <div class="checkbox mb-3">
                <label>

                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
            <div class="mb-3" style="padding-top: 15px;">
                <label>
                    <a href="register.php"> register</a>
                </label>
            </div>
            <div style="padding-top :35px;">
                <label>
                    <a href="user_manual.pdf" download>คู่มือการใช้งานระบบ</a>
                </label>
            </div>
        </form>
    </div>


    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $conn->real_escape_string($_POST['password']);

        $sql = "SELECT * FROM `member` WHERE `username` =  '" . $username . "' AND `password` = '" . md5($password) . "' ";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];


            $sql2 = "SELECT * FROM `profile` WHERE `profile_id` =  '" . $_SESSION['id'] . "'  ";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $_SESSION['firstname_surname'] = $row2['firstname_surname'];
                }
            }

            header('location:home.php');
            echo 'Success <br>';
            echo 'Username =' . $row['username'];
        } else {
            echo '<script>alert("Username or password is invalid")</script>';
        }
    }
    if (isset($_POST['back'])) {
        header('location:home.php');
    }

    ?>

</body>

</html>