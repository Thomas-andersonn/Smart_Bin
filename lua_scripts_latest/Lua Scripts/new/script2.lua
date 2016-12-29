i=1
--gpio(general purpose register 1 --> pin 3, 2--> pin 4)
pin=3
gpio.mode(pin, gpio.OUTPUT)
while i<5 do
gpio.write(pin, gpio.HIGH)
tmr.delay(1000000)
gpio.write(pin, gpio.LOW)
tmr.delay(1000000)
i = i+1
print(i)
end