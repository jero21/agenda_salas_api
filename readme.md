<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Requisitos

- PHP 7 
- Composer >= 2.2.13 

## Configurar Variales de entorno de BD en archivo .env

```
DB_CONNECTION=
DB_HOST=127.0.0.1
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Configuración del proyecto
```
$ composer install
$ php artisan key:generate
$ php artisan jwt:secret
```

## Carpeta de proyecto debe estar en servidor apache

Los servicios del frontend debe apuntar a la ruta: http://IP_SERVIDOR/apis/NOMBRE_CARPETA_BACKEND/public/api/
Ejemplo: http://172.17.24.10/apis/agenda_salas_temuco_backend/public/api/