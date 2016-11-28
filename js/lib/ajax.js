//ajax

   function getJSON(url,data,callback){
      $.ajax({
        xhr: function()
          {
            var xhr = new window.XMLHttpRequest();
            //Download progress
            xhr.upload.addEventListener("progress", function(evt){
                  loading(evt);
            }, false);
            return xhr;
        },
        type: "POST",
        dataType: "json",
        url: './'+url, //Relative or absolute path to ajax-index.php file
        data: data,
        beforeSend: function( xhr ) {
            $('input,button,textarea').prop('disabled', true);
        },
        success: function(rs) {
          callback(rs);
          $('input,button,textarea').prop('disabled', false);
        }
      });
   }

