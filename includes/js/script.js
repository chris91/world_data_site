/*

My Custom JS
============

Author:  Theophilos Katsigiannis Bakalis Vasilis
Updated: April 2014
Notes:	 For presentation for hci uoi.gr

*/

$(function() {
	$('#alertMe').click(function(e) {
		e.preventDefault();	
		$('#successAlert').slideDown();
	});
	
	$('a.pop').click(function(e) {
		e.preventDefault();
	});

	$('a.pop').popover();

	$('[rel="tooltip"]').tooltip();

});


