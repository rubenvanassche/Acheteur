/*
	Directive by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

$('.toMain').click(function(){
	$('html,body').animate({
	 scrollTop: $("#main").offset().top
	 });
	 alert("test");
});

$('.toOrder').click(function(){
	$('html,body').animate({
	 scrollTop: $("#order").offset().top
	});
});

})(jQuery);
