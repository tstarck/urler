/* urler.js
 * Copyright (c) 2011 Tuomas Starck
 */

function str_crop(url) {
	var cut = url;
	if (cut.length > 127) {
		cut = url.substring(0, 63) + "..." + url.substring(url.length - 63);
	}
	return cut;
}

function populate_list() {
	$.getJSON('json.php', function (data) {
		$('table').empty();

		$.each(data, function(index, element) {
			var del  = "json.php?seen=" + element.at;
			var row  = $('<tr></tr>');
			var nick = $('<td></td>').attr('class', 'nick').text("<" + element.nick + ">");
			var chan = $('<td></td>').attr('class', 'chan').text(element.chan);
			var seen = $('<td></td>').attr('class', 'del').append(
				$('<a></a>').attr('href', del).text("×")
			);
			var url  = $('<td></td>').attr('class', 'url').append(
				$('<a></a>').attr('href', element.url).text(str_crop(element.url))
			);

			row.append(chan).append(nick).append(seen).append(url).appendTo('table');
		});
	});
}

$(document).ready(function() {
	populate_list();
	$('span').click(function() { populate_list(); });
});
