<div align="center">
  <img src="https://i.imgur.com/91OBGN1.jpeg" width="348">
  <h1>CATS</h1>
</div>
<div>
  <h2>Sistema teste de seleção para o Piaget</h2>
  <p>API WEB que realizará queries em The Cat Api: <a href='https://docs.thecatapi.com' target='_blank'>https://docs.thecatapi.com</a></p>
  <h2>Features</h2>
  <ul>
    <li>Login</li>
    <li>Realiza busca de raças por nome;</li>
    <li>Guardar os resultados encontrados no banco de dados.</li>
  </ul>
  <h2>Passo a passo:</h2>
  <ul>
    <li>Renomear o arquivo /projects/the-cat/.env.example para .env (já está configurado)</li>
    <li>docker compose up -d</li>
    <li>docker exec -it pg-php bash</li>
    <li>cd the-cat <i>(para entrar no diretório do projeto)</i></li>
    <li>composer install</li>
    <li>php artisan migrate</li>
  </ul>
</div>