jQuery(document).ajaxSend(function (){
    console.log('ajaxSend');
    jQuery('.loading>img').removeClass('hidden');
});
jQuery(document).ajaxComplete(function (){
    jQuery('.loading>img').addClass('hidden');
    console.log('ajaxComplete');
});

