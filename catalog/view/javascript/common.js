// JavaScript Document

$(document).ready(function(){
	
	$('.sidebar_menu ul.level_1 li a').click(function(e){
		
		if($(this).parent().children('ul.level_2').size() > 0){
			e.preventDefault();
			$(this).next('ul.level_2').slideToggle(500);
		}
		
	});
		
});