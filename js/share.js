$(document).ready(function(){

$('#statusbutton').click(function(){
	
$.post("share.php",{},function(data){
	$('#statustext').val(data);
	
});
	
	
	
	
});
});