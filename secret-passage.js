jQuery(document).ready(function(){
console.log(settings)

});

	/*
	https://github.com/jeresig/jquery.hotkeys
	*/
	jQuery(document).bind('keydown', settings.hotkey, function(){

	location.href = settings.admin_url;
//	console.log('hi');

	return false;
	});

