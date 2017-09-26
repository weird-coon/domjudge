// **** Materialize
$( document ).ready(function() {
	/*$(".dropdown-button").dropdown({ 
		//inDuration: 300, //Mac dinh
	    //outDuration: 225, //Mac dinh
	    constrainWidth: false, // Does not change width of dropdown to that of the activator
	    //hover: true, // Activate on hover
	    // gutter: 0, // Spacing from edge
	    //belowOrigin: false, // Displays dropdown below the button
	    //alignment: 'left', // Displays dropdown with edge aligned to the left of button
	   //stopPropagation: false // Stops event propagation 
		
	});*/
  	$(".button-collapse").sideNav(); //Side nav

  	//Tab
  	$('ul.tabs').tabs({
  		//swipeable: true,
  		responsiveThreshold: true
  	});
  	//Tooltip
  	$('.tooltipped').tooltip({delay: 50});

  	//Chip
  	$('.chips').material_chip();
  	var chip = {
	    tag: 'chip content',
	    image: '../images/hourglass.png', //optional
	    id: 1, //optional
	};
	//Select
	$('select').material_select();

	//collapsible
	$('.collapsible').collapsible();

});

// ******* Back to top
jQuery(document).ready(function($){
// browser window scroll (in pixels) after which the "back to top" link is shown
var offset = 300,
//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
offset_opacity = 1200,
//duration of the top scrolling animation (in ms)
scroll_top_duration = 700,
//grab the "back to top" link
$back_to_top = $('.back-top');

//hide or show the "back to top" link
$(window).scroll(function(){
( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
if( $(this).scrollTop() > offset_opacity ) {
$back_to_top.addClass('cd-fade-out');
}
});

//smooth scroll to top
$back_to_top.on('click', function(event){
event.preventDefault();
$('body,html').animate({
scrollTop: 0 ,
}, scroll_top_duration
);
});

});