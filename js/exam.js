//FIRST QUESTION DIAPLAY
var pid = $('#pid').html();
var sid = $('#sid').html();
var eid = $('#eid').html();
changeQuestion(1, pid);

//SECURITY MECHANISM
$('#close_submit').click(function() {
	$('#success-modal').hide();
});
$('#close_submit1').click(function() {
	$('#ended').hide();
});
/*$(document).mousemove(function( event ) {
	if(event.pageY < 15 && event.pageX > 700){
		$('#success-modal').show();
	}
});*/


/*var interval = setInterval("myFunction()", 1);
	function myFunction() {
    if (!document.hasFocus()) {
    	clearInterval(interval);
        $('#left-tab').show();

		submission(2);
	}
}*/

//NAVIGATION BUTTONS
var qno = $('#no_of_questions').html();
var i;
var text = '';
var a = JSON.parse(localStorage.getItem("answers"));
for(i=1; i<=parseInt(qno); i++){
	if (a != null && a[i]) {
		if(a[i][1] === 'NEXT')		    
			text += '<button class="btn btn-default navbtn answered" id="sl'+i+'">'+i+'</button>';
		else if(a[i][1] === 'REVIEW' && a[i][0] !== null)	{
			text += '<button class="btn btn-default navbtn reviewa" id="sl'+i+'">'+i+'</button>';
		}
		else if(a[i][1] === 'REVIEW' && a[i][0] === null)
			text += '<button class="btn btn-default navbtn reviewna" id="sl'+i+'">'+i+'</button>';
		else{
			text += '<button class="btn btn-default navbtn na" id="sl'+i+'">'+i+'</button>';
		}
	}
	else{
		text += '<button class="btn btn-default navbtn" id="sl'+i+'">'+i+'</button>';
	}
}
$('#navigation').html(text);


//TIMER
var count=0;
var duration = 30 * 60;//parseInt($('#duration').html()) * 60;
	
var d = new Date();
var name = 'start';

time = Date.now();
//localStorage.removeItem(name);

if(localStorage.getItem(name) === null){
	localStorage.setItem(name,time);
}
if(localStorage.getItem('stop') === null){
	localStorage.setItem('stop',time);
}

var start = localStorage.getItem(name);
function timer()
{ 
	var stop = localStorage.getItem('stop');
	var timeLeft = duration - (((stop - start) / 1000) | 0);
   	var min = Math.floor(timeLeft / 60);
   	var sec = Math.floor(timeLeft % 3600 % 60);

	if(timeLeft<=0){
		clearTimeout(tm);
		if(count == 0)
			submission(3);
		localStorage.removeItem(name);
		localStorage.removeItem('stop');
		localStorage.removeItem('answers');
		document.getElementById("ended").style.display = "block";
	}
	else{
		document.getElementById("min").innerHTML = min<10?"0"+min:min;
		document.getElementById("sec").innerHTML = sec<10?"0"+sec:sec;				
	}

	if(localStorage.getItem('stop') !== null){
		localStorage.setItem('stop',parseInt(stop)+1000);
	}	
	//timeLeft--;
	tm = setTimeout(function(){ timer() }, 1000);
}



//$('#sl1').addClass('na');

//SUBMISSION
$('#submit').click(function() {
	submission(1);
});

