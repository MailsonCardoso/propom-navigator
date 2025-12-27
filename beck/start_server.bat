@echo off
echo ========================================
echo   PREPOM NAVIGATOR - Backend API
echo ========================================
echo.
echo Iniciando servidor Laravel...
echo.
echo Servidor disponivel em: http://localhost:8000
echo API disponivel em: http://localhost:8000/api
echo.
echo Pressione Ctrl+C para parar o servidor
echo ========================================
echo.

cd /d "%~dp0"
php artisan serve --host=0.0.0.0 --port=8000
