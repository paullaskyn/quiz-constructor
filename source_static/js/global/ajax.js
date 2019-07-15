
function ajaxRequest(url_arg, method_arg, data_arg, success_func){
	$.ajax({
		url: url_arg,
		method: method_arg,
		data: data_arg,
		cache: false
	}).done(function(result){
		var json = JSON.parse(result);
		if (json.error) errorShow(json.error);
		else success_func();
	});
}
