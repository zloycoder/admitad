jQuery(document).ready(function($) {
  
  $(".agents-list-item").click(function(){
    $(this).parent().find(".agents-list-item").removeClass("active");
    $(this).addClass("active");
    var data = {'id' : $(this).attr("data-id"), 'action': 'agents'};
		$.ajax({
			url : agents_params.ajaxurl,
			data : data,
			type:'POST',
			success:function(data){
				$('.content-area').html(data);
			}
		});
		return false;
	});
  

});