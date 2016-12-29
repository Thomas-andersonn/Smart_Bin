<html>
  <head>
    <script language="javascript" type="text/javascript" src="js/jquery.js"></script>
    <style type="text/css">
      @import url(css/style.css);
    </style>
    <script id="source" language="javascript" type="text/javascript">
    
    
    window.setInterval(function()
   {
        
        $(function () 
        {
          
          var bin_height = 70;
          var fill;
          $.ajax({                                      
            url: './includes/process.php',                  //the script to call to get data          
            data: "",                        //you can insert url argumnets here to pass to api.php
            dataType: 'json',                //data format      
            success: function(data)          //on recieve of reply
            {

              
              var i = 1;
              
              $('#output').empty();
              var rr="";
              out = "<div id='table'><table style='width:450px'><tr><th>Time</th><th>Filled Height</th><th>Battery</th></tr>";
              //$('#output').append(out)
              for(i=1; i<10; i++)
              {
                var time =  data[i][2];              //get id
                var ht = bin_height - data[i][1]+15; 
                if(ht>70) ht = 70;
                var battery = data[i][3];
              // if(battery>2.8)
              //   {
              //     battery = "healthy";
              //   }
              // else
              // {
              //   battery = "low";
              // }          //get name
                if(ht<0)
                  ht = 0;
                fill = bin_height - data[1][1]+15;
                //out = "<b>Time => </b>"+time+"&nbsp;&nbsp;&nbsp;<b> Fill Value =></b>"+ht+ " cm"+"<br>"; 
               bstatus = "";
              if(battery>2.8)
                {
                  bstatus = "healthy";
                }
              else
              {
                bstatus = "low";
              }
                rr = rr + "<tr><td>" + time + "</td><td>" + ht + " cm</td><td>" + battery + " V" + " ("+ bstatus+ ")" + "</td></tr>";

                // $('#output').append(out)
                //Set output element html
                
                
              }
              out = out + rr +  "</table></div>";

              // fill = 10;
              var afill;
              if(bin_height < data[1][1])
                {
                  afill = 0;
                  fill = 0;
                }
              else
              {
                afill = fill*(100/bin_height) ;
              }
              

              $('#output').append(out)  
              $(document).ready(function(){
              $("#box").animate({ 
                      marginTop: "-"+afill*3.9+"",
                      height:""+afill*3.9+"",                      
                      // easing: 'linear'
                      // duration: 4000
                      },1000);}
              );
               // alert(fill);
               // fill = 40;
               // var top_percentage;
               // alert("prev_fill = "+prev_fill+" fill = "+fill);
              // if(prev_fill < fill)
                        // top_percentage =  ""+(fill+60)+"";
              // else
                        // top_percentage =  "-"+(fill-90)+"" ;
              
              // color tweak
              

              

              $(function(){
              $("#percentage").animate({ 
                      top:""+(365-(afill)-(afill/2)-(afill/4))+"",                      
                      },1000);}
              );
              afill = afill.toPrecision(1) ;
            var div = document.getElementById('box');
            div.style.backgroundColor = "rgb("+(afill*10)+","+(255-(afill*2))+",0)";
            
            var percentage_filled = ((fill/bin_height)*100);
            percentage_filled = percentage_filled.toPrecision(4);

            if(fill > bin_height)
              { percentage_filled = 100;
                percentage_filled = percentage_filled.toPrecision(4);
              }            
            $(function(){
            fill = fill -15;

            if(fill <0) fill = 0;
            $("#percentage").html("<center>"+percentage_filled+"%</center>");
            $("#bin_height").html("<center>Bin Height: "+(bin_height)+" cm</center>");
            $("#LeftSpace").html("<center>Left Height: "+(bin_height-fill)+" cm</center>");
            $("#per_occ").html("<center>Filled Volume: "+percentage_filled+" %</center>");
            $("#Space_occ").html("<center>Filled Height: "+fill+" cm</center>");
            // $("#bstatus").html("<center>Battery: " + battery);
            
           	$("#table_label").html("Last 10 min readings for Bin_1<br> <b>MAC: 18-FE-34-D2-DA-52</b>");
            $("#current_label").html("Lastest Data");
            },2000);

            } 
          });
        
        });
    }, 2000);

  $(document).ready(function(){ 
      $("#wrapper").fadeIn(4000);
      $("#footer").fadeIn(4000);
      $("#rowdiv").fadeIn(4000);
      $("#box").fadeIn(4000);
      $("#Header").fadeIn(4000);
      $("#hrr").fadeIn(4000);
      $("#bar").fadeIn(6000);
      $("#bar2").fadeIn(6000);
      $("#map").fadeIn(6000);
  });
  
  </script>

  </head>
  <body>
  <br>
  <b><h1><center id="Header" style="display:none;"> Live Data Panel (Bin_1)</center></h1></b>
  <hr id="hrr" style="display:none">
  <div id="wrapper" style="display:none">
    <div id="row">
      <center><div id="output"></div></center>
      <div id="bin1"> 
      <p id="percentage"></p>
       <center><div id="box" style="display:none;"></div></center> 
      </div>
    </div>
  </div>
  <br>

  <div id="tablediv" >
    <div id="rowdiv" style="display:none">
      <p id="table_label"></p>
      <p id="current_label"></p>
    </div>
  </div>

  <div id="footer" style="display:none"></div>
  <a id="bar" href="c3.html" style="position:fixed; bottom: 75px; z-index:30; left:45%; display:none;">Much Previous Data1</a>
  <a id="bar2" href="bar.php" style="position:fixed; bottom: 100px; z-index:30; left:45%; display:none;">Much Previous Data2</a>
  <a id="map" href="map/map.html" style="position:fixed; bottom: 125px; z-index:30; left:45%; display:none;">Route</a>
  <div id="wrapper" style="position:fixed; bottom: 17px; ">
      <div id="row">
      <p id="bin_height"></p>
      <p id="LeftSpace"></p>
      <p id="per_occ"></p>
      <p id="Space_occ"></p>
      <!-- <p id ="bstatus"></p> -->
  </div>
  </body>
</html>