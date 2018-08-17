//Toolbar Adjust
$('#editor').on('shown.bs.modal', function(){
    $('.note-toolbar-wrapper').removeAttr('style');    
    $('.note-toolbar').removeAttr('style');
})

//count adjust


//retrieving values for editor
$(document).on('click', '.edit', function(e) {
	$('#qid').html(this.id);
	var sid = 'stmt'+this.id;
	var code = $('#'+sid).html();
	$('#summernote').summernote('code', code);
	$('#ans').hide();
	$('#opt').hide();
	$('#save').show();
	$('#saveq').hide();
	$('#editor').modal('show'); 
});

//directory id variable
var did=$("#dir").html();

//Saving edited data
$("#save").click(function() {
	var code = $('#summernote').summernote('code');
	var qid=$("#qid").html();
	$.ajax({  
	    url:"/iasacademic/admin/includes/cdl.inc.php",  
	    method:"POST",  
	    data:{code:code, qid:qid},  
	    dataType:"json",  
	    success:function(data)  
	    {  
	    	$('#editor').modal('hide');
	    	if(data.error){
	    		$("#success-modal").show();
	    	}
	    	else{
	    		$('#stmt'+qid).html(data.val);
	    	}	  
	    }  
	}); 
});

//Deleting question
$(".delete").click(function() {
	var qid=this.id;
	qid = qid.substring(1);
	$.ajax({  
	    url:"/iasacademic/admin/includes/cdl.inc.php",  
	    method:"POST",  
	    data:{del:qid},  
	    dataType:"json",  
	    success:function(data)  
	    {  
	    	$('#editor').modal('hide');
	    	if(data.error){
	    		$("#success-modal").show();
	    	}
	    	else{
	    		$("#delete-modal").show();
	    	}	  
	    }  
	}); 
});

//Loading data on request
var dataCount=10;

