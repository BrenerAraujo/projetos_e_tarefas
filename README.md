<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TaskManager
Esta é uma aplicação criada para gerenciar Projetos e Tarefas utilizando o framework Laravel. A aplicação permite criar, listar, atualizar e excluir projetos e tarefas, além de implementar uma relação entre eles.

## Tecnologias
<ul>
    <li>Laravel 12</li>
    <li>Laravel Sail</li>
    <li>PHP 8.4</li>
    <li>Docker</li>
    <li>PostgreSQL</li>
</ul>

## Como executar o projeto
Para executar este projeto localmente, é necessário ter o WSL2 configurado na sua máquina, rodando uma distribuição ubuntu com o GIT instalado.

Com isso você deve entrar no terminal WSL e navegar até o diretório home do usuario da distribuição linux que você instalou, geralmente `/home/username`. E dentro desse diretório, por questões de organização, deve-se criar uma pasta com o nome htdocs para armazenar os projetos executados via WSL.

Agora dentro da pasta htdocs vamos clonar este repositório com o comando abaixo:

`git clone https://github.com/BrenerAraujo/projetos_e_tarefas.git`

Será criada uma pasta com o nome do repositório, projetos_e_tarefas, contendo a estrutura base de aplicação Laravel. Porém, ainda é necessário instalar o core do framework e suas dependências. E para isso precisamos subir o ambiente de desenvolvimento docker. Primeiro, entre no diretório clonado:

`cd projetos_e_tarefas`

Depois crie o arquivo .env através do arquivo .env.example

`cp .env.example .env`

Agora precisamos criar a imagem do composer para instalar o core do framework

`docker-compose build composer`

Vamos então subir o container:

`docker-compose up -d composer`

Agora para instalarmos o core da aplicação, precisamos rodar:

`docker-compose run --rm composer install`

Agora podemos criar e subir os outros containers do Laravel e do Postgre

`./vendor/bin/sail up -d`

Após isso podemos instalar os pacotes node

`./vendor/bin/sail npm install`

Gerar a chave do Laravel

`./vendor/bin/sail artisan key:generate`

Por fim, criar nossas tabelas no banco

`./vendor/bin/sail artisan migrate`

Agora precisamos construir o frontend da nossa aplicação. Para isso basta rodar o comando:

`./vendor/bin/sail npm run build`

Agora basta acessarmos no navegador o endereço `localhost` e conseguiremos acessar nossa aplicação.
