var dataCount=10;

$('#search').on('click', function(e){
	var qdir = $('#qdir').val();
	var qtype = $('#qtype').val();
	var pid = $('#pid').html();
	if(qtype == '0' || qdir == '0'){
		alert("Please select correct option from dropdown.");
	}
	else{
		$.ajax({
			type: 'POST',
			url: 'includes/papers.inc.php', 
			dataType: "json",
			data: {
				pid: pid,
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
				
					if(dataCount>data.count){///
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
	var sl_no = $('#sl_no'+qid).val();
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
				sl_no: sl_no,
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


		        if(qtype == 'MCQ'){
		        	var var1 = parseInt($('#noMcq').html()) + 1;
		        	$('#noMcq').html(var1);
		        	if(!parseInt($('#marksMcq').html())){
		        		var1 =  parseInt(marks);
		        	}
		        	else{
		        		var1 = parseInt($('#marksMcq').html()) + parseInt(marks);
		        	}
		        	$('#marksMcq').html(var1);
		        }
		        else if(qtype == 'MMC'){
		        	var var1 = parseInt($('#noMmc').html()) + 1;
		        	$('#noMmc').html(var1);
		        	if(!parseInt($('#marksMmc').html())){
		        		var1 =  parseInt(marks);
		        	}
		        	else{
		        		var1 = parseInt($('#marksMmc').html()) + parseInt(marks);
		        	}		        	
		        	$('#marksMmc').html(var1);
		        }
		        else if(qtype == 'NAT'){
		        	var var1 = parseInt($('#noNat').html()) + 1;
		        	$('#noNat').html(var1);
		        	if(!parseInt($('#marksNat').html())){
		        		var1 =  parseInt(marks);
		        	}
		        	else{
		        		var1 = parseInt($('#marksNat').html()) + parseInt(marks);
		        	}	
		        	$('#marksNat').html(var1);
		        }
		        var total = parseInt($('#marksTotal').html()) + parseInt(marks);
		       	$('#marksTotal').html(total);
		       	$('#totalQues').html( parseInt($('#totalQues').html())+1);
		        
			}
		});
	}

});