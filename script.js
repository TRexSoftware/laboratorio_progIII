var num = 40;
$(window).bind('scroll', function () {
    if ($(window).scrollTop() > num) {
        $('.menu').addClass('fixed');
    } else {
        $('.menu').removeClass('fixed');
    }
});

function visibilidad(id) {
    var e = document.getElementById(id);
	if(e.style.display == 'block')
	  e.style.display = 'none';
     else
      e.style.display = 'block';
}
