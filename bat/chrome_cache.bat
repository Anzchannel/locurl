ipconfig /flushdns
cd C:\Users\cre\AppData\Local\Google\Chrome\User Data\Default
del /s * /Q
taskkill /im "chrome.exe" /f
C:\xampp\htdocs\locurl
start http://localhost/locurl/files/index.html