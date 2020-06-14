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


var num_radio = 0;
function addRadio() {
  console.log("add radio click");
  num_radio += 1;
  var addradio = '<div class="form-row radio' + num_radio + '">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="ตัวเลือก">' +
    '</div>' +
    '<div>' +
    '<button type="button" class="btn-danger" onclick="delRadio(' + num_radio + ')">ลบ</button>' +
    '</div>' +
    '</div>';

  $("#addradio").append(addradio);
  console.log("add radio" + num_radio);
}


function delRadio(num_radio) {
  console.log("num radio = " + num_radio);
  console.log("del radio click");
  // ลบแบบ class
  $("div").remove(".radio" + num_radio);
}


var num_question = 0;
function addQuestion() {
  console.log("add queston click");
  num_question += 1;
  var question = '<div class="bewcard question'+num_question+'">' +
    '<div id="selected">' +
    '<div class="form-row">' +
    '<div class="col-7">' +
    '<input class="form-control" type="text" placeholder="คำถามของคุณ">' +
    '</div>' +
    '<div class="col-5">' +
    '<select class="form-control" id="selectBox' + num_question + '" onchange="selectClick()">' +
    '<option value="1">คำตอบสั้นๆ</option>' +
    '<option value="2">ย่อหน้า</option>' +
    '<option value="3">หลายตัวเลือก</option>' +
    '<option value="4">ช่องเครื่องหมาย</option>' +
    '</select>' +
    '</div>' +
    '</div>' +
    '<div style="margin-top:20px;">' +
    '<label>ข้อความคำตอบสั้นๆ</label>' +
    '</div>' +
    '</div>' +

    '<hr style="width:100%;text-align:left;margin-left:0">' +
    '<div style="margin-left:70%">' +
    '<button type="button" class="btn-primary">คัดลอก</button>' +
    '<button type="button" class="btn-danger" onclick="delQuestion('+num_question+')">ลบ</button>' +
    '<span>จำเป็น</span>' +
    '<label class="switch">' +
    '<input type="checkbox">' +
    '<span class="slider round"></span>' +
    '</label>' +
    '</div>' +
    '</div>';
  $("#question").append(question);
  console.log("add question = " + num_question);
}

function delQuestion(num_question) {
  console.log("num question =" + num_question);
  console.log("del question click");

  $("div").remove(".question"+num_question);
}


function selectClick() {
  var select1 = '<div id="selected">' +
    '<div class="form-row">' +
    '<div class="col-7">' +
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
    '</div>' +
    '<div style="margin-top:20px;">' +
    '<label>ข้อความคำตอบสั้นๆ</label>' +
    '</div>' +
    '</div>';
  var select2 = '<div id="selected">' +
    '<div class="form-row">' +
    '<div class="col-7">' +
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
    '</div>' +
    '<div style="margin-top:20px;">' +
    '<label>ข้อความคำตอบแบบยาว</label>' +
    '</div>' +
    '</div>';
  var select3 = '<div id="selected">' +
    '<div class="form-row">' +
    '<div class="col-7">' +
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
    '<div style="margin-top:20px; margin-left:5px">' +
    '<div class="form-row radio">' +
    '<div>' +
    '<input class="form-control" type="text" placeholder="ตัวเลือก">' +
    '</div>' +
    '</div>' +
    '<div id="addradio"></div>' +
    '<button type="button" class="btn-primary" onclick="addRadio()">เพิ่ม</button>' +
    '</div>' +
    '</div>';
  var select4 = '<div id="selected">' +
    '<div class="form-row">' +
    '<div class="col-7">' +
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
    '<div style="margin-top:20px; margin-left:5px">' +
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