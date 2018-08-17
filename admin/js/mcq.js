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
	var aid = 'ans'+this.id;
	var ans = $('#'+aid).html();
	var opt = 'opt'+this.id;
	var opt = $('#'+opt).html();
	
	$('#ans').val(ans);
	$('#opt').val(opt);
	$('#summernote').summernote('code', code);
	$('#editor').modal('show'); 
});

//directory id variable
var did=$("#dir").html();

//Saving edited data
$("#save").click(function() {
	var ans=$("#ans").val();
	var opt=$("#opt").val();
	var qid=$("#qid").html();
	var code = $('#summernote').summernote('code');
	$.ajax({  
	    url:"/iasacademic/admin/includes/mcq.inc.php",  
	    method:"POST",  
	    data:{code:code, ans:ans, qid:qid, opt:opt},  
	    dataType:"json",  
	    success:function(data)  
	    {  
	    	$('#editor').modal('hide');
	    	if(data.error){
	    		$("#success-modal").show();
	    	}
	    	else{
	    		$('#ans'+qid).html(data.ans);
	    		$('#stmt'+qid).html(data.val);
	    		$('#opt'+qid).html(data.opt);
	    	}	  
	    }  
	}); 
});

//Loading data on request
var dataCount=10;
var type=$("#type").html();

$("#reset").hide();
$("#show").click(function() {
	dataCount= dataCount + 5;
	$("#show").html('Loading');  
	$.ajax({  
	    url:"/iasacademic/admin/includes/mcq.inc.php",  
	    method:"POST",  
	    data:{dataNewCount:dataCount, did:did, type:type},  
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
    	url:"/iasacademic/admin/includes/mcq.inc.php",
    	method:"POST",
    	data:{query:query, dir:dir, type:type},
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
	    	url:"/iasacademic/admin/includes/mcq.inc.php",
	    	method:"POST",
	    	data:{dir:dir, type:type},
		    dataType:"json",
	    	success:function(data)
	    	{
	       		$('#data').html(data.d);
	       		$("#show").show();
				$("#search_res").hide();
				$("#cwrap").show();
				if(data.c < 10)
					$('#show').hide();
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