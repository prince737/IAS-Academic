$('#pid').change(function(){
	var pid = $('#pid').val();
	

	$.ajax({  
	    url:"includes/exams.inc.php",  
	    method:"POST",  
	    data:{pid:pid, flag:1},  
	    dataType:"json",  
	    success:function(data)
	    { 
	    	$('#paperid').html(pid);
			$('#plevel').html(data.level);
			$('#pmarks').html(data.marks);
			$('.paper').show();
	    }  
	}); 
});