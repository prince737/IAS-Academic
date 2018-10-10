$('#data').on('click', '.remq', function(e){
	$("#remModal").modal("show");
	var qid = this.id;
	var qtype = qid.substring(0,3);
	qid = qid.substring(3);
	var qpid = $('#pid').html();

	$("#qid").html(qid);
	$("#qtype").html(qtype);
	$("#qpid").html(qpid);
	/*var qid = this.id;
	var qtype = qid.substring(0,3);
	qid = qid.substring(3);
	var qpid = $('#pid').html();

	firstChar = qtype.substring( 0, 1 ); // == "c"
	firstChar = firstChar.toUpperCase();
	tail = qtype.substring( 1 ); // == "heeseburger"
	qt = firstChar + tail;

	alert(qtype)
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
			$('#data').html(data.d);
			$("#success-modal").show();
		}
	});*/
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
			$('#data').html(data.d);
			$("#success-modal").show();
		}
	});
});