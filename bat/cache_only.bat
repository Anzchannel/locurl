rem taskkill /im "chrome.exe" /f
cd ../../../../Users\cre\AppData\Local\Google\Chrome\User Data\Default\Cache\Cache_Data
del f_* /F /Q
del data* /F /Q
del index /F /Q
rem cd ../../../../../../../../../../../../../xampp/htdocs/curl/
rem start chrome.lnk