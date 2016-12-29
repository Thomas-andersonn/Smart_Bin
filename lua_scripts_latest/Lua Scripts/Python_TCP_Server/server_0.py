##server.py
from socket import *      #import the socket library

HOST = ''    #we are the host
PORT = 8020    #arbitrary port not currently in use
ADDR = (HOST,PORT)    #we need a tuple for the address
BUFSIZE = 4096    #reasonably sized buffer for data

## now we create a new socket object (serv)
serv = socket( AF_INET,SOCK_STREAM)    
 
##bind our socket to the address
i=0
try:
    serv.bind((ADDR))    #the double parens are to create a tuple with one element
    serv.listen(5)    #5 is the maximum number of queued connections we'll allow
    print('listening...')

    conn,addr = serv.accept() #accept the connection
    print('...connected!')

    while i<10:
        data = serv.recv(10)
        print(data)
        i=i+1

except OSError:
    print("OS Error");

except ValueError:
    print("Value Error");

except NameError:
    print("Name Error");

else:
    print("Some Other Error");
serv.close()
    
