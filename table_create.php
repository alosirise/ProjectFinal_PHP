<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "staff" && $_SESSION['role'] != "admin") {
    header('location: home.php');
    exit();
}
include_once('connect.php');
?>

<html>
<table class="table table-bordered" id="table">
    <thead>
        <tr>
            <th style="width:18%">ที่</th>
            <th style="width:18%">รายการ</th>
            <th style="width:18%">จำนวน</th>
            <th style="width:18%">อัตรา</th>
            <th style="width:18%">ค่าใช้จ่าย (บาท)</th>
            <th>#</th>
            <th>#</th>
        </tr>
    </thead>

    <?php
    $_SESSION['line'] = 1;
    echo '<tbody>
        <tr>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="no' . $_SESSION['line']  . '"      id="no"  ></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="list' . $_SESSION['line']  . '"    id="list" ></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="quantity' . $_SESSION['line']  . '"  id="quantity"></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="rate' . $_SESSION['line']  . '"      id="rate" ></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name = "cost1' . $_SESSION['line']  . '"    id="cost1"></td>
        <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
        <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction()"></td>
        </tr>
 ';

    ?>
    </tbody>
</table>
<a class="btn btn-primary pull-right" onclick='myCreateFunction()' data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>

<script>
    var i = 1;

    function myCreateFunction() {
        <?php $_SESSION['line']++;;
        $line = $_SESSION['line'];
        ?>



        var sss = "<?php echo $line ?>"

        i++;
        console.log(i);

        var table = document.getElementById("table");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);

        cell1.innerHTML = "<input type='text' class='edit' name ='no" + <?php echo $line ?> + "'   id='no' style='width: 99%; cursor: auto;' >";
        cell2.innerHTML = "<input type='text' class='edit' name ='list<?php echo $line ?>'     id='list' style='width: 99%; cursor: auto;'>";
        cell3.innerHTML = "<input type='text' class='edit' name ='quantity<?php echo $line ?>'  id='quantity' style='width: 99%; cursor: auto;'> ";
        cell4.innerHTML = "<input type='text' class='edit' name='rate<?php echo $line ?>'  id='rate' style='width: 99%; cursor: auto;'> ";
        cell5.innerHTML = "<input type='text' class='edit' name = 'cost1<?php echo $line ?>'  id='cost1'  style='width: 99%; cursor: auto;'>";

        cell6.innerHTML = '<i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> ';
        cell7.innerHTML = ' <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction()">';

        myEditFunction();

    }

    function myDeleteFunction() {
        var index, table = document.getElementById('table');
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].cells[6].onclick = function() {
                var c = confirm("แน่ใจนะที่ต้องการจะลบ?");
                if (c === true) {
                    index = this.parentElement.rowIndex;
                    table.deleteRow(index);
                }
                console.log(index);
            };
        }
    }

    function myEditFunction() {
        var index, table = document.getElementById('table');
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].cells[5].onclick = function() {

                index = this.parentElement.rowIndex;
                console.log("index " + index);
                //    document.getElementById("no").disabled = false;
                if ($('input[name=edit]').is(':disabled')) {
                    $('input[name=edit]').attr('disabled', false);
                    // console.log("table id " +table_id);
                } else {
                    $('input[name=edit]').attr('disabled', true);
                }
            };
        }
    }
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</html>