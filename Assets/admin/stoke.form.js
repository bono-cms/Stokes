$(function(){
	if (jQuery().preview) {
        $("[name='file']").preview(function(data){
            $("[data-image='preview']").fadeIn(1000).attr('src', data);
		});
	}
});