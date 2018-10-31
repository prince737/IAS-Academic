var pid = $('#pid').html();
changeQuestion(1, pid);

//$('#1').addClass('na');


$('#clear_response').click(function() {
	$('input[name="options"]').prop('checked', false);
	$('input[name="option"]').prop('checked', false);
	$('#nat_ans').val('');
});

//SAVE AND NEXT
$('#save').click(function() {
	var prev = $('#qno').html();
	var prev_type = $('#qtype').html();
	var pid = $('#pid').html();
	var type = '';
	var value = '';

	if(prev_type == 'MCQ'){
		if($('input[name="options"]').is(':checked')){
			value = $('input[name=options]:checked').val();
			type = 'MCQ';
			$('#'+prev).addClass('answered');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('reviewna');
		}
		else{
			$('#'+prev).addClass('na');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('answered');
			$('#'+prev).removeClass('reviewna');
		}
	}
	else if(prev_type == 'MMCQ'){
		if($('input[name="option"]').is(':checked')){
			value = [];
			type = 'MMCQ';
			$("input:checkbox[name=option]:checked").each(function(){
			    value.push($(this).val());
			});
			$('#'+prev).addClass('answered');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('reviewna');
		}
		else{
			$('#'+prev).addClass('na');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('answered');
			$('#'+prev).removeClass('reviewna');
		}
	}
	else if(prev_type == 'NAT'){
		if($('#nat_ans').val().length > 0){
			value = $('#nat_ans').val();
			type = 'NAT';
			$('#'+prev).addClass('answered');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('reviewna');
		}
		else{
			$('#'+prev).addClass('na');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('answered');
			$('#'+prev).removeClass('reviewna');
		}
	}

	if (localStorage.answers) {
	    var a = JSON.parse(localStorage.getItem("answers"));
	    a[prev] = value;
		localStorage.setItem("answers", JSON.stringify(a));
	    
	} else {
	  	var a = {};
	  	a[prev] = value;
		localStorage.setItem("answers", JSON.stringify(a));
	}

	
	changeQuestion(parseInt(prev) + 1, pid);
});

//MARK FOR REVIEW
$('#review').click(function() {
	var prev = $('#qno').html();
	var prev_type = $('#qtype').html();
	var pid = $('#pid').html();
	var type = '';
	var value = '';

	if(prev_type == 'MCQ'){
		if($('input[name="options"]').is(':checked')){
			value = $('input[name=options]:checked').val();
			type = 'MCQ';
			$('#'+prev).addClass('reviewa');
			$('#'+prev).removeClass('reviewna');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('answered');
		}
		else{
			$('#'+prev).addClass('reviewna');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('answered');
		}
	}
	else if(prev_type == 'MMCQ'){
		if($('input[name="option"]').is(':checked')){
			value = [];
			type = 'MMCQ';
			$("input:checkbox[name=option]:checked").each(function(){
			    value.push($(this).val());
			});
			$('#'+prev).addClass('reviewa');
			$('#'+prev).removeClass('reviewna');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('answered');
		}
		else{
			$('#'+prev).addClass('reviewna');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('answered');
		}
	}
	else if(prev_type == 'NAT'){
		if($('#nat_ans').val().length > 0){
			value = $('#nat_ans').val();
			type = 'NAT';
			$('#'+prev).addClass('reviewa');
			$('#'+prev).removeClass('reviewna');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('answered');
		}
		else{
			$('#'+prev).addClass('reviewna');
			$('#'+prev).removeClass('reviewa');
			$('#'+prev).removeClass('na');
			$('#'+prev).removeClass('answered');
		}
	}

	if (localStorage.answers) {
	    var a = JSON.parse(localStorage.getItem("answers"));
	    a[prev] = value;
		localStorage.setItem("answers", JSON.stringify(a));
	    
	} else {
	  	var a = {};
	  	a[prev] = value;
		localStorage.setItem("answers", JSON.stringify(a));
	}	
	
	changeQuestion(parseInt(prev) + 1, pid);
});

$('.navbtn').click(function() {	
	var sl_no = this.id;
	var pid = $('#pid').html();

	//ADDING CLASSES TO NAV BUTTONS
	var prev = $('#qno').html();
	var prev_type = $('#qtype').html();

	changeQuestion(sl_no, pid);
});

//NAT NUMPAD
$(document).on('click', '.numbtn', function(e) {
	var curr = this.id;
	if (curr == 'bkspc'){
		var strng = $('#nat_ans').val();
		$('#nat_ans').val(strng.substring(0,strng.length-1));
	}

	if(curr == 'one'){
		$('#nat_ans').val($('#nat_ans').val() + '1');
	}else if(curr == 'two'){
		$('#nat_ans').val($('#nat_ans').val() + '2');
	}else if(curr == 'three'){
		$('#nat_ans').val($('#nat_ans').val() + '3');
	}else if(curr == 'four'){
		$('#nat_ans').val($('#nat_ans').val() + '4');
	}else if(curr == 'five'){
		$('#nat_ans').val($('#nat_ans').val() + '5');
	}else if(curr == 'six'){
		$('#nat_ans').val($('#nat_ans').val() + '6');
	}else if(curr == 'seven'){
		$('#nat_ans').val($('#nat_ans').val() + '7');
	}else if(curr == 'eight'){
		$('#nat_ans').val($('#nat_ans').val() + '8');
	}else if(curr == 'nine'){
		$('#nat_ans').val($('#nat_ans').val() + '9');
	}else if(curr == 'zero'){
		$('#nat_ans').val($('#nat_ans').val() + '0');
	}else if(curr == '.'){
		$('#nat_ans').val($('#nat_ans').val() + '.');
	}
});

function changeQuestion(sl_no, pid){
	$.ajax({  
	    url:"includes/exam.inc.php",  
	    method:"POST",  
	    data:{sl_no:sl_no, pid:pid},  
	    dataType:"json",  
	    success:function(data)
	    {
	    	$('#qno').html(sl_no);
			$('#marks').html(data.marks);
			$('#question_data').html(data.question_data);
			$('#response').html(data.response);
			$('#qtype').html(data.qtype);
			$('#'+sl_no).addClass('na');
			

			if (localStorage.answers) {
				var a = JSON.parse(localStorage.getItem("answers"));
		    	if(data.qtype == 'MCQ'){
		    		if (a[sl_no]) {				    
					    $('input[name=options][value='+a[sl_no]+']').prop('checked', true);
					}
		    	}
		    	else if(data.qtype == 'MMCQ'){
		    		if (a[sl_no]) {
		    			for (var i = 0; i < a[sl_no].length; i++) {
		    				$('input[name=option][value='+a[sl_no][i]+']').prop('checked', true);
						}					    
					}
		    	}
		    	else if(data.qtype == 'NAT'){
		    		if (a[sl_no]) {			    
					    $('#nat_ans').val(a[sl_no]);
					}
		    	}
		    }
		    else{
		    	alert('no ls');
		    }
			
	    }  
	});
}


/*
if (localStorage.clickcount) {
    var a = JSON.parse(localStorage.getItem("clickcount"));
    a.push('2');
	localStorage.setItem("clickcount", JSON.stringify(a));
    console.log(a[1]);
} else {
  	var names = [];
	names[0] = prompt("New member name?");
	localStorage.setItem("clickcount", JSON.stringify(names));
}
*/

