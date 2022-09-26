
$(window).scroll(function(){
  if ($(this).scrollTop() > 50) {
     $('#fixed-header').addClass('fixed-head');
  } else {
     $('#fixed-header').removeClass('fixed-head');
  }
});
