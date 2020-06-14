$.get("navbar2.php", function (data) {
  $("#nav").replaceWith(data);
});

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}



$(document).ready(function () {



});




if (document.URL.includes("home.php")) {
  //slide show in Home
  var slideIndex = 1;
  showDivs(slideIndex);

  function plusDivs(n) {
    showDivs(slideIndex += n);
  }

  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = x.length };
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    x[slideIndex - 1].style.display = "block";
  }
}



function triggerClick() {
  console.log("click");
  document.querySelector('#image').click();
}

function displayImage(e) {
  console.log("display");
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}


var i = 0;
function addRadio() {
  console.log("add radio click");
  i += 1;
  var addradio = '<div class="form-row radio' + i + '">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="ตัวเลือก">' +
    '</div>' +
    '<div>' +
    '<button type="button" class="btn-danger" onclick="delRadio(' + i + ')">ลบ</button>' +
    '</div>' +
    '</div>';

  $("#addradio").append(addradio);
  console.log("add radio" + i);
}


function delRadio(i) {
  console.log("i =" + i);
  console.log("del radio click");
  // ลบแบบ class
  $("div").remove(".radio" + i);
}



function selectClick() {
  var select1 = '<div style="background-color:white" id="selected">' +
    '<div class="form-row">' +
    '<div class="col-6" style="margin-right:50px">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="คำถามของคุณ">' +
    '</div>' +
    '</div>' +
    '<div class="col-5">' +
    '<select class="form-control" id="selectBox" onchange="selectClick()">' +
    '<option value="1" selected="selected">คำตอบสั้นๆ</option>' +
    '<option value="2">ย่อหน้า</option>' +
    '<option value="3">หลายตัวเลือก</option>' +
    '<option value="4">ช่องเครื่องหมาย</option>' +
    '</select>' +
    '</div>' +
    '<div style="margin-top:20px; margin-left:10px">' +
    '<label>ข้อความคำตอบสั้นๆ</label>' +
    '</div>' +
    '</div>' +
    '</div>';
  var select2 = '<div style="background-color:white" id="selected">' +
    '<div class="form-row">' +
    '<div class="col-6" style="margin-right:50px">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="คำถามของคุณ">' +
    '</div>' +
    '</div>' +
    '<div class="col-5">' +
    '<select class="form-control" id="selectBox" onchange="selectClick()">' +
    '<option value="1">คำตอบสั้นๆ</option>' +
    '<option value="2" selected="selected">ย่อหน้า</option>' +
    '<option value="3">หลายตัวเลือก</option>' +
    '<option value="4">ช่องเครื่องหมาย</option>' +
    '</select>' +
    '</div>' +
    '<div style="margin-top:20px; margin-left:10px">' +
    '<label>ข้อความคำตอบแบบยาว</label>' +
    '</div>' +
    '</div>' +
    '</div>';
  var select3 = '<div style="background-color:white" id="selected">' +
    '<div class="form-row">' +
    '<div class="col-6" style="margin-right:50px">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="คำถามของคุณ">' +
    '</div>' +
    '</div>' +
    '<div class="col-5">' +
    '<select class="form-control" id="selectBox" onchange="selectClick()">' +
    '<option value="1">คำตอบสั้นๆ</option>' +
    '<option value="2">ย่อหน้า</option>' +
    '<option value="3" selected="selected">หลายตัวเลือก</option>' +
    '<option value="4">ช่องเครื่องหมาย</option>' +
    '</select>' +
    '</div>' +
    '</div>' +
    '<div style="margin-top:20px; margin-left:10px">' +
    '<div class="form-row radio">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="ตัวเลือก">' +
    '</div>' +
    '</div>' +
    '<div id="addradio"></div>' +
    '<button type="button" class="btn-primary" onclick="addRadio()">เพิ่ม</button>' +
    '</div>' +
    '</div>';
  var select4 = '<div style="background-color:white" id="selected">' +
    '<div class="form-row">' +
    '<div class="col-6" style="margin-right:50px">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="คำถามของคุณ">' +
    '</div>' +
    '</div>' +
    '<div class="col-5">' +
    '<select class="form-control" id="selectBox" onchange="selectClick()">' +
    '<option value="1">คำตอบสั้นๆ</option>' +
    '<option value="2">ย่อหน้า</option>' +
    '<option value="3">หลายตัวเลือก</option>' +
    '<option value="4" selected="selected">ช่องเครื่องหมาย</option>' +
    '</select>' +
    '</div>' +
    '</div>' +
    '<div style="margin-top:20px; margin-left:10px">' +
    '<div class="form-row radio">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="ตัวเลือก">' +
    '</div>' +
    '</div>' +
    '<div id="addradio"></div>' +
    '<button type="button" class="btn-primary" onclick="addRadio()">เพิ่ม</button>' +
    '</div>' +
    '</div>';

  var selectBox = document.getElementById("selectBox");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  //alert(selectedValue);
  if (selectedValue == "1") {
    console.log("select-1");
    $("#selected").empty();
    $("#selected").append(select1);
  }
  if (selectedValue == "2") {
    console.log("select-2");
    $("#selected").empty();
    $("#selected").append(select2);
  } else if (selectedValue == "3") {
    console.log("select-3");
    $("#selected").empty();
    $("#selected").append(select3);
  } else if (selectedValue == "4") {
    console.log("select-4");
    $("#selected").empty();
    $("#selected").append(select4);
  }
}


function delQuestion(){
  console.log("del question click");
  //ลบแบบ id
  $("#delquestion").remove();
}