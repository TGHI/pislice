jQuery(document).ready(function(){
								
  // system messages

  var messages = jQuery('#system-message').find('.alert'),
      messageContainer = jQuery('#system-message-container');
 
  if(messages.length > 0){
    messageContainer.delay(600).slideToggle();
	messages.each(function(i,el){

      var closeButton = jQuery(el).find('.close');
	  closeButton.attr('data-dismiss','');
	  closeButton.on('click',function(e){
         jQuery(el).slideToggle();
		 messages.length -= 1;
		 if(messages.length == 0){
           messageContainer.fadeOut();
		 }
      })
    })
  }  
})