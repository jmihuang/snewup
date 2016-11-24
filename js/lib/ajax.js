//ajax

   function getJSON(url,data,callback){
      $.ajax({
        xhr: function()
          {
            var xhr = new window.XMLHttpRequest();
            //Download progress
            xhr.addEventListener("progress", function(evt){
                  loading(evt);
            }, false);
            return xhr;
        },
        type: "POST",
        dataType: "json",
        url: './'+url, //Relative or absolute path to ajax-index.php file
        data: data,
        success: function(data) {
          callback(data);
        }
      });
   }

