$(document).ready(function(){

	$('#empTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 25,
		"order": [1, "asc"]
	});

	$('#logHistoryTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 25,
		"order": [3]
	});


	$('#historyTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 50,
		"order": [2]
	});
	


	$('#AdminlogTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 10
	});

	$('#fulllogTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 10
	});

	$('#userTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 10
	});


	/*

	$('#attendanceReport').DataTable({
		"bFilter": true,
		"bSort": true
	});
 */

	


	


	$('[data-toggle="admindatetimepicker"]').datepicker({
		format: 'yyyy-mm-dd',		
	});
	

	$('[data-toggle="admindateendtimepicker"]').datepicker({
		format: 'yyyy-mm-dd',		
	});


	$('[data-toggle="admindatestarttimepicker"]').datepicker({
		format: 'yyyy-mm-dd',		
	});

	$('[data-toggle="reportPicker1"]').datepicker({
		format: 'yyyy-mm-dd',
		autohide: true,
	});

	$('[data-toggle="reportPicker2"]').datepicker({
		format: 'yyyy-mm-dd',
		autohide: true, 
	});

	/*
	
	$('#stockTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 15
	});

	$('#orderTable').DataTable({
		"bLengthChange": true,
		"bInfo": true,
		"bPaginate": true,
		"bFilter": true,
		"bSort": true,
		"pageLength": 25
	}); */

	
});


