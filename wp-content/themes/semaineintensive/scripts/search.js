jQuery(document).ready(function ($){
	var search_action = 'autocompletesearch';
	$("#s").autocomplete({
		source: function(req, response){
			$.getJSON(MyAcSearch.url+'?callback=?&action='+search_action, req, response);
		},
		select: function(event, ui) {
			window.location.href=ui.item.link;
		},
		minLength: 3,
	});
});