//CLEAR RESPONSE
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
			$('#sl'+prev).addClass('answered');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('reviewna');
		}
		else{
			$('#sl'+prev).addClass('na');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('answered');
			$('#sl'+prev).removeClass('reviewna');
		}
	}
	else if(prev_type == 'MMCQ'){
		if($('input[name="option"]').is(':checked')){
			value = [];
			type = 'MMCQ';
			$("input:checkbox[name=option]:checked").each(function(){
			    value.push($(this).val());
			});
			$('#sl'+prev).addClass('answered');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('reviewna');
		}
		else{
			$('#sl'+prev).addClass('na');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('answered');
			$('#sl'+prev).removeClass('reviewna');
		}
	}
	else if(prev_type == 'NAT'){
		if($('#nat_ans').val().length > 0){
			value = $('#nat_ans').val();
			type = 'NAT';
			$('#sl'+prev).addClass('answered');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('reviewna');
		}
		else{
			$('#sl'+prev).addClass('na');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('answered');
			$('#sl'+prev).removeClass('reviewna');
		}
	}

	if (localStorage.answers) {
	    var a = JSON.parse(localStorage.getItem("answers"));
	    a[prev] = [value, 'NEXT'];
		localStorage.setItem("answers", JSON.stringify(a));
	    
	} else {
	  	var a = {};
	  	a[prev] = [value, 'NEXT'];
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
			$('#sl'+prev).addClass('reviewa');
			$('#sl'+prev).removeClass('reviewna');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('answered');
		}
		else{
			$('#sl'+prev).addClass('reviewna');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('answered');
		}
	}
	else if(prev_type == 'MMCQ'){
		if($('input[name="option"]').is(':checked')){
			value = [];
			type = 'MMCQ';
			$("input:checkbox[name=option]:checked").each(function(){
			    value.push($(this).val());
			});
			$('#sl'+prev).addClass('reviewa');
			$('#sl'+prev).removeClass('reviewna');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('answered');
		}
		else{
			$('#sl'+prev).addClass('reviewna');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('answered');
		}
	}
	else if(prev_type == 'NAT'){
		if($('#nat_ans').val().length > 0){
			value = $('#nat_ans').val();
			type = 'NAT';
			$('#sl'+prev).addClass('reviewa');
			$('#sl'+prev).removeClass('reviewna');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('answered');
		}
		else{
			$('#sl'+prev).addClass('reviewna');
			$('#sl'+prev).removeClass('reviewa');
			$('#sl'+prev).removeClass('na');
			$('#sl'+prev).removeClass('answered');
		}
	}

	if (localStorage.answers) {
	    var a = JSON.parse(localStorage.getItem("answers"));
	    a[prev] = [value, 'REVIEW'];
		localStorage.setItem("answers", JSON.stringify(a));
	    
	} else {
	  	var a = {};
	  	a[prev] = [value, 'REVIEW'];
		localStorage.setItem("answers", JSON.stringify(a));
	}	
	
	changeQuestion(parseInt(prev) + 1, pid);
});

//NUMBER NAV BUTTON CLICK
$('.navbtn').click(function() {	
	var sl_no = this.innerHTML;
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
			$('#sl'+sl_no).addClass('na');
			

			if (localStorage.answers) {
				var a = JSON.parse(localStorage.getItem("answers"));
		    	if(data.qtype == 'MCQ'){
		    		if (a[sl_no]) {				    
					    $('input[name=options][value='+a[sl_no][0]+']').prop('checked', true);
					}
		    	}
		    	else if(data.qtype == 'MMCQ'){
		    		if (a[sl_no]) {
		    			for (var i = 0; i < a[sl_no][0].length; i++) {
		    				$('input[name=option][value='+a[sl_no][0][i]+']').prop('checked', true);
						}					    
					}
		    	}
		    	else if(data.qtype == 'NAT'){
		    		if (a[sl_no]) {			    
					    $('#nat_ans').val(a[sl_no][0]);
					}
		    	}
		    }
	    }  
	});
}

function submission(status){
	var answers = localStorage.getItem('answers');
	count++;
	$.ajax({  
	    url:"includes/exam.inc.php",  
	    method:"POST",  
	    data:{eid:eid, pid:pid, sid:sid, answers:answers, status:status},  
	    dataType:"json",  
	    success:function(data)
	    {
	    	if(data.response = 'submitted'){
	    		if(status == 1)
	    			$('#finish').show();
	    		else if(status == 2)
	    			$('#left-tab').show();
	    		else
	    			$('#ended').show();
	    	}
	    }  
	});

    localStorage.removeItem(name);
	localStorage.removeItem('stop');
	localStorage.removeItem('answers');
}


