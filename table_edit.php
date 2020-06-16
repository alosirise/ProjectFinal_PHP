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

<?php
$sql = "SELECT * FROM budget_form WHERE project_id = '" . $_SESSION['project_id'] . "'";
$result = $conn->query($sql);
?>

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
    while ($row = $result->fetch_assoc()) {
        echo '<tbody>
        <tr>
        <td><input type="text"  style="width: 99%;"   name="edit" class ="no"      id="no" value ="' . $row["no"] . '" disabled></td>
        <td><input type="text"  style="width: 99%;"   name="edit" class ="list"    id="list" value ="' . $row["list"] . '" disabled></td>
        <td><input type="text"  style="width: 99%;"   name="edit"class ="quantity"  id="quantity" value ="' . $row["quantity"] . '" disabled></td>
        <td><input type="text"  style="width: 99%;"   name="edit" class="rate"      id="rate" value ="' . $row["rate"] . '" disabled></td>
        <td><input type="text"  style="width: 99%;"   name="edit" class = "cost1"    id="cost1" value ="' . $row["cost"] . '" disabled></td>
        <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
        <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction()"></td>
        </tr>
 ';
    }
    ?>
    </tbody>
</table>
<a class="btn btn-primary pull-right" onclick='myCreateFunction()' data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>


<script type="text/javascript">
    function myCreateFunction() {
        var table = document.getElementById("table");
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);

        cell1.innerHTML = "<input type='text' name='edit' class ='no'  id='no' style='width: 99%; cursor: auto;' >";
        cell2.innerHTML = "<input type='text' name='edit' class ='list'  id='list' style='width: 99%; cursor: auto;'>";
        cell3.innerHTML = "<input type='text' name='edit' class ='quantity' id='quantity' style='width: 99%; cursor: auto;'> ";
        cell4.innerHTML = "<input type='text'  name='edit' class='rate'  id='rate' style='width: 99%; cursor: auto;'> ";
        cell5.innerHTML = "<input type='text' name='edit' class = 'cost1'  id='cost1'  style='width: 99%; cursor: auto;'>";

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