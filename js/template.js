jQuery(document).ready(function(){
								
  // system messages

  var messages = jQuery('#system-message').find('.alert'),
      messageContainer = jQuery('#system-message-container');
 
  if(messages.length > 0){
    fadeSlide(messageContainer,650,500)
	messages.each(function(i,el){

      var closeButton = jQuery(el).find('.close');
	  closeButton.attr('data-dismiss','');
	  closeButton.on('click',function(e){
         jQuery(el).slideToggle(300);
		 messages.length -= 1;
		 if(messages.length == 0){
           fadeSlide(messageContainer,0,500)
		 }
      })
    })
  }  
})

// custom fx

function fadeSlide(el,delay,duration){
  el.delay(delay).animate({'opacity':'toggle','height':'toggle'}, duration)
}