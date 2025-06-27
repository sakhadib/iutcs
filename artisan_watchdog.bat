@echo off
:loop
echo Starting Laravel Server...
php artisan serve
echo Laravel Server Stopped. Restarting in 3 seconds...
timeout /t 3
goto loop