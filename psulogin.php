<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
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
        padding-top: 35px;
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
<h1 class="h3 mb-3 font-weight-normal" style="padding-top: 20px; padding-bottom: 30px; ">ระบบจัดการบริการวิชาการแบบครบวงจร 
</h1>


    <div class="main">
        <h1 class="h3 mb-3 font-weight-normal"></h1>
        <form class="form-signin">
            <img class="mb-4" src="Webp.net-resizeimage (1).png" style="width : 100%; ">
            <img class="mb-4" src="psu_passport.png" style="width : 70%; ">
            <h4 style="padding-top: 30px; padding-bottom: 20px; font-size: 18px;">Login</h4>
            <label for="inputEmail" class="sr-only">Student ID</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Student ID" required="" autofocus="">
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <div class="checkbox mb-3">
                <label>

                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <div class="mb-3" style="padding-top: 15px;">
                <label>
                    <a href=""> register</a>
                </label>
            </div>
            <div style="padding-top :35px;">
                <label>
                    คู่มือการใช้งานระบบ
                </label>
            </div>
        </form>
    </div>

</body>

</html>