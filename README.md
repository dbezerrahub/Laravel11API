<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Essa é uma versão básica de Laravel API 11 utilizada como base para projetos
FEATURES
. Helpers
. Sanctum: para autenticação de endpoints
. Alguns controllers básicos (User, FrontendAuthentication, Request e Response)
. Interfaces de api (Autenticação e Log)
. Jobs (DeleteExpiredTokens - deleta os tokens do sanctum do banco de dados que já estão vencidos)
. Middlewares: 
    . CheckHttpResponse
    . EndpointAuthorization: permite ou bloqueia endpoints para cada usuário ou frontend
. DAO: modelos básicos para manipulação de dados (ver migrations)
        . FrontendDAO 
        . PersonalAccessTokenDAO 
        . UserDAO
. Modelos
    . CustomLog
    . EndpointAuthorization
    . Frontend
    . PersonalAccessToken
    . User
. Horizon: para enfileiramento de processamento
. Rotas de frontend
