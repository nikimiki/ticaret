$(document).ready(function(){
   $("#turkceDil-Tab").click(function(){
      $("#turkceDil-Box").toggle();
      $("#englishDil-Box").css("display", "none");
      $("#germanDil-Box").css("display", "none");
      $("#russianDil-Box").css("display", "none");
      $("#bulgarianDil-Box").css("display", "none");
      $("#arabianDil-Box").css("display", "none");
   });
});
$(document).ready(function(){
    $("#englishDil-Tab").click(function(){
        $("#englishDil-Box").show();
        $("#turkceDil-Box").css("display", "none");
        $("#germanDil-Box").css("display", "none");
        $("#russianDil-Box").css("display", "none");
        $("#bulgarianDil-Box").css("display", "none");
        $("#arabianDil-Box").css("display", "none");
    });
});
$(document).ready(function(){
    $("#germanDil-Tab").click(function(){
        $("#germanDil-Box").show();
        $("#turkceDil-Box").css("display", "none");
        $("#englishDil-Box").css("display", "none");
        $("#russianDil-Box").css("display", "none");
        $("#bulgarianDil-Box").css("display", "none");
        $("#arabianDil-Box").css("display", "none");
    });
});
$(document).ready(function(){
    $("#russianDil-Tab").click(function(){
        $("#russianDil-Box").show();
        $("#turkceDil-Box").css("display", "none");
        $("#englishDil-Box").css("display", "none");
        $("#germanDil-Box").css("display", "none");
        $("#bulgarianDil-Box").css("display", "none");
        $("#arabianDil-Box").css("display", "none");
    });
});
$(document).ready(function(){
    $("#bulgarianDil-Tab").click(function(){
        $("#bulgarianDil-Box").show();
        $("#turkceDil-Box").css("display", "none");
        $("#englishDil-Box").css("display", "none");
        $("#germanDil-Box").css("display", "none");
        $("#russianDil-Box").css("display", "none");
        $("#arabianDil-Box").css("display", "none");
    });
});
$(document).ready(function(){
    $("#arabianDil-Tab").click(function(){
        $("#arabianDil-Box").show();
        $("#turkceDil-Box").css("display", "none");
        $("#englishDil-Box").css("display", "none");
        $("#germanDil-Box").css("display", "none");
        $("#bulgarianDil-Box").css("display", "none");
        $("#russianDil-Box").css("display", "none");
    });
});