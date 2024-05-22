Option Explicit

Const REG_DESKTOP = _
    "HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\Shell Folders\Desktop"

Dim objWshShell
Set objWshShell = WScript.CreateObject("WScript.Shell")

Dim objShortcut
Set objShortcut = objWshShell.CreateShortcut(objWshShell.RegRead(REG_DESKTOP) & _
"\コマンド・プロンプト.lnk") 'コマンド・プロンプト.lnkのショートカットを取得
With objShortcut
    .TargetPath = "C:\Program Files\Google\Chrome\Application\chrome.exe" '起動パスにcmd.exeのパスを指定

End With

Set objShortcut = Nothing
Set objWshShell = Nothing