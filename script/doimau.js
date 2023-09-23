// JavaScript Document
$(document).ready(function(e) {
    $('table th:odd').addClass('odd');
	$('table tr').hover(function() {
        $(this).addClass('hover');
    }, function(){
		$(this).removeClass('hover');
		});
});