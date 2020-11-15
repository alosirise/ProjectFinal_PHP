<?php ob_start();?>
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
<?php
$sql = "SELECT * FROM budget_form WHERE project_id = '" . $_SESSION['project_id'] . "'";
$result = $conn->query($sql);
?>

<table class="table table-bordered " id="table">
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
    while ($row = $result->fetch_assoc()) {
        echo '<tbody>';
        echo '   
                <tr>
                <th id="total" colspan="1"></th>
                <th id="total" colspan="4">ค่าตอบแทนคณะทำงาน</th>
                <th colspan="5"><a class="btn btn-primary btn-xs pull-right" onclick="myCreateFunction(1)" data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a></th>
                </tr>';


        $sql2 = "SELECT * FROM budget_form WHERE project_id = '" . $_SESSION['project_id'] . "' AND title = '1' ";
        $result2 = $conn->query($sql2);
        $i1 = 1;
        $count_del2 =0;
        while ($row2 = $result2->fetch_assoc()) {


            echo '<tr>
                <td><input type="text"  style="width: 99%;"   name="no[]"  class="edit"      id="edit1-' . $i1 . '-1"  value ="' . $row2["no"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="list[]"  class="edit"    id="edit2-' . $i1 . '-1"  value ="' . $row2["list"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="quantity[]" class="edit"  id="edit3-' . $i1 . '-1"  onclick="test(id)" value ="' . $row2["quantity"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="rate[]"  class="edit"     id="edit4-' . $i1 . '-1"  onclick="test(id)"  value ="' . $row2["rate"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="cost1[]"  class="edit"    id="edit5-' . $i1 . '-1"  value ="' . $row2["cost"] . '" readonly><input type="hidden" name="title[]" value="1"></td>
                <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
                <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction(1)"></td>
                </tr> ';
            $i1++;
            $count_del2++;
        }
        break;
    }


    while ($row = $result->fetch_assoc()) {
        echo '<tbody>';


        echo '   
            <tr id="cost_progress">
            <th id="total" colspan="1"></th>
            <th id="total" colspan="4">ค่าใช้จ่ายในการดำเนินการ (ค่าใช้สอย , ค่าวัสดุ)</th>
            <th colspan="5"><a class="btn btn-primary btn-xs pull-right" onclick="myCreateFunction(2)" data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a></th>
            </tr>';


        $sql2 = "SELECT * FROM budget_form WHERE project_id = '" . $_SESSION['project_id'] . "' AND title = '2' ";
        $result2 = $conn->query($sql2);
        $i2 = 1;
        $count_del4 = 0;
        while ($row2 = $result2->fetch_assoc()) {

            echo '<tr>
                <td><input type="text"  style="width: 99%;"   name="no[]"  class="edit"      id="edit1-' . $i2 . '-2"  value ="' . $row2["no"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="list[]"  class="edit"    id="edit2-' . $i2 . '-2"  value ="' . $row2["list"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="quantity[]" class="edit"  id="edit3-' . $i2 . '-2"  onclick="test(id)" value ="' . $row2["quantity"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="rate[]"  class="edit"     id="edit4-' . $i2 . '-2" onclick="test(id)"  value ="' . $row2["rate"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="cost1[]"  class="edit"    id="edit5-' . $i2 . '-2"  value ="' . $row2["cost"] . '" readonly><input type="hidden" name="title[]" value="2"></td>
                <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
                <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction(2)"></td>
                </tr> ';
            $i2++;
            $count_del4++;
        }
        break;
    }


    while ($row = $result->fetch_assoc()) {
        echo '<tbody>';


        echo '   
            <tr id="cost_academic">
        <th id="total" colspan="1"></th>
        <th id="total" colspan="4">ค่าเช่าห้อง</th>
        <th colspan="5"><a class="btn btn-primary btn-xs pull-right" onclick="myCreateFunction(3)" data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a></th>
        </tr>';


        $sql2 = "SELECT * FROM budget_form WHERE project_id = '" . $_SESSION['project_id'] . "' AND title = '3' ";
        $result2 = $conn->query($sql2);
        $i3 = 1;
        $count_del6=0;
        while ($row2 = $result2->fetch_assoc()) {

            echo '<tr>
                <td><input type="text"  style="width: 99%;"   name="no[]"  class="edit"      id="edit1-' . $i3 . '-3"  value ="' . $row2["no"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="list[]"  class="edit"    id="edit2-' . $i3 . '-3"  value ="' . $row2["list"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="quantity[]" class="edit"  id="edit3-' . $i3 . '-3"  onclick="test(id)" value ="' . $row2["quantity"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="rate[]"  class="edit"     id="edit4-' . $i3 . '-3" onclick="test(id)"  value ="' . $row2["rate"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="cost1[]"  class="edit"    id="edit5-' . $i3 . '-3"  value ="' . $row2["cost"] . '" readonly><input type="hidden" name="title[]" value="3"></td>
                <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
                <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction(3)"></td>
                </tr> ';
            $i3++;
            $count_del6++;
        }
        break;
    }


    while ($row = $result->fetch_assoc()) {
        echo '<tbody>';


        echo '   
            <tr id="cost_etc">
            <th id="total" colspan="1"></th>
            <th id="total" colspan="4">ค่าใช้จ่ายอื่นๆ</th>
            <th colspan="5"><a class="btn btn-primary btn-xs pull-right" onclick="myCreateFunction(4)" data-added="0"><i class="glyphicon glyphicon-plus"></i> เพิ่ม </a></th>
            </tr>';


        $sql2 = "SELECT * FROM budget_form WHERE project_id = '" . $_SESSION['project_id'] . "' AND title = '4' ";
        $result2 = $conn->query($sql2);
        $i4 = 1;
        $count_del8=0;
        while ($row2 = $result2->fetch_assoc()) {

            echo '<tr>
                <td><input type="text"  style="width: 99%;"   name="no[]"  class="edit"      id="edit1-' . $i4 . '-4"  value ="' . $row2["no"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="list[]"  class="edit"    id="edit2-' . $i4 . '-4"  value ="' . $row2["list"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="quantity[]" class="edit"  id="edit3-' . $i4 . '-4"  onclick="test(id)" value ="' . $row2["quantity"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="rate[]"  class="edit"     id="edit4-' . $i4 . '-4" onclick="test(id)"  value ="' . $row2["rate"] . '" ></td>
                <td><input type="text"  style="width: 99%;"   name="cost1[]"  class="edit"    id="edit5-' . $i4 . '-4"  value ="' . $row2["cost"] . '" readonly><input type="hidden" name="title[]" value="4"></td>
                <td> <i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> </td>
                <td> <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction(4)"></td>
                </tr> ';
            $i4++;
            $count_del8++;
        }
        break;
    }

    echo '</tbody>';

    $sql2 = "SELECT * FROM create_project WHERE project_id = '" . $_SESSION['project_id'] . "'";
    $result2 = $conn->query($sql2);
    while ($row2 = $result2->fetch_assoc()) {

        echo '
        <tfoot>
            <tr id="total2">
            <th id="total" colspan="4"><input type="text" style="width: 99%;" readonly value="รวมค่าใช้จ่าย :"></th>
            <th> <input type="text" style="width: 99%;" name="result" id="result" value = "' .  number_format($row2["result_budget"],2). '" readonly></th>
            </tr>

            <tr>
            <th id="" colspan="4"><input type="text" style="width: 99%;" readonly value="+15 % (ค่าบริการวิชาการ) :"></th>
            <th> <input type="text" style="width: 99%;" name="operation_fee" id="operation_fee" value = "' .  number_format(($row2["result_budget"]*0.15),2). '" readonly></th>
            </tr>

            <tr>
            <th id="" colspan="4"><input type="text" style="width: 99%;" readonly value="รวมค่าใช้จ่ายสุทธิ :"></th>
            <th> <input type="text" style="width: 99%;" name="sum_total" id="sum_total" value =  "' .  number_format($row2["result_budget"]*0.15+$row2["result_budget"],2). '" readonly></th>
            </tr>

         </tfoot>';
    } ?>
</table>
<!-- 
<input type=button value=pdf onclick="generatePdf()">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
    crossorigin="anonymous"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    function download() {
        let pdf = new jsPDF('l', 'pt', [1920, 640]);
        pdf.html(document.getElementById('tb_Logbook'), {
            callback: function (pdf) {
                pdf.save('test.pdf');
            }
        });
    }
</script> -->

<script>

    var del2 = 2;

    var del4 = "<?php echo $count_del2+3  ?>";
    var del6 = "<?php echo $count_del2+$count_del4+4  ?>";
    var del8 = "<?php echo $count_del2+$count_del4+$count_del6+5  ?>";

    console.log("del2 = "+del2);
    console.log("del4 = "+del4);
    console.log("del6 = "+del6);
    console.log("del8 = "+del8);

    var num, total_topic = 4;
    var i1 = "<?php echo $i1 - 1 ?>";
    var i2 = "<?php echo $i2 - 1 ?>";
    var i3 = "<?php echo $i3 - 1 ?>";
    var i4 = "<?php echo $i4 - 1 ?>";

    $('#edit1-' + 1 + '-' + 1).val(i1);
    $('#edit1-' + 1 + '-' + 2).val(i2);
    $('#edit1-' + 1 + '-' + 3).val(i3);
    $('#edit1-' + 1 + '-' + 4).val(i4);

    function myCreateFunction(topic) {
        total_topic = total_topic + 1;
        // console.log("total_topic" + total_topic);
        var table = document.getElementById("table");

        if (topic == 1) {
            var index = document.getElementById("cost_progress").rowIndex;

            i1++;
            num = i1;

        } else if (topic == 2) {
            var index = document.getElementById("cost_academic").rowIndex;
            i2++;
            num = i2;
        }
        if (topic == 3) {
            var index = document.getElementById("cost_etc").rowIndex;
            i3++;
            num = i3;
        }
        if (topic == 4) {
            var index = document.getElementById("total2").rowIndex;
            i4++;
            num = i4;
        }
        var row = table.insertRow(index);

        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);



        cell1.innerHTML = "<input type='text' class='edit' name ='no[]'   id='edit1-" + num + "-" + topic + "'  style='width: 99%; cursor: auto;' >  <input type='hidden' name='title[]' value=" + topic + ">";
        cell2.innerHTML = "<input type='text' class='edit' name ='list[]'     id='edit2-" + num + "-" + topic + "' style='width: 99%; cursor: auto;'>";
        cell3.innerHTML = "<input type='text' class='edit' name ='quantity[]'  id='edit3-" + num + "-" + topic + "' onclick='test(id)' style='width: 99%; cursor: auto;'> ";
        cell4.innerHTML = "<input type='text' class='edit' name='rate[]'  id='edit4-" + num + "-" + topic + "'  onclick='test(id)' style='width: 99%; cursor: auto;'> ";
        cell5.innerHTML = "<input type='text' class='edit' name = 'cost1[]'  id='edit5-" + num + "-" + topic + "' style='width: 99%; cursor: auto;' readonly>";

        cell6.innerHTML = '<i class="glyphicon glyphicon-pencil i" style="cursor: pointer;"  onclick="myEditFunction()"> ';
        cell7.innerHTML = ' <i class="glyphicon glyphicon-trash i" style="cursor: pointer;" onclick="myDeleteFunction(' + topic + ')">';



        if (topic == 1) {
            $('#edit1-' + num + '-' + topic).val(i1);
            del4++;
            del6++;
            del8++;
        }
        if (topic == 2) {
            $('#edit1-' + num + '-' + topic).val(i2);
            del6++;
            del8++;
        }
        if (topic == 3) {
            $('#edit1-' + num + '-' + topic).val(i3);
            del8++;
        }
        if (topic == 4) {
            $('#edit1-' + num + '-' + topic).val(i4);
        }


        // myEditFunction();
    }




    var edit5;

    function test(id) {
        // console.log(id);
        var a = id.slice(6, id.length);
        // console.log(a);


        $('#edit3-' + a + ',#edit4-' + a).keyup(function() {
            var edit3;
            var edit4;
            edit3 = parseFloat($('#edit3-' + a).val());
            edit4 = parseFloat($('#edit4-' + a).val());
            edit5 = edit3 * edit4;
            // console.log("edit5 edit5 "  + edit5);
            $('#edit5-' + a).val(edit5.toFixed(2));

            if (isNaN(edit5)) {
                // console.log("skip");
            } else {
                sum();
            }
        });

    }


    var total = 0;
    var operation_fee =0;
    var sum_total =0; 

    function sum() {

        cal_sum(1, i1);
        cal_sum(2, i2);
        cal_sum(3, i3);
        cal_sum(4, i4);
        $('#result').val(total.toFixed(2));

        operation_fee = total*0.15; 
        $('#operation_fee').val(operation_fee.toFixed(2));

        sum_total = operation_fee+total
        $('#sum_total').val(sum_total.toFixed(2));


        
        console.log(total);
        total = 0;
    }


    

    function cal_sum(topic, c_num) {
        console.log("c_num  "+c_num);
        for (var count = 1; count <= c_num; count++) {

            var stored = parseFloat($('#edit5-' + count + '-' + topic).val());
            if (isNaN(stored)) {
                stored = 0;
            }
            console.log("SDfsdf"+total);
            total = total + stored;

        }
    }




    var a;

    function myDeleteFunction(topic) {
        var index, table = document.getElementById('table');
        if (topic == 1) {
            a = document.getElementById("cost_progress").rowIndex;
            del_num(del2, topic);
        } else if (topic == 2) {
            a = document.getElementById("cost_academic").rowIndex;
            del_num(del4, topic);
        }
        if (topic == 3) {
            a = document.getElementById("cost_etc").rowIndex;
            del_num(del6, topic);
        }
        if (topic == 4) {
            a = table.rows.length - 1;
            del_num(del8, topic);
        }
    }

    function del_num(del_num, topic) {
        console.log("all" + a);
        console.log("least" + del_num);
        for (var i = del_num; i <= a; i++) {
            table.rows[i].cells[6].onclick = function() {

                var c = confirm("แน่ใจนะที่ต้องการจะลบ?");
                if (c === true) {
                    if (topic == 1) {
                        del4--;
                        del6--;
                        del8--;
                    }
                    if (topic == 2) {
                        del6--;
                        del8--;
                    }
                    if (topic == 3) {
                        del8--;
                    }
                    if (topic == 4) {}
                    index = this.parentElement.rowIndex;
                    table.deleteRow(index);
                    sum(i);
                }

                console.log("Index deleted: " + index);
            };
        }
    }

    // function myEditFunction() {
    //     var index, table = document.getElementById('table');
    //     for (var i = 2; i < table.rows.length; i++) {
    //         table.rows[i].cells[5].onclick = function() {

    //             index = this.parentElement.rowIndex;
    //             console.log("This is index : " + index);
    //             ////    document.getElementById("no").disabled = false;
    //             if ($('input[id^="edit"]').is('[readonly]')) {

    //                 $('input[id^="edit"]').attr('readonly', false);
    //                 // console.log("table id " +table_id);
    //             } else {

    //                 $('input[id^="edit"]').attr('readonly', true);
    //             }

    //         };
    //     }

    // }
</script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</html>