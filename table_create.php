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
<style>
    input:read-only,
    textarea:read-only {

        border-color: transparent;
        cursor: context-menu;
    }
</style>

<table class="table table-bordered" id="table">
    <thead>
        <tr>
            <th style="width:10%">ที่</th>
            <th style="width:19%">รายการ</th>
            <th style="width:19%">จำนวน (ชุด)</th>
            <th style="width:19%">อัตรา (บาท)</th>
            <th style="width:19%">ค่าใช้จ่าย (บาท)</th>
            <th style="width:5%">#</th>
            <th style="width:5%">#</th>
        </tr>
    </thead>

    <?php

    echo '<tbody>
        <tr>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="no[]"      id="edit1" ></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="list[]"    id="edit2" ></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="quantity[]"  id="edit3"></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name ="rate[]"      id="edit4" ></td>
        <td><input type="text"  style="width: 99%;"   class="edit" name = "cost1[]"    id="edit5" disabled></td>
        <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
        <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction()"></td>
        </tr>
        </tbody>
        <tfoot>
    <tr>
      <th id="total" colspan="4">Total :</th>
      <th > <input type="text" style="width: 99%;" name="result" id="result" disabled></th>
    </tr>
   </tfoot>
        ';

    ?>

</table>



<a class="btn btn-primary pull-right" onclick='myCreateFunction()' data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a>

<script>
  
var i = 1 ;
$('#edit1').val(i);

    function myCreateFunction() {
   i++;
        var table = document.getElementById("table");

        var index = table.rows.length - 1;
        var row = table.insertRow(index);

        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);

        cell1.innerHTML = "<input type='text' class='edit' name ='no[]'   id='edit1' style='width: 99%; cursor: auto;' >";
        cell2.innerHTML = "<input type='text' class='edit' name ='list[]'     id='edit2' style='width: 99%; cursor: auto;'>";
        cell3.innerHTML = "<input type='text' class='edit' name ='quantity[]'  id='edit3' style='width: 99%; cursor: auto;'> ";
        cell4.innerHTML = "<input type='text' class='edit' name='rate[]'  id='edit4' style='width: 99%; cursor: auto;'> ";
        cell5.innerHTML = "<input type='text' class='edit' name = 'cost1[]'  id='edit5'  style='width: 99%; cursor: auto;' disabled>";

        cell6.innerHTML = '<i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> ';
        cell7.innerHTML = ' <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction()">';

        $('#edit1').val(i);
    

        myEditFunction();

    }


  $('#edit4,#edit3').keyup(function(){
        var edit3;
        var edit4;
        edit3 = parseFloat($('#edit3').val());
        edit4 = parseFloat($('#edit4').val());
        var edit5 =  edit3*edit4;
        $('#edit5').val(edit5.toFixed(2));
    });




    function session() {
        var no = $("input[name='no[]']")
            .map(function() {
                return $(this).val();
            }).get();

        var list = $("input[name='list[]']")
            .map(function() {
                return $(this).val();
            }).get();

        var quantity = $("input[name='quantity[]']")
            .map(function() {
                return $(this).val();
            }).get();


        var rate = $("input[name='rate[]']")
            .map(function() {
                return $(this).val();
            }).get();

        var cost1 = $("input[name='cost1[]']")
            .map(function() {
                return $(this).val();
            }).get();

        console.log(no);

        $.ajax({
            url: 'create_project.php',
            type: 'POST',
            data: {
                'no[]': no,
                'list[]': list,
                'quantity[]': quantity,
                'rate[]': rate,
                'cost1[]': cost1

            },
            success: function(msg) {}
        });

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
                console.log("Index deleted: " + index);
            };
        }

    }

    function myEditFunction() {
        var index, table = document.getElementById('table');
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].cells[5].onclick = function() {

                index = this.parentElement.rowIndex;
                console.log("This is index : " + index);
                ////    document.getElementById("no").disabled = false;
                if ($('input[id=edit]').is('[readonly]')) {

                    $('input[id=edit]').attr('readonly', false);
                    // console.log("table id " +table_id);
                } else {

                    $('input[id=edit]').attr('readonly', true);
                }

            };
        }

    }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</html>