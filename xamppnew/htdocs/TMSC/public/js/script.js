function accordion (){
	$(".accordion-tab").click(function(){
		var getAttr = 	$(this).attr("tab-target");
		var tabElement =	$(getAttr);
		if (tabElement.hasClass("tab-active")) {
			tabElement.removeClass("tab-active");
		}else{
			tabElement.addClass("tab-active");
		}
	})
}
function setCalendar(){
	    $( "#datepicker" ).datepicker();
}

$(document).ready(function(){
	accordion();
	setCalendar();
})