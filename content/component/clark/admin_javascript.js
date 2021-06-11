$(document).ready(function () {
	$('.require-modal').click(function () {
		$('#require-modal').modal('show');
	});

	$('#type').change(function () {
		var type = $(this).val();
		if (type == '2') {
			$('#select-pages').show();
			$('#write-code').hide();
		} else {
			$('#select-pages').hide();
			$('#write-code').show();
		}
	});

	$('#element').bind('keyup blur', function () {
		var node = $(this);
		node.val(node.val().replace(/[^a-z]/g, ''));
		var dataString = 'folder=' + node.val();
		if (node.val() != '') {
			$.ajax({
				type: "POST",
				url: "route.php?mod=clark&act=checkexists",
				data: dataString,
				cache: false,
				success: function (data) {
					if (data == '1') {
						$('#alert-exists').show();
					} else {
						$('#alert-exists').hide();
					}
				}
			});
		} else {
			$('#alert-exists').hide();
		}
	});

	$('.tablename').bind('keyup blur', function () {
		var node = $(this);
		node.val(node.val().replace(/[^a-z]/g, ''));
		var dataString = 'table=' + node.val();
		if (node.val() != '') {
			$.ajax({
				type: "POST",
				url: "route.php?mod=clark&act=checktableexists",
				data: dataString,
				cache: false,
				success: function (data) {
					if (data == '1') {
						$('#alert-exists-table').show();
					} else {
						$('#alert-exists-table').hide();
					}
				}
			});
		} else {
			$('#alert-exists-table').hide();
		}
	});

	$(".number").keydown(function (e) {
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) {
			return;
		}
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			e.preventDefault();
		}
	});
});

$(document).ready(function () {
	var regex = /^(.*)(\d)+$/i;

	$(".addfield").on('click', function () {
		var cindex = $('[id=radio]').length / 10;
		var $tr = $(this).closest('tr').prev('tr.tr_clone');
		var $clone = $tr.clone(true, true);
		var cindexf = cindex;
		cindex++;
		$clone.find(':text').val('');
		$clone.find('input[name="ontable[' + cindexf + ']"]').attr('name', 'ontable[' + cindex + ']');
		$clone.find('input[name="onappform[' + cindexf + ']"]').attr('name', 'onappform[' + cindex + ']');
		$clone.find('input[name="onlistdata[' + cindexf + ']"]').attr('name', 'onlistdata[' + cindex + ']');
		$clone.find('input[name="onfile[' + cindexf + ']"]').attr('name', 'onfile[' + cindex + ']');
		$clone.find('input[name="onseotitle[' + cindexf + ']"]').attr('name', 'onseotitle[' + cindex + ']');
		$clone.attr('id', 'fieldid' + (cindex));
		$clone.find("*").each(function () {
			var id = this.id || "";
			var match = id.match(regex) || [];
			if (match.length == 3) {
				this.id = match[1] + cindex;
			}
		});
		$tr.after($clone);
		$('#fieldid' + (cindex) + ' #fieldaction').html('<a href="javascript:void(0)" class="btn btn-danger btn-sm removefield" id="' + (cindex) + '"><i class="fa fa-times"></i></a>');
	});

	$(".tr_clone").on('click', '.removefield', function () {
		var id = $(this).attr('id');
		var idx = 2;
		$('tr#fieldid' + id).remove();
		$(".tr_clone").each(function () {
			$('input[name^="ontable"]', this).attr('name', 'ontable[' + idx + ']');
			$('input[name^="onappform"]', this).attr('name', 'onappform[' + idx + ']');
			$('input[name^="onlistdata"]', this).attr('name', 'onlistdata[' + idx + ']');
			$('input[name^="onfile"]', this).attr('name', 'onfile[' + idx + ']');
			$('input[name^="onseotitle"]', this).attr('name', 'onseotitle[' + idx + ']');
			idx++;
		});
	});
});

$(document).ready(function () {
	var regexjoin = /^(.*)(\d)+$/i;

	$(".addfieldjoin").on('click', function () {
		var cindexjoin = $('[id=radiojoin]').length / 10;
		var $tr = $(this).closest('tr').prev('tr.tr_clone_join');
		var $clone = $tr.clone(true, true);
		var cindexjoinf = cindexjoin;
		cindexjoin++;
		$clone.find(':text').val('');
		$clone.find('input[name="ontablejoin[' + cindexjoinf + ']"]').attr('name', 'ontablejoin[' + cindexjoin + ']');
		$clone.find('input[name="onappformjoin[' + cindexjoinf + ']"]').attr('name', 'onappformjoin[' + cindexjoin + ']');
		$clone.find('input[name="onlistdatajoin[' + cindexjoinf + ']"]').attr('name', 'onlistdatajoin[' + cindexjoin + ']');
		$clone.find('input[name="onfilejoin[' + cindexjoinf + ']"]').attr('name', 'onfilejoin[' + cindexjoin + ']');
		$clone.find('input[name="onseotitlejoin[' + cindexjoinf + ']"]').attr('name', 'onseotitlejoin[' + cindexjoin + ']');
		$clone.attr('id', 'fieldidjoin' + (cindexjoin));
		$clone.find("*").each(function () {
			var id = this.id || "";
			var match = id.match(regexjoin) || [];
			if (match.length == 3) {
				this.id = match[1] + cindexjoin;
			}
		});
		$tr.after($clone);
		$('#fieldidjoin' + (cindexjoin) + ' #fieldactionjoin').html('<a href="javascript:void(0)" class="btn btn-danger btn-sm removefieldjoin" id="' + (cindexjoin) + '"><i class="fa fa-times"></i></a>');
	});

	$(".tr_clone_join").on('click', '.removefieldjoin', function () {
		var id = $(this).attr('id');
		var idx = 2;
		$('tr#fieldidjoin' + id).remove();
		$(".tr_clone_join").each(function () {
			$('input[name^="ontablejoin"]', this).attr('name', 'ontablejoin[' + idx + ']');
			$('input[name^="onappformjoin"]', this).attr('name', 'onappformjoin[' + idx + ']');
			$('input[name^="onlistdatajoin"]', this).attr('name', 'onlistdatajoin[' + idx + ']');
			$('input[name^="onfilejoin"]', this).attr('name', 'onfilejoin[' + idx + ']');
			$('input[name^="onseotitlejoin"]', this).attr('name', 'onseotitlejoin[' + idx + ']');
			idx++;
		});
	});
});

$(document).ready(function () {
	var editor = CodeMirror.fromTextArea(document.getElementById("pocodemirror"), {
		lineNumbers: true,
		mode: "php",
		extraKeys: {
			"Ctrl-J": "toMatchingTag",
			"F11": function (cm) {
				cm.setOption("fullScreen", !cm.getOption("fullScreen"));
				$(".CodeMirror").css({
					"z-index": "101"
				});
			},
			"Esc": function (cm) {
				if (cm.getOption("fullScreen")) {
					cm.setOption("fullScreen", false);
					$(".CodeMirror").css({
						"z-index": "1"
					});
				}
			},
			"Ctrl-Space": "autocomplete"
		},
		gutters: ["CodeMirror-linenumbers", "breakpoints"],
		styleActiveLine: true,
		autoCloseBrackets: true,
		autoCloseTags: true,
		theme: "github"
	});

	editor.on("gutterClick", function (cm, n) {
		var info = cm.lineInfo(n);
		cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
	});

	function makeMarker() {
		var marker = document.createElement("div");
		marker.style.color = "#ff0000";
		marker.innerHTML = "●";
		return marker;
	}
});