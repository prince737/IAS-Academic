$(document).ready(function() {
	$('[data-toggle="offcanvas"]').click(function() {
		$('#mySidebar').toggleClass('hidden-xs');
	});
});

window.onload = function () {
    document.getElementById('button').onclick = function () {
        document.getElementById('success-modal').style.display = "none"
		window.location.replace('admin.php');
    };
};