<!doctype html>
<html lang="en">

<head>

    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Bootstrap navbar CSS-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
        <?php 
        session_start();
        include_once('connect.php');
        

        if(isset($_POST['back'])){ header('location:home.php');}

            if(isset($_POST['submit'])){
                if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirm_password"])){
                    echo '<script>alert("Both fields are required")</script>';
              
                }else{
                        //remove back slash    
                        $username = stripcslashes($_REQUEST['username']);
                        //escape apecial character in string
                        $username = mysqli_real_escape_string($conn, $username);
                        $password = stripcslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($conn, $password);
                        // $password = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO member (id, username, password ,role)
                                       VALUES ( NULL,'$username', '".md5($password)."','user')";

                        $result = mysqli_query($conn , $sql);
                        echo $result;
                        if($result){
                            echo '<script>alert("Registration Done")</script>';
                            
                        }

                        
                    }
                }
        ?>

<div class="container">

    <div class="row">
        <div class="col-lg-5  mx-auto mt-5 "> 
                <div class="card">
                    <form action="" method="POST">
                        <div class="card-header text-center">Sign in</div>
                </div>

                <div class="card-body">
                        <div class="center">
                            <img src="pic.jpg" class="" style="width: 300px; padding-top: 50px; padding-bottom: 50px;" >
                        </div>  


                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" id="username" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="formgroup row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" id="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="formgroup row">
                        <label for="password" class="col-sm-3 col-form-label">Confirm password</label>
                        <div class="col-sm-9">
                            <input type="password" id="confirm_password" class="form-control" name="confirm_password">
                        </div>
                    </div>


                    <!-- <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Firstname</label>
                        <div class="col-sm-9">
                            <input type="text" id="firstname" class="form-control" name="firstname">
                        </div>
                    </div>
                    <div class="formgroup row">
                        <label for="password" class="col-sm-3 col-form-label">Lastname</label>
                        <div class="col-sm-9">
                            <input type="text" id="lastname" class="form-control" name="lastname">
                        </div>
                    </div>

                    <div class="formgroup row">
                        <label for="password" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" id="email" class="form-control" name="email">
                        </div>
                    </div> -->
                </div>
                <div class="card-footer text-center">
                    <input type="submit" name="submit" class="btn btn-success " value="Submit">
                    <input type="submit" name="back" class="btn btn-success " value="Back">

                </form>
                </div>
                    
        </div>
  
    </div>
        
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then minified and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script src="index.js"></script>
</body>

</html>