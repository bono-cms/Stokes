$(function(){
	
	$("[name='stoke[date]']").datepicker();
	$.wysiwyg.init(['stoke[full]', 'stoke[introduction]']);

	if (jQuery().preview) {
		$("[name='file']").preview(function(data){
			$("[data-image='preview']").fadeIn(1000).attr('src', data);
		});
	}
	
});