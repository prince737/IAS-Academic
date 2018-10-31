//REMOVE
$('#data').on('click', '.remq', function(e){
	$("#remModal").modal("show");
	var qid = this.id;
	var qtype = qid.substring(0,3);
	qid = qid.substring(3);
	var qpid = $('#pid').html();

	$("#qid").html(qid);
	$("#qtype").html(qtype);
	$("#qpid").html(qpid);
});

$('#removeQes').on('click', function(e){
	$("#remModal").modal("hide");
	var qid = $("#qid").html();
	var qtype = $("#qtype").html();
	var qpid = $("#qpid").html();
	

	firstChar = qtype.substring( 0, 1 ); // == "c"
	firstChar = firstChar.toUpperCase();
	tail = qtype.substring( 1 ); // == "heeseburger"
	qt = firstChar + tail;

	$.ajax({
		type: 'POST',
		url: 'includes/papers.inc.php', 
		dataType: "json",
		data: {
			remQ: 1,
			qtype: qtype,
			qpid: qpid,
			qid: qid,
		},
		success: function(data){
			$("#para").html(data.msg);
			$('#no'+qt).html(parseInt($('#no'+qt).html()) - 1);
			$('#marks'+qt).html(parseInt($('#marks'+qt).html()) - parseInt(data.marks));
			$('#marksTotal').html(parseInt($('#marksTotal').html()) - parseInt(data.marks));
			$('#data').html(data.d);
			$("#success-modal").show();
		}
	});
});

//EDIT

$('#data').on('click', '.edsl', function(e){
	$("#editsl").modal("show");
	var id = this.id;
	var qtype = id.substring(0,3);
	var id = id.substring(8);
	var marks = $('#marks'+id).html();
	var sl = $('#sl'+id).html();
	var qpid = $('#pid').html();
	var pid = $('#pid').html();
	

	$('#marks').val(marks);
	$('#serial').val(sl);

	$("#pqid").html(id);
	$("#qtype1").html(qtype);
	$("#pid1").html(pid);
	$("#prev_marks").html(marks);
});

$('#editQues').on('click', function(e){
	$("#editsl").modal("hide");
	var pqid = $("#pqid").html();
	var marks = $("#marks").val();
	var serial = $("#serial").val();
	var qtype = $("#qtype1").html();
	var pid = $("#pid1").html();
	var prev_marks = $("#prev_marks").html();


	firstChar = qtype.substring( 0, 1 ); // == "c"
	firstChar = firstChar.toUpperCase();
	tail = qtype.substring( 1 ); // == "heeseburger"
	qt = firstChar + tail;

	$.ajax({
		type: 'POST',
		url: 'includes/papers.inc.php', 
		dataType: "json",
		data: {
			editQ: 1,
			pqid: pqid,
			marks: marks,
			serial: serial,
			pid: pid,
		},
		success: function(data){
			$("#para").html(data.msg);

			if(prev_marks < data.marks){
				var diff = parseInt(data.marks) - parseInt(prev_marks);
				$('#marks'+qt).html(parseInt($('#marks'+qt).html()) + diff);
				$('#marksTotal').html(parseInt($('#marksTotal').html()) + diff);
			}
			else if(prev_marks > data.marks){
				var diff = parseInt(prev_marks) - parseInt(data.marks);
				$('#marks'+qt).html(parseInt($('#marks'+qt).html()) - diff);
				$('#marksTotal').html(parseInt($('#marksTotal').html()) - diff);
			}			
			$('#data').html(data.d);
			$("#success-modal").show();
		}
	});



});