var dataCount=10;

$('#search').on('click', function(e){
	var qdir = $('#qdir').val();
	var qtype = $('#qtype').val();
	if(qtype == '0' || qdir == '0'){
		alert("Please select correct option from dropdown.");
	}
	else{
		$.ajax({
			type: 'POST',
			url: 'includes/papers.inc.php', 
			dataType: "json",
			data: {
				qtype: qtype,
				qdir: qdir,
				first: 1,
			},
			success: function(data){
				$("#show").html('Show More');
				$('#data').html(data.d);
				$('#data').show();	

				if(data.count>0){
					$('.nav_controls').show();	
				
					if(dataCount>data.count){
			        	$('#count').html(data.count);
			        }
			        else{
			        	$('#count').html(dataCount);
			        }
			        $('#count1').html(data.count);
				}

				if(data.last == 1)
	        		$("#show").hide();
				
			}
		});
	}
});


//LOADING DATA ON REQUEST
$("#show").click(function() {
	var qdir = $('#qdir').val();
	var qtype = $('#qtype').val();
	dataCount= dataCount + 5;
	$("#show").html('Loading');  
	$.ajax({  
	    url:"includes/papers.inc.php",  
	    method:"POST",  
	    data:{dataNewCount:dataCount, qdir:qdir, qtype:qtype},  
	    dataType:"json",  
	    success:function(data)  
	    { 
	        $("#show").html('Show More');
	        $('#data').html(data.d);
	        if(dataCount>data.count){
	        	$('#count').html(data.count);
	        }
	        else{
	        	$('#count').html(dataCount);
	        }	
	        
	        if(data.last == 1)
	        	$("#show").hide();
	    }  
	});
});

//Adding Question

$('#data').on('click', '.addq', function(e){

	var qtype = $('#qtype').val();
	var qid = this.id;
	var marks = $('#marks'+qid).val();
	var pid = $('#pid').html();
	var qdir = $('#qdir').val();

	if(!marks){
		alert("You must specify marks for the question.");
	}
	else{
		$.ajax({
			type: 'POST',
			url: 'includes/papers.inc.php', 
			dataType: "json",
			data: {
				addQuestion: 1,
				qtype: qtype,
				pid: pid,
				qid: qid,
				qdir: qdir,
				marks: marks,
			},
			success: function(data){
				$('#data').html(data.d);
				$("#para").html(data.msg);
				$("#success-modal").show();
				if(dataCount>data.count){
		        	$('#count').html(data.count);
		        }
		        else{
		        	$('#count').html(dataCount);
		        }
		        $('#count1').html(data.count);
			}
		});
	}

});