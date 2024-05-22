if exist C:\xampp\htdocs\locurl\files\chrome.lnk (
 timeout 0 > null
 )else (
  C:\xampp\htdocs\locurl\bat\chrome_lnk.vbs
 )
cd C:\xampp\htdocs\locurl\files
xcopy /s /Y hosts C:\Windows\System32\drivers\etc



C:\xampp\htdocs\locurl\files\chrome.lnk

rem C:\xampp\htdocs\curl\chrome.lnk