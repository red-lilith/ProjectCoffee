$( ".input" ).focusin(function() {
  $( this ).find( "span" ).animate({"opacity":"0"}, 100);
});

$( ".input" ).focusout(function() {
  $( this ).find( "span" ).animate({"opacity":"1"}, 100);
});

$(".login").submit(function(){
  $(this).find(".submit i").removeAttr('class').addClass("fa fa-check").css({"color":"#FFE4BA"});
  $(".submit").css({"background":"#A52B12", "border-color":"#CC6666"});
  $(".feedback").show().animate({"opacity":"1", "bottom":"-80px"}, 400);
  $("input").css({"border-color":"#A52B12"});
  return false;
});
