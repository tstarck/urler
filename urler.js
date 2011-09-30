/* urler.js
 * Copyright (c) 2011 Tuomas Starck
 */

function str_crop(url) {
	var cut = url;
	if (cut.length > 100) {
		cut = url.substring(0, 42) + "..." + url.substring(url.length - 42);
	}
	return cut;
}

function populate_list() {
	$.getJSON('json.php', function (data) {
		$.each(data, function (key, val) {
			for (var item in val) {
				var url = "json.php?del=" + val[item];
				var del = $('<a></a>').attr({'class' : "del", 'href' : url}).text("×");
				var link = $('<a></a>').attr('href', item).text(str_crop(item));
				var paragraph = $('<p></p>');
				paragraph.append(del).append(link).appendTo('body');
			}
		});
	});
}

$(document).ready(populate_list);
