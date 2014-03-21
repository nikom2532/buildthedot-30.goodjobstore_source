jQuery(document).ready(function(){

	if($("ul.maomenu-horizontal").length) {
		$("ul.maomenu-horizontal li").dropdown();
	}

});

$.fn.dropdown = function() {

	return this.each(function() {

		$(this).hover(function(){
			$(this).addClass("hover");
			$('> .arrow-maomenu',this).addClass("open");
			$('ul:first',this).css('visibility', 'visible');
		},function(){
			$(this).removeClass("hover");
			$('.open',this).removeClass("open");
			$('ul:first',this).css('visibility', 'hidden');
		});

	});

}