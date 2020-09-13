<?php
session_start();
include('auth.php');

if ($_SESSION['role'] != "admin") {
    header('location: home.php');
    exit();
}
include_once('connect.php');
?>

<!doctype html>
<html lang="en">

<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Latest compiled and minified CSS -->

   
    <!-- Bootstrap navbar CSS-->

    <link rel="stylesheet" href="navbar.css">
</head>
<style>
    #main {
        position: absolute;
        top: 50px;
        right: 25px;
        bottom: 25px;
        left: 24%;
    }
</style>

<body>
    <div class="" id="nav"></div>
    <div id="main">
        <div class="w3-container col-lg-10 center">
            <h2 style=" padding :30px; ">จัดการบัญชี</h2>

            <!-- <center><select id="select" style=" height:35px; width: 20%">
                    <option value="all">ทั้งหมด</option>
                    <option value="user">User</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select></center><br><br> -->



            <ul class="nav nav-tabs" role="tablist">
                <li> <a href="#list1" class="active nav-link" role="tab" data-toggle="tab">
                        <icon class="fa fa-home"></icon> รายชื่อผู้ใช้
                    </a>

                </li>
                <li><a href="#list2" class=" nav-link" role="tab" data-toggle="tab">
                        <i class="fa fa-user"></i> รายชื่อบุคลากร
                    </a>

                </li>
                <li><a href="#list3" class="nav-link" role="tab" data-toggle="tab">
                        <i class="fa fa-user"></i> รายชื่อผู้ดูแลระบบ
                    </a>

                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade active show " id="list1">

                    <div id="user_list">

                        <h2 style=" padding :35px;">รายชื่อผู้ใช้</h2>
                        <?php

                        $sql = "SELECT * FROM  member WHERE role = 'user' ";
                        $result = $conn->query($sql);
                        $number = 0;
                        if ($result->num_rows > 0) {
                            echo '                                    
                                <table class="table  table-responsive" id="table">
                                <thead>
                                    <tr class="w3-green">
                                    <th  style="width:4%" >ที่</th>
                                    <th style="width:35%" >ชื่อผู้ใช้</th>          
                                    <th data-orderable="false" style="width:15%"> สถานะ</th>
                                    <th data-orderable="false" style="width:15%"> แบน</th>
                                    
                                    </tr>
                                </thead> ';

                            while ($row = $result->fetch_assoc()) {
                                $number++;
                                echo "<tr><td>" . $number . ".</td><td>" . $row["username"] . "</td>  
                    <td><select name='change' id='change_role' style=' height:30px; width: 50%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                     onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                     else{location.href= 'change_role.php?id=" . $row['id'] . "&change='+this.value}\" 
                     >
                      <option value='user' ";
                                if ($row["role"] == 'user') {
                                    echo "selected='selected'";
                                }
                                echo ">User</option>
                      <option value='staff' ";
                                if ($row["role"] == 'staff') {
                                    echo "selected='selected'";
                                }
                                echo ">Staff</option>
                      <option value='admin' ";
                                if ($row["role"] == 'admin') {
                                    echo "selected='selected'";
                                }
                                echo ">Admin</option>
                    </select>
                    
                    </td>  

                    <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" >  <button type='button' name ='delete' class='btn btn-danger' >ลบ/แบน</button></a></td>         
                    </tr>";
                            }


                            echo "</table>  ";
                        } else {
                            echo " 0 account";
                        }
                        ?>
                    </div>
                </div>

                <div class="tab-pane fade " id="list2">

                    <div id="staff_list">

                        <h2 style=" padding :35px;">รายชื่อบุคลากร</h2>
                        <?php

                        $sql = "SELECT * FROM  member WHERE role = 'staff' ";
                        $result = $conn->query($sql);
                        $number = 0;
                        if ($result->num_rows > 0) {
                            echo '

                                <table class="table table-responsive" id="table2">
                                <thead>
                                    <tr class="w3-blue">
                                    <th  style="width:4%" >ที่</th>
                                    <th style="width:35%" >ชื่อบุคลากร</th>          
                                    <th data-orderable="false" style="width:15%"> สถานะ</th>
                                    <th data-orderable="false" style="width:15%"> แบน</th>
                                    
                                    </tr>
                                </thead> ';

                            while ($row = $result->fetch_assoc()) {
                                $number++;
                                echo "<tr><td>" . $number . ".</td><td>" . $row["username"] . "</td>  
                    <td><select name='change' id='change_role' style=' height:30px; width: 50%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                     onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                     else{location.href= 'change_role.php?id=" . $row['id'] . "&change='+this.value}\" 
                     >
                      <option value='user' ";
                                if ($row["role"] == 'user') {
                                    echo "selected='selected'";
                                }
                                echo ">User</option>
                      <option value='staff' ";
                                if ($row["role"] == 'staff') {
                                    echo "selected='selected'";
                                }
                                echo ">Staff</option>
                      <option value='admin' ";
                                if ($row["role"] == 'admin') {
                                    echo "selected='selected'";
                                }
                                echo ">Admin</option>
                    </select>
                    
                    </td>  

                    <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" >  <button type='button' name ='delete' class='btn btn-danger' >ลบ/แบน</button></a></td>         
                    </tr>";
                            }


                            echo "</table>";
                        } else {
                            echo " 0 account";
                        }


                        ?>
                    </div>

                </div>
                <div class="tab-pane fade" id="list3">
                    <div id="admin_list">

                        <h2 style=" padding :35px;">รายชื่อผู้ดูแลระบบ</h2>
                        <?php

                        $sql = "SELECT * FROM  member WHERE role = 'admin' ";
                        $result = $conn->query($sql);
                        $number = 0;
                        if ($result->num_rows > 0) {
                            echo '
                    <table class="table table-responsive" id="table3">
                    <thead>
                        <tr class="w3-indigo">
                        <th  style="width:4%" >ที่</th>
                        <th style="width:35%" >ชื่อผู้ดูแลระบบ</th>          
                        <th data-orderable="false" style="width:15%"> สถานะ</th>
                        <th data-orderable="false" style="width:15%"> แบน</th>
                        
                        </tr>
                    </thead> ';

                            while ($row = $result->fetch_assoc()) {
                                $number++;

                                if ($_SESSION['username'] == $row["username"]) {
                                    echo "<tr><td>" . $number . ".</td><td>" . $row["username"] . "</td>  
                    <td><select name='change' id='change_role' style=' height:30px; width: 50%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                     onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                     else{location.href= 'change_role.php?id=" . $row['id'] . "&change='+this.value}\" 
                     disabled>
                      <option value='user' ";
                                    if ($row["role"] == 'user') {
                                        echo "selected='selected'";
                                    }
                                    echo ">User</option>
                      <option value='staff' ";
                                    if ($row["role"] == 'staff') {
                                        echo "selected='selected'";
                                    }
                                    echo ">Staff</option>

                        <option value='admin' ";
                                    if ($row["role"] == 'admin') {

                                        echo "selected='selected' ";
                                    }
                                    echo ">Admin</option>
                        </select>

                    
                    </td>  

                    <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" >  <button type='button' name ='delete' class='btn btn-danger' >ลบ/แบน</button></a></td>         
                    </tr>";
                                } else {
                                    echo "<tr><td>" . $number . ".</td><td>" . $row["username"] . "</td>  
                            <td><select name='change' id='change_role' style=' height:30px; width: 50%' onfocus=\"this.setAttribute('PrvSelectedValue',this.value);\" 
                             onchange=\"if(confirm('Do you want to change?')==false) { this.value=this.getAttribute('PrvSelectedValue');return false; }
                             else{location.href= 'change_role.php?id=" . $row['id'] . "&change='+this.value}\" 
                             >
                              <option value='user' ";
                                    if ($row["role"] == 'user') {
                                        echo "selected='selected'";
                                    }
                                    echo ">User</option>
                              <option value='staff' ";
                                    if ($row["role"] == 'staff') {
                                        echo "selected='selected'";
                                    }
                                    echo ">Staff</option>
        
                                <option value='admin' ";
                                    if ($row["role"] == 'admin') {
                                        echo "selected='selected' ";
                                    }
                                    echo ">Admin</option>
                                </select>
                            
                            </td>  
                            <td><a onClick=\"javascript: return confirm('Please confirm deletion');\" >  <button type='button' name ='delete' class='btn btn-danger' >ลบ/แบน</button></a></td>         
                            </tr>";
                                }
                            }


                            echo "</table>";
                        } else {
                            echo " 0 account";
                        }


                        ?>

                    </div>
                </div>
            </div><br><br>


            <!-- jQuery first, then Popper.js, then minified and Bootstrap JS  -->
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>

            <script>
                $(document).ready(function() {
                    // $("#select").on("change", function() {
                    //     if ($('select').val() == 'user') {
                    //         $('#admin_list').hide();
                    //         $('#staff_list').hide();
                    //         $('#user_list').show();
                    //     } else if ($('select').val() == 'staff') {
                    //         $('#user_list').hide();
                    //         $('#staff_list').show();
                    //         $('#admin_list').hide();
                    //     } else if ($('select').val() == 'admin') {
                    //         $('#admin_list').show();
                    //         $('#user_list').hide();
                    //         $('#staff_list').hide();

                    //     } else {
                    //         $('#admin_list').show();
                    //         $('#user_list').show();
                    //         $('#staff_list').show();
                    //     }
                    // });

                    $('#table,#table2,#table3').DataTable({
                        "autoWidth": false,
                        "pagingType": "full_numbers",

                    });




                });
            </script>



            <script src="index.js"></script>
</body>

</html>