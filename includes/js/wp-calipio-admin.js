jQuery(document).ready(function() {
   
   jQuery(document).on('change','select[name="_wp_calipio_screen"], select[name="_wp_calipio_camera"], select[name="_wp_calipio_microphone"]',function(){	
      if(jQuery(this).val() == "allowed"){
         jQuery(this).parent().find('.wp-calipio-pre-select-wrap').show();
      }else{
         jQuery(this).parent().find('.wp-calipio-pre-select-wrap input').prop("checked", false);
         jQuery(this).parent().find('.wp-calipio-pre-select-wrap').hide();
      }
      var screeen = jQuery('select[name="_wp_calipio_screen"]').val();
      var camera = jQuery('select[name="_wp_calipio_camera"]').val();
      var mic = jQuery('select[name="_wp_calipio_microphone"]').val();
      var wasSelected = $(this).attr('data-selected');
      $(this).attr( 'data-selected', $(this).val() );
      if( screeen == "not-allowed" && camera == "not-allowed" && mic == "not-allowed" ){
         $(this).val(wasSelected);
         $(this).attr( 'data-selected', wasSelected );
         if(wasSelected == "allowed"){
            jQuery(this).parent().find('.wp-calipio-pre-select-wrap').show();
         }
         alert(CALIPIO.alert_msg);
      }else{
         $(this).attr( 'data-selected', $(this).val() );
      }
   });

   jQuery('.wp-calipio-help').hover(
         function () {
            jQuery(this).find('div').css('display','block');
         }, 
         function () {
         jQuery(this).find('div').css('display','none');
         }
      );
});