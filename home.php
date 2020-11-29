<?php ob_start(); ?>
<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Activate Bootstrap 4 Carousel via JavaScript</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
         body {
            overflow-x: hidden;    
        }
        .carousel {
            background: #2f4357;
        }

        .carousel-item {
            text-align: center;
            min-height: 280px;
            height: 400px;
        }

        .carousel-indicators li,
        .carousel a {
            cursor: pointer;
        }
       
    </style>
    <script src="index.js"></script>
    <script>
        $(document).ready(function() {
            // Activate carousel
            $("#myCarousel").carousel();

            // Enable carousel control
            $(".carousel-control-prev").click(function() {
                $("#myCarousel").carousel('prev');
            });
            $(".carousel-control-next").click(function() {
                $("#myCarousel").carousel('next');
            });

            // Enable carousel indicators
            $(".slide-one").click(function() {
                $("#myCarousel").carousel(0);
            });
            $(".slide-two").click(function() {
                $("#myCarousel").carousel(1);
            });
            // $(".slide-three").click(function() {
            //     $("#myCarousel").carousel(2);
            // });
        });
    </script>
</head>


<body>
    <div class="" id="nav"></div>
    <div class="row" >
        <div class="col-lg-3"></div>
        <div class="col-lg-8">
            <center>
                <h2 class="w3-center" style="padding :50px;  padding-top :70px;">ระบบจัดการบริการวิชาการแบบครบวงจร</h2>
            </center>
            <div class="container-lg my-3">
                <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">

                    <ol class="carousel-indicators">
                        <li class="slide-one active"></li>
                        <li class="slide-two"></li>
                        <!-- <li class="slide-three"></li> -->
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="poster.jpg" alt="First Slide">
                            <div class="carousel-caption d-none d-md-block">
                            
                            </div>
                        </div>
                        
                        <div class="carousel-item">
                            <img src="pic5.jpg" alt="Third Slide">
                            <div class="carousel-caption d-none d-md-block">

                            </div>
                        </div>
                    </div>

                    <a class="carousel-control-prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
            <br><br><br>
            <br><br><br>
        </div>
    </div>
</body>

</html>