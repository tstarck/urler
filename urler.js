/* urler.js
 * Copyright (c) 2011 Tuomas Starck
 */

function populate_list() {
	$("<p/>").text("Ready.").appendTo('#debug');

	$.getJSON('json.php', function (data) {
		$.each(data, function (key, val) {
			for (var item in val) {
				try {}
				catch (e) {}
			}
		});
	});
}

$(document).ready(populate_list);
