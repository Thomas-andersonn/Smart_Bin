--- ***************** connect ***************
function connect()
    wifi.setmode(wifi.STATION)
    SSID = "(~_^)"
    pass = "92000551"
    --modify according your wireless router settings
    wifi.sta.config(SSID,pass)
    wifi.sta.connect()
    if(wifi.sta.getip()==nil) then
    
            tmr.alarm(6,2000,1,function()
            print("connecting ... ") 
            wifi.sta.connect()
            if(wifi.sta.getip()~=nil)  then  
            print(wifi.sta.getip())
            tmr.stop(6)
            end
            end) --first timer
          
    else
            print(wifi.sta.getip())
    end
        
end

connect()

dofile("send_with_timer.lua")
tmr.alarm(3,60000,1,function() 
dofile("send_with_timer.lua")
end)
