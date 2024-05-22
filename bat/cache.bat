ipconfig /flushdns

cd %userprofile%\AppData\Local\Google\Chrome\User Data\Default
rem del /s Favicons * /Q
rem del /s History * /Q

del /s Favicons /Q
del /s Favicons-journal /Q
del /s History /Q
del /s History-journal /Q


C:\xampp\htdocs\locurl\bat\restore_last_session.vbs


rem timeout 1 > null
rem start http://localhost/curl/index.html