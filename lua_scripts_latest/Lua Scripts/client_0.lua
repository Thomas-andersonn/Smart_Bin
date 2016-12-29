 conn=net.createConnection(net.TCP, 0)
    conn:on("receive", function(conn, payload) print(payload) end )
    conn:on("connection", function(c)
        conn:send("GET / HTTP/1.1\r\nHost: www.baidu.com\r\n"
            .."Connection: keep-alive\r\nAccept: */*\r\n\r\n") 
        end)
    conn:connect(8090,"2.3.4.5")