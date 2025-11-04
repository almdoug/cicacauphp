@echo off
echo ============================================
echo   CI CACAU - Inicializacao do Sistema
echo ============================================
echo.

echo [1/3] Instalando dependencias...
call composer install --quiet
echo Dependencias instaladas!
echo.

echo [2/3] Configurando banco de dados...
php artisan migrate --force
php artisan db:seed --class=PageContentSeeder --force
echo Banco de dados configurado!
echo.

echo [3/3] Criando usuario administrador...
php artisan admin:create "Admin CICacau" admin@cicacau.uesc.br CICacau25@$
echo.

echo ============================================
echo   Sistema pronto para uso!
echo ============================================
echo.
echo Acesso ao painel:
echo URL: http://localhost:8000/login
echo Email: admin@cicacau.uesc.br
echo Senha: CICacau25@$
echo.
echo Para iniciar o servidor, execute:
echo php artisan serve
echo.
pause
