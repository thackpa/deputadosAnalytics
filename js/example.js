// Run the script on DOM ready:
$(function(){
 	$('#graph').visualize({type: 'pie', height: '300px', width: '420px'});
	$('#graph').visualize({type: 'bar', width: '420px'});
	$('#graph').visualize({type: 'area', width: '420px'});
	$('#graph').visualize({type: 'line', width: '420px'});
});