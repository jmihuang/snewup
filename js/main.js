
   function dialog(msg){
      if($('#blackbg').length){
         $('#blackbg').fadeIn();
      }else{
        $('.dialog').css('display','block').wrap('<div id="blackbg" class="blackbg">').addClass('slideInDown');
      }
      $('.dialog').find('p').html(msg);
   }
   
   $(document).on('click','.dialog p,#blackbg',function (event){
      $('#blackbg').fadeOut();
   });



   function loading(evt){
      var percentComplete = Math.ceil(evt.loaded / evt.total)*100;
      if($('#loadingblackbg').length){
         $('#loadingblackbg').fadeIn();
      }else{
        $('.loading').css('display','block').wrap('<div id="loadingblackbg" class="blackbg">');
      }
      if (percentComplete === 100) {
          $('#loading').parent().fadeOut();
      }
   }