# Laravel on AlterVista 🎅

This project uses [PHP Docker official image](https://hub.docker.com/_/php) for local development.

```
docker build -t laravista .
docker run -d --rm -p 80:80 -v "$PWD/src":/var/www/html --name running laravista
docker exec -it running bash
docker stop running
```

The best way to deploy is uploading the `src/L8x` folder with `zip -r L8x.zip L8x`
- https://laravista.altervista.org/L8x/

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

    RewriteBase /L8x
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

`/L8x/public/.htaccess`

```
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On
    RewriteBase /L8x

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Routes

You have to use the prefix `/L8x`

```
Route::get('/L8x', function () {
    return view('welcome');
});  
```
