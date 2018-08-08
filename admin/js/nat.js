//Loading data on request
var dataCount=10;
var did=$("#dir").html();
$("#reset").hide();
$("#show").click(function() {
	dataCount= dataCount + 5;
	$("#show").html('Loading');  
	$.ajax({  
	    url:"/iasacademic/admin/includes/nat.inc.php",  
	    method:"POST",  
	    data:{dataNewCount:dataCount, did:did},  
	    dataType:"json",  
	    success:function(data)  
	    {  
	    	$("#reset").show();
	        $("#show").html('Show More');
	        $('#data').html(data.d);
	        if(data.last == 1)
	        	$("#show").hide();
	    }  
	}); 
});

//Search data
var dir=$("#dir").html();
function load_data(query)
{
	
    $.ajax({
    	url:"/iasacademic/admin/includes/nat.inc.php",
    	method:"POST",
    	data:{query:query,dir:dir},
	    dataType:"json",
    	success:function(data)
    	{
       		$('#data').html(data.d);
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
	    	url:"/iasacademic/admin/includes/nat.inc.php",
	    	method:"POST",
	    	data:{dir:dir},
		    dataType:"json",
	    	success:function(data)
	    	{
	       		$('#data').html(data.d);
	    	}
	    });
    }
 });


$('.edit').click(function() {
	var sid = 'stmt'+this.id;
	var code = $('#'+sid).html();
	var aid = 'ans'+this.id;
	var ans = $('#'+aid).html();
	$('#nat_ans').val(ans);
	$('#summernote').summernote('code', code);
	$('#editor').modal('show'); 
});

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