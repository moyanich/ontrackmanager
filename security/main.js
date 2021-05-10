$(document).ready(function(){

	$('#basicTime').timepicker({
		'scrollDefault': 'now',
		'getTime': true,
		'noneOption': true,
		'typeaheadHighlight': true,
		'timeFormat': 'g:i a'
	}); 

	$('#logTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 15
	});

	$('[data-toggle="datepicker"]').datepicker({
		format: 'yyyy-mm-dd',
		autohide: true, 
    	startDate: new Date().toDateString(),
    	endDate: new Date()
	});
	
	/*
$('[data-toggle="datepicker"]').datepicker({
		format: 'yyyy-mm-dd',
		inline: true,
		template: '<div class="datepicker-panel" data-view="days picker">' +
	    '<ul><li data-view="month prev">&lsaquo;</li>' + '<li data-view="month current"></li>' +
	      '<li data-view="month next">&rsaquo;</li>' +
	    '</ul>' +
	    '<ul data-view="week"></ul>' +
	   '<ul data-view="days"></ul>' +
	  '</div>' +
	'</div>',

	inline: true,
		template: '<div class="datepicker-container">' + '<div class="datepicker-panel" data-view="years picker">' + '<ul>' + '<li data-view="years prev">&lsaquo;</li>' + '<li data-view="years current"></li>' + '<li data-view="years next">&rsaquo;</li>' + '</ul>' + '<ul data-view="years"></ul>' + '</div>' + '<div class="datepicker-panel" data-view="months picker">' + '<ul>' + '<li data-view="year prev">&lsaquo;</li>' + '<li data-view="year current"></li>' + '<li data-view="year next">&rsaquo;</li>' + '</ul>' + '<ul data-view="months"></ul>' + '</div>' + '<div class="datepicker-panel" data-view="days picker">' + '<ul>' + '<li data-view="month prev">&lsaquo;</li>' + '<li data-view="month current"></li>' + '<li data-view="month next">&rsaquo;</li>' + '</ul>' + '<ul data-view="week"></ul>' + '<ul data-view="days"></ul>' + '</div>' + '</div>',
	
    // Shorter days' name
    daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
   
    // Shorter months' name
    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    // A element tag for each item of years, months and days
		
		autopick: true,
		autohide: true, 
    	startDate: new Date().toDateString(),
    	endDate: new Date()
	});
	*/


});