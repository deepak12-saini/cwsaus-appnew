@echo off
:: Run this as Administrator to add dev.cwsaus.com.au to hosts file
echo Adding dev.cwsaus.com.au to hosts file...
echo 127.0.0.1 dev.cwsaus.com.au >> C:\Windows\System32\drivers\etc\hosts
echo Done. Restart Apache and open http://dev.cwsaus.com.au/
pause
