

  time_start = 0
  time_end = 0
  trig =   4
  echo =   3
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
  ll = 10
 for i = 1, ll, 1 do
        gpio.trig(echo, "up", echo_cb)
        gpio.xwrite(trig, gpio.HIGH)
        tmr.delay(100)
        gpio.write(trig, gpio.LOW)
        tmr.delay(100000)
        mean = mean + (time_end - time_start)/58
  end      
  --print(time_end, " ", time_start)
  print(mean/ll)
  end

tmr.alarm(1, 2000, 0, measure)

 
