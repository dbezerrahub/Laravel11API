<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Essa é uma versão básica de Laravel API 11 utilizada como base para projetos
FEATURES <br>
. Helpers<br>
. Sanctum: para autenticação de endpoints<br>
. Alguns controllers básicos (User, FrontendAuthentication, Request e Response)<br>
. Interfaces de api (Autenticação e Log)<br>
. Jobs (DeleteExpiredTokens - deleta os tokens do sanctum do banco de dados que já estão vencidos)<br>
. Middlewares:<br> 
&nbsp;&nbsp;. CheckHttpResponse<br>
&nbsp;&nbsp;. EndpointAuthorization: permite ou bloqueia endpoints para cada usuário ou frontend<br>
. DAO: modelos básicos para manipulação de dados (ver migrations)<br>
&nbsp;&nbsp;. FrontendDAO<br> 
&nbsp;&nbsp;. PersonalAccessTokenDAO<br> 
&nbsp;&nbsp;. UserDAO<br>
. Modelos<br>
&nbsp;&nbsp;. CustomLog<br>
&nbsp;&nbsp;. EndpointAuthorization<br>
&nbsp;&nbsp;. Frontend<br>
&nbsp;&nbsp;. PersonalAccessToken<br>
&nbsp;&nbsp;. User<br>
. Horizon: para enfileiramento de processamento<br>
. Rotas de frontend<br>
