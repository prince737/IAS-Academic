$('#questionForm').on('submit', function(e){
	e.preventDefault();
	var question_desc= $('#summernote').summernote('code');
	var option_no = $('#option_no').val();
	var moption_no = $('#moption_no').val();
	var mcq_ans = $('#mcq_ans').val();
	var nat_ans = $('#nat_ans').val();
	var mamcq_answers = $('#mamcq_answers').val();
	var qtype = $('#qtype').val();
	var qdir = $('#qdir').val();

	//cdl questions
	var cdltype = $('input[name=cdltype]:checked').val();
	var cdldir = $('#cdl_dir').val();
	var cdlid = $('#cdl_id').val();
	var cdlmcq_ans = $('#cdlmcq_ans').val();
	var cdlnat_ans = $('#cdlnat_ans').val();
	var cdlmcq_option = $('#cdlmcq_option').val();
		
	$.ajax({
		type: $(this).attr('method'),
		url: $(this).attr('action'),
		dataType: "json",
		data: {
			question_desc: question_desc,
			option_no: option_no,
			moption_no: moption_no,
			qtype: qtype,
			qdir: qdir,
			mcq_ans: mcq_ans,
			nat_ans: nat_ans,
			mamcq_answers: mamcq_answers,
			cdltype: cdltype,
			cdlmcq_ans: cdlmcq_ans,
			cdlnat_ans: cdlnat_ans,
			cdlmcq_option: cdlmcq_option,
			cdlid: cdlid,
			cdldir: cdldir,
		},
		success: function(data){
			//$json = json_decode($json, true);
			var response = data.msg;
			if(response.includes("Please")){
				$('.para').html(response);
				$('#success-modal').show();
			}
			else if(data.cdl_id || data.cdlquestion){
				$('.para').html(response);
				$('#success-modal').show();
				$('input[name="cdltype"]').prop('checked', false);
				$("#qadd").show();
				$('#cdl_data').html(data.cdl_statement);
				$("#qtype").val('0');
				$("#qdir").val('0');
				$("#qtype").hide();
				$(".cdl_before").hide();
				$("#qdir").hide();
				$("#l1").hide();
				$("#l2").hide();
				$('#cdlmcq_ans').val('');
				$('#cdlnat_ans').val('');
				$('#cdlmcq_option').val('');
				$('#summernote').summernote('code', '');
				if(data.cdl_id){
					$('#cdl_id').val(data.cdl_id);
					$('#cdl_dir').val(data.cdl_dir);
				}
			}
			else{
				/*Success Message*/
				$('.para').html(response+' <b>'+ qdir +'.</b>');
				$('#success-modal').show();

				/*Clearing text*/
				$('#option_no').val('');
				$('#moption_no').val('');
				$('#mcq_ans').val('');
				$('#nat_ans').val('');
				$('#mamcq_answers').val('');
				$('#summernote').summernote('code', '');

				/*Hiding divisions*/
				$("#qtype").val('0');
				$("#qdir").val('0');
				$('#mcq').hide();
	        	$('#nat').hide();
	        	$('#cdl').hide();
	        	$('#mamcq').hide();
	        	$('.summernote').hide();
			}
			
		}
	});
	return false;
});


$(document).ready(function(){
    $("#qtype").change(function(){
    	var type = $('#qtype').val();
    	$('.summernote').show();
        if(type=='MCQ'){
        	$('#mcq').show();
        	$('#nat').hide();
        	$('#cdl').hide();
        	$('#mamcq').hide();
        }
        else if(type=='NAT'){
        	$('#mcq').hide();
        	$('#nat').show();
        	$('#cdl').hide();
        	$('#mamcq').hide();
        }
        else if(type=='CDL'){
        	$('#mcq').hide();
        	$('#nat').hide();
        	$('#cdl').show();
        	$('#mamcq').hide();
        }
        else if(type=='MAMCQ'){
        	$('#mcq').hide();
        	$('#nat').hide();
        	$('#cdl').hide();
        	$('#mamcq').show();
        }
        else{
        	$('#mcq').hide();
        	$('#nat').hide();
        	$('#cdl').hide();
        	$('#mamcq').hide();
        	$('.summernote').hide();
        }
        
    });

    $('input:radio[name="cdltype"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'mcq') {
            $('#cdlmcq').show();
            $('#cdlnat').hide();
        }
        else{
        	$('#cdlnat').show();
            $('#cdlmcq').hide();
        }
    });
});
