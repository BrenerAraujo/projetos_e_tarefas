FROM laravelsail/php84-composer:latest

WORKDIR /var/www/html

# Copia os arquivos do Sail necessários
COPY vendor/laravel/sail vendor/laravel/sail/

# Instala as dependências
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs

# Copia o restante do projeto
COPY . .
