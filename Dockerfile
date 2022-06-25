

FROM wyveo/nginx-php-fpm:latest 
WORKDIR /home/www/
COPY . /home/www/
COPY ./nginx.conf /etc/nginx/conf.d/default.conf