$("#reset").hide();
$("#show").click(function() {
	dataCount= dataCount + 5;
	$("#show").html('Loading');  
	$.ajax({  
	    url:"/iasacademic/admin/includes/cdl.inc.php",  
	    method:"POST",  
	    data:{dataNewCount:dataCount, did:did},  
	    dataType:"json",  
	    success:function(data)  
	    {  
	    	$("#reset").show();
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

//Search data
var dir=$("#dir").html();
function load_data(query)
{
	$("#show").hide();
	$("#cwrap").hide();
    $.ajax({
    	url:"/iasacademic/admin/includes/cdl.inc.php",
    	method:"POST",
    	data:{query:query, dir:dir},
	    dataType:"json",
    	success:function(data)
    	{
       		$('#data').html(data.d);
       		$('#no').html(data.count);
       		$('#string').html(query);
			$("#search_res").show();
    	}
    });
}


$('#search').keyup(function(){
    var search = $(this).val();

    if(search != '')
    {
        load_data(search);
    }
    else
    {
        $.ajax({
	    	url:"/iasacademic/admin/includes/cdl.inc.php",
	    	method:"POST",
	    	data:{dir:dir},
		    dataType:"json",
	    	success:function(data)
	    	{
	       		$('#data').html(data.d);
				$("#search_res").hide();
				$("#cwrap").show();
				if(data.c > 10)
					$('#show').show();
	    	}
	    });
    }
 });



//Summernote image upload
function sendFile(file, el) {
	var form_data = new FormData();
	form_data.append('file', file);
	$.ajax({
	    data: form_data,
	    type: "POST",
	    url: 'editor-upload.php',
	    cache: false,
	    contentType: false,
	    processData: false,
	    success: function(url) {
	        $(el).summernote('editor.insertImage', url);
	    }
	});
}

//Summernote image delete
function deleteFile(src) {
    $.ajax({
        data: {src : src},
        type: "POST",
        url: 'editor-delete.php', // replace with your url
        cache: false,
        success: function(resp) {
            console.log(resp);
        }
    });
}



/*NAT MCQ EDIT BEGINS HERE*/
$(".form-wrapper").on("click", ".nat", function() {
	var id = this.id.substring(3);
	if ($("#nat_data"+id).is(':empty')){
		$.ajax({
		   	url:"/iasacademic/admin/includes/cdl.inc.php",
		   	method:"POST",
		   	data:{cdl_id:id, type:'nat'},
		    dataType:"json",
		   	success:function(data)
		   	{
		   		$("#nat_data"+id).html(data.d);
				$("#nat_data"+id).slideToggle();
				$("#mcq_data"+id).hide();
		   	}
		});
	}
	else{
		$("#nat_data"+id).slideToggle();
		$("#mcq_data"+id).hide();
	}
	
});

//Saving edited question
$("#saveq").click(function() {
	var code = $('#summernote').summernote('code');
	var type=$("#type").html();
	var ans = $('#ans').val();
	var opt = $('#opt').val();
	var qid = $('#nat_mcq_id').html();

	if(type=='mcq' && (ans==='' || opt === '')){
		alert("All fields are required!");
	}
	else if(type=='nat' && ans===''){
		alert("All fields are required!");
	}
	else{
		$.ajax({  
		    url:"/iasacademic/admin/includes/cdl.inc.php",  
		    method:"POST",  
		    data:{code:code, qid:qid, ans:ans,opt:opt,type:type, edit:1},  
		    dataType:"json",  
		    success:function(data)  
		    {  
		    	if(data.error){
		    		$('.para').html(data.error);
		    		$('#success-modal').show();
		    	}
		    	else{
		    		if(type=='mcq'){
						$('#mcqans'+qid).html(data.ans);
	    				$('#mcqstmt'+qid).html(data.val);
	    				$('#mcqopt'+qid).html(data.opt);		    			
		    		}
		    		else{
		    			$('#natans'+qid).html(data.ans);
	    				$('#natstmt'+qid).html(data.val);
		    		}
		    		$('.para').html(data.success);
		    		$('#success-modal').show();
		    	}
		    	$('#editor').modal('hide');
		    	
		    }  
		});
	}
});

$(".form-wrapper").on("click", ".mcq", function() {
	var id = this.id.substring(3);
	if ($("#mcq_data"+id).is(':empty')){
		$.ajax({
		   	url:"/iasacademic/admin/includes/cdl.inc.php",
		   	method:"POST",
		   	data:{cdl_id:id, type:'mcq'},
		    dataType:"json",
		   	success:function(data)
		   	{
		   		$("#mcq_data"+id).html(data.d);
				$("#mcq_data"+id).slideToggle();
				$("#nat_data"+id).hide();
		   	}
		});
	}
	else{
		$("#mcq_data"+id).slideToggle();
		$("#nat_data"+id).hide();
	}
});


/*Editor values*/
$(document).on('click', '.inneredit', function(e) {
	var type = this.id.substring(0,3);
	var id = this.id.substring(7);
	var code = type+'stmt'+id;
	code = $("#"+code).html();
	var ans = type+'ans'+id;
	ans = $("#"+ans).html();

	if(type=='nat'){
		$('#ans').val(ans);
		$('#ans').show();
	}
	else{
		var opt = 'mcqopt'+id;
		opt = $("#"+opt).html();
		$('#ans').val(ans);
		$('#opt').val(opt);
		$('#ans').show();
		$('#opt').show();
	}
	$('#type').html(type);
	$('#nat_mcq_id').html(id);
	$('#summernote').summernote('code', code);
	$('#save').hide();
	$('#saveques').show();
	$('#editor').modal('show'); 
});

/*Adding linked questions*/
$(document).on('click', '.add', function(e) {
	$('#qid1').html(this.id.substring(3));
	$('#addques').modal('show'); 
});

//Question type
$('input:radio[name="cdltype"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'mcq') {
            $('#opt1').show();
            $('#ans1').show();
        }
        else{
        	$('#ans1').show();
        	$('#opt1').hide();
        }
    });

/*Adding Question*/
$("#saveques").click(function() {
	var code = $('#summernote1').summernote('code');
	var cdlid=$("#qid1").html();
	var type = $('input:radio[name="cdltype"]:checked').val();
	var ans = $('#ans1').val();
	var opt = $('#opt1').val();
	var cdldir = $('#dir').html();


	if(type=='mcq' && (ans==='' || opt === '')){
		alert("All fields are required!");
	}
	else if(type=='nat' && ans===''){
		alert("All fields are required!");
	}
	else{
		$.ajax({  
		    url:"/iasacademic/admin/includes/cdl.inc.php",  
		    method:"POST",  
		    data:{code:code, cdlid:cdlid, ans:ans,opt:opt,type:type, cdldir:cdldir, flag:1},  
		    dataType:"text",  
		    success:function(data)  
		    {  
		    	$('#addques').modal('hide');
		    	$('.para').html(data);
		    	$('#success-modal').show();
		    }  
		});
	}
});