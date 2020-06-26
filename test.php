<script src="testjs.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

    <form action="" method="POST"  enctype="multipart/form-data">
        <button type="button" onclick ="test()" name="add">test</button>
    </form>
    <?php
        $update_numradio = array(1,2,3);

        $max_value_numradio = 0;

        $max_value_numradio = max($update_numradio);
        echo $max_value_numradio;

    ?>
    
</body>

</html>