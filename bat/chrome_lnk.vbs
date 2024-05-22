Dim fs
Dim fn

Set fs = WScript.CreateObject("WScript.Shell")
Set fn = fs.CreateShortcut("C:\xampp\htdocs\locurl\files\chrome.lnk")
fn.TargetPath = "C:\Program Files\Google\Chrome\Application\chrome.exe"
fn.Arguments = " --restore-last-session"
fn.HotKey = "Ctrl+Alt+N"
fn.save






rem 

rem Set shell = WScript.CreateObject("WScript.Shell")

rem desktopPath = shell.SpecialFolders("Desktop")
rem fil = desktopPath + "\電卓.lnk"

rem Set shortCut = shell.CreateShortcut(fil)
rem shortCut.TargetPath = "%SystemRoot%\System32\calc.exe"
rem shortCut.Save