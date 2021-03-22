function corsError() {
  $.get(
    "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=46.5475311,15.6357408&radius=500&type=restaurant&keyword=fast&key=AIzaSyCVEC1ERr1a9XG8Etp3e26EHuYc3ZxfFOc",
    function (data) {
      console.log(data);
      $("#odg").append(data);
    }
  );
}

function proxy() {
  $.get("api/api2.php/proxy", function (data) {
    console.log(data);
    $("#odg").append(data);
  });
}

function cors() {
  komentar = { comment: "Nov komentar", username: "Nov username" };
  $.post("api/api2.php/komentar", komentar, function (data) {
    $("#cors").append(JSON.stringify(data));
  });
}

function izpisi(podatki) {
  $("#jsonp").append(JSON.stringify(podatki));
}

function jsonp() {
  var s = document.createElement("script");
  s.src = "api/api2.php/komentar/JSONP/izpisi";
  document.body.appendChild(s);
}

function emailChecked() {
  var access_key = "bdc604b4a60a34427f706ba8a13e4382";
  var email_address = $("#email").val();

  $.ajax({
    type:"get",
    url:
      "http://apilayer.net/api/check?access_key=" +
      access_key +
      "&email=" +
      email_address,
    dataType: "jsonp",
    success: function (json) {
      retEmail = json;
    },
    error: function (request, status, error) {
        alert(request.responseText);
    }
  });
}

function add() {
  emailChecked();
  $("#error").addClass("d-none");
  $("#error").html("");

  if ($("#email").val() == "") {
    $("#error").removeClass("d-none");
    $("#error").html("To polje manjka");
    return;
  }/* else if (!retEmail.mx_found) {
    $("#error").removeClass("d-none");
    $("#error").html("Email ne obstaja");
    return;
  }*/

  comment = {
    comment: $("#comment").val(),
    email: $("#email").val(),
    username: $("#username").val(),
    idAds: $("#idAds").val(),
  };

  $.post("api/api2.php/komentar", comment, function (data) {
    if ($("#cors").length) {
      $("#cors").append(JSON.stringify(data));
    }
  });
}

function getAll() {
  $.ajax({
    method: "get",
    url: "api/api2.php/komentar/",
    success: function (data) {
      //$("#cors").append(JSON.stringify(data));
      JSON.stringify(data);
      data.forEach((element) => {
        if ($("#FK_oglas").val() == element.idAds) {
          $("#komentarji").append(
            "<hr>Id: " +
              element.id +
              "<br>" +
              "Uporabnik: " +
              element.username +
              "<br>" +
              "Komentar: " +
              element.comment +
              "<br>" +
              "Datum: " +
              element.date +
              "<hr><br>"
          );
        }
      });
    },
  });
}

function getOne() {
  $.ajax({
    method: "get",
    url: "api/api2.php/komentar/" + $("#id").val(),
    success: function (data) {
      $("#cors").append(JSON.stringify(data));
    },
  });
}

function update() {
  komentar = { comment: $("#komentar").val() };
  $.ajax({
    method: "put",
    url: "api/api2.php/komentar/" + $("#id").val(),
    data: JSON.stringify(komentar),
    success: function (data) {
      $("#cors").append(JSON.stringify(data));
    },
  });
}

function deleteC() {
  $.ajax({
    method: "delete",
    url: "api/api2.php/komentar/" + $("#id").val(),
    success: function (data) {
      $("#cors").append(JSON.stringify(data));
      $("#id").val("");
    },
  });
}
