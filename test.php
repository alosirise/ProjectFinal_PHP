<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

    <form action="" method="POST" onclick ="test()" enctype="multipart/form-data">
        <button type="submit" name="add">test</button>
    </form>
    <?php
    echo "aaaaa";
    if (isset($_POST['add'])) {
        var_dump($_POST);
        echo "adassdasd".$_POST['bew'];
    }
    ?>
    <script src="testjs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>