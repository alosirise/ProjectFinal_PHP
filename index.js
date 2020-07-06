$.get("navbar2.php", function (data) {
  $("#nav").replaceWith(data);
});

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

$(document).ready(function () {});

if (document.URL.includes("home.php")) {
  //slide show in Home
  var slideIndex = 1;
  showDivs(slideIndex);

  function plusDivs(n) {
    showDivs((slideIndex += n));
  }

  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {
      slideIndex = 1;
    }
    if (n < 1) {
      slideIndex = x.length;
    }
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    x[slideIndex - 1].style.display = "block";
  }
}

if (document.URL.includes("create_project.php")) {
  var i = 1;
  $(".button").click(function () {
    // $('<br/><input name="name' + (++i) + '" type="text"/>').insertAfter(this);

    $(
      '<br/> <input type="text" name ="name1' +
        ++i +
        '" class="form-control" id="exampleFormControlInput1" placeholder="">'
    ).insertAfter(this);
  });

}





if (document.URL.includes("edit_project.php")) {
  var i = 1;
  $(".button").click(function () {
    // $('<br/><input name="name' + (++i) + '" type="text"/>').insertAfter(this);

    $(
      '<br/> <input type="text" name ="name1' +
        ++i +
        '" class="form-control" id="exampleFormControlInput1" placeholder="">'
    ).insertAfter(this);
  });
}




