# Laravel on AlterVista 🎅

This project uses [PHP Docker official image](https://hub.docker.com/_/php) for local development.

```
docker build -t laravista .
docker run -d --rm -p 80:80 -v "$PWD/src":/var/www/html --name running laravista
docker exec -it running bash
docker stop running
```

The best way to deploy is uploading the `src/L12x` folder with `zip -r L12x.zip L12x`
- https://laravista.altervista.org/L12x/

and to migrate the database you have to run the SQL manually, because we have not the SSH terminal on AlterVista:

```
CREATE TABLE `l12x_sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `l12x_sessions_user_id_index` (`user_id`),
  KEY `l12x_sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## Configuration

You have to configure your `.env`

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=my_laravista
DB_USERNAME=laravista
DB_PASSWORD=

FORCE_HTTPS=true
```

and two `.htaccess` files:

`/L8x/.htaccess`

```
<IfModule mod_rewrite.c>
    RewriteEngine On

    RewriteCond %{HTTP:X-Forwarded-Proto} !=https
    RewriteCond %{HTTPS} =off
    RewriteRule ^ https://laravista.altervista.org%{REQUEST_URI} [L,R=301]

    RewriteBase /L12x
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## Routes

You have to use the prefix `/L12x`

```
Route::get('/L12x', function () {
    return view('welcome');
});  
```

## Database (MySQL)

```
'prefix' => 'l12x_',
```
