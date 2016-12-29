--- ***************** Height function ***************


  time_start = 0
  time_end = 0
  trig =   1
  echo =   2
  gpio.mode(trig, gpio.OUTPUT)
  gpio.mode(echo, gpio.INT)
  

  function echo_cb(level)
    if level == 1 then
      time_start = tmr.now()
      gpio.trig(echo, "down")
    else
      time_end = tmr.now()
    end
  end

 
  function measure()
  mean = 0
  ll = 5
 for i = 1, ll, 1 do
        gpio.trig(echo, "up", echo_cb)
        gpio.write(trig, gpio.HIGH)
        tmr.delay(100)
        gpio.write(trig, gpio.LOW)
        tmr.delay(100000)
        mean = mean + (time_end - time_start)/58
  end      
      --print(time_end, " ", time_start)
    --print(mean/ll)
  return (mean/ll)
  

    --tmr.alarm(1, 2000, 1, measure)
end

function bstats()
  voltage = (node.readvdd33())
  return voltage
end


--tmr.alarm(0,1000, 0, connect)

--- ***************** Send Data Function ***************
run_count_ihour = 1;
run_count = 0;
id = 1;
function sd()
        bstat = bstats()
        height = measure() 

        if(height<0 and height >150) then
            return 0
        else
            
            --print('httpget.lua started')

            conn = nil
            conn=net.createConnection(net.TCP, 0) 

            -- show the retrieved web page

            conn:on("receive", function(conn, payload) 
               --  print(payload) 
                 if(payload~=nil) then
                    print(height, " Send!")
                    run_count = run_count +1;
                    if(run_count_ihour==run_count) then
                        print("run count = ",run_count)
                        tmr.stop(2)
                    end
                 else
                    print(height, " Not Send :(")
                 end
                 end) 

            -- when connected, request page (send parameters to a script)
    conn:on("connection", function(conn, payload) 
    -- print('\nConnected') 
     conn:send("GET /iot/includes/read.php?ht="..height
      .."&&id="..id
      .."&&bs="..bstat
      .." HTTP/1.1\r\n" 
      .."Host:2.3.4.5\r\n" 
       .."Connection: close\r\n"
      .."Accept: */*\r\n" 
      .."User-Agent: Mozilla/4.0 (compatible; esp8266 Lua; Windows NT 5.1)\r\n" 
      .."\r\n")
     end) 
            -- when disconnected, let it be known
            conn:on("disconnection", function(conn, payload) 
                  --print('\nDisconnected') 
                  end)
                                                         
            conn:connect(80,'2.3.4.5') 
        end
        
        
end
-- **************** Call function *******************


tmr.alarm(2,4000,1,sd)


