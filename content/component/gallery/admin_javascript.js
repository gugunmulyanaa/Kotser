$(document).ready(function () {
	$('#table-gallery').buildtable('route.php?mod=gallery&act=datatable');
});

$(document).ready(function () {
	$('#table-album').buildtable('route.php?mod=gallery&act=datatable2');
});