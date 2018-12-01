var exam_id = $('#eid').html();
console.log(exam_id);
getResults(exam_id);



$('#data').on('click', '.delete', function(e) {
	var id = this.id;
	var id = id.substr(6);
	alert(id);
	$('#id').html($('#id'+id).html());
	$("#success-modal").fadeIn();
});

$("#delbtn").click(function() {
	var eid = $('#eid').html();
	var id = $('#id').html();

	$.ajax({  
	    url:"includes/results.inc.php",  
	    method:"POST",
	    data:{delete:1, eid:eid, id: id},
	    dataType:"json",  
	    success:function(data)
	    {
	    	if(data.delete === '1'){
	    		alert('deteted');
	    	}
	    	else{
	    		alert('not deteted');
	    	}
	    	$('#data').html(data.d);
	    }  
	});
});

$('#search').keyup(function(){
    var search = $(this).val();

    if(search != '')
    {
    	var searchq = $('#search').val();
        $.ajax({  
		    url:"includes/results.inc.php",  
		    method:"POST",
		    data:{search:1, exam_id:exam_id, searchq:searchq},
		    dataType:"json",  
		    success:function(data)
		    {
		    	$('#data').html(data.d);
		    }  
		});
    }
    else
    {
        getResults(exam_id);
    }
 });


function getResults(){
	$.ajax({  
	    url:"includes/results.inc.php",  
	    method:"POST",
	    data:{initial:1, exam_id:exam_id},
	    dataType:"json",  
	    success:function(data)
	    {
	    	$('#data').html(data.d);
	    }  
	});
}