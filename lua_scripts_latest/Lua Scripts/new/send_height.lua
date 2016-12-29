height = 78
print('httpget.lua started')

conn = nil
conn=net.createConnection(net.TCP, 0) 

-- show the retrieved web page

conn:on("receive", function(conn, payload) 
     print(payload) 
     end) 

-- when connected, request page (send parameters to a script)
conn:on("connection", function(conn, payload) 
     print('\nConnected') 
     conn:send("GET /read.php?ht="..height
      .." HTTP/1.1\r\n" 
      .."Host:2.3.4.5\r\n" 
       .."Connection: close\r\n"
      .."Accept: */*\r\n" 
      .."User-Agent: Mozilla/4.0 (compatible; esp8266 Lua; Windows NT 5.1)\r\n" 
      .."\r\n")
     end) 
-- when disconnected, let it be known
conn:on("disconnection", function(conn, payload) 
      print('\nDisconnected') 
      end)
                                             
conn:connect(80,'2.3.4.5') 