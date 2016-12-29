$(function () 
        {
          
          var bin_height = 70;
          var fill;
          $.ajax({                                      
            url: '../includes/process.php',                  //the script to call to get data          
            data: "",                        //you can insert url argumnets here to pass to api.php
            dataType: 'json',                //data format      
            success: function(data)          //on recieve of reply
            {

              
              var i = 1;
              
              $('#output').empty();
              var rr="";
              out = "<div id='table'><table style='width:300px'><tr><th>Time</th><th>Left Space</th></tr>";
              //$('#output').append(out)
              for(i=1; i<10; i++)
              {
                var time =  data[i][2];              //get id
                var ht = bin_height - data[i][1];           //get name
                fill = bin_height - data[1][1];
               
                
              }
                    
            var percentage_filled = ((fill/bin_height)*100);
            percentage_filled = percentage_filled.toPrecision(4);

            if(fill > bin_height)
              { percentage_filled = 100;
                percentage_filled = percentage_filled.toPrecision(4);
              }            
            

            } 
          });
        
        });