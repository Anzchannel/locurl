@REM @echo off
@REM :: BatchGotAdmin
@REM :-------------------------------------
@REM REM  --> Check for permissions
@REM     IF "%PROCESSOR_ARCHITECTURE%" EQU "amd64" (
@REM >nul 2>&1 "%SYSTEMROOT%/SysWOW64/cacls.exe" "%SYSTEMROOT%/SysWOW64/config/system"
@REM ) ELSE (
@REM >nul 2>&1 "%SYSTEMROOT%/system32/cacls.exe" "%SYSTEMROOT%/system32/config/system"
@REM )

@REM REM --> If error flag set, we do not have admin.
@REM if '%errorlevel%' NEQ '0' (
@REM     echo Requesting administrative privileges...
@REM     goto UACPrompt
@REM ) else ( goto gotAdmin )

@REM :UACPrompt
@REM     echo Set UAC = CreateObject^("Shell.Application"^) > "%temp%/getadmin.vbs"
@REM     set params= %*
@REM     echo UAC.ShellExecute "cmd.exe", "/c ""%~s0"" %params:"=""%", "", "runas", 1 >> "%temp%/getadmin.vbs"

@REM     "%temp%/getadmin.vbs"
@REM     del "%temp%/getadmin.vbs"
@REM     exit /B

@REM :gotAdmin
@REM     pushd "%CD%"
@REM     CD /D "%~dp0"
@REM :--------------------------------------    


@echo off
@if not "%~0"=="%~dp0.\%~nx0" start /min cmd /c,"%~dp0.\%~nx0" %* & goto :eof
setlocal enabledelayedexpansion
cd /d %~dp0
openfiles > nul
if "%1"=="" (
set arg=
) else (
set arg= -ArgumentList "%1"
)
if errorlevel 1 (
   PowerShell.exe -Command Start-Process \"%~f0\"%arg% -Verb runas
   exit
)

@REM--------------------------------------
ipconfig /flushdns
taskkill /im "chrome.exe"
cd C:/xampp/htdocs/locurl/bat
cache.bat