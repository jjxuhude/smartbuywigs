jQuery(document).ajaxSend(function (){
    console.log('ajaxSend');
    jQuery('.loading').removeClass('hidden');
});
jQuery(document).ajaxComplete(function (){
    jQuery('.loading').addClass('hidden');
    console.log('ajaxComplete');
});

