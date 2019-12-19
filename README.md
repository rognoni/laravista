# Laravel on AlterVista

We start this project using the [PHP Docker official image](https://hub.docker.com/_/php)

If exists stop any running server on port 80, for example `sudo apachectl stop` and If you need space clean all your old docker images with `docker system prune -a`

Build the current project and run it:

```
docker build -t laravista .
docker run -d --rm -p 80:80 -v "$PWD/src":/var/www/html --name running laravista
```

Open this URL http://127.0.0.1/info.php and try to modify the PHP page:

```
<?php
// phpinfo();
echo "UPDATE";
```

Check the result and if ok stop the container `docker stop running`

## Composer

Install Composer into Dockerfile:

```
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

build, run it and go into to check the command version:

```
docker exec -it running bash
composer --version
```

## Laravel 5.6

Install zip/unzip into Dockerfile:

```
RUN apt-get update && apt-get install -y zip unzip
```

build, run it and go into to create a new `L56` project:

```
composer create-project --prefer-dist laravel/laravel L56 "5.6.*"```
```

check the correct Laravel page http://127.0.0.1/L56/

Zip the folder `zip -r L56.zip L56` and upload the archive on AlterVista to see this error in `storage/logs/laravel.log`

```
[2019-12-17 22:15:05] production.ERROR: No application encryption key has been specified. {"exception":"[object] (RuntimeException(code: 0): No application encryption key has been specified. at /membri/laravista/L56/vendor/laravel/framework/src/Illuminate/Encryption/EncryptionServiceProvider.php:42)
```

## PHP configuration (disable_functions = putenv)

Install vim into Dockerfile and disable **putenv** into `config/php.ini`

```
; This directive allows you to disable certain functions for security reasons.
; It receives a comma-delimited list of function names.
; http://php.net/disable-functions
disable_functions = putenv
```

Try http://127.0.0.1/L56/ and you see the same production error:

```
root@1bdf541e7f6a:/var/www/html/L56/storage/logs# cat laravel.log 
[2019-12-17 22:59:58] production.ERROR: No application encryption key has been specified. {"exception":"[object] (RuntimeException(code: 0): No application encryption key has been specified. at /var/www/html/L56/vendor/laravel/framework/src/Illuminate/Encryption/EncryptionServiceProvider.php:42)
```

## Fix env() function

This is the [suggested way](http://forum.en.altervista.org/cms/4844-laravel-altervista-wordpress.html#post14204) to fix
the [env()](https://laravel.com/docs/5.6/helpers#method-env) function:

```
function env($key, $default = null)
{
    $value = getenv($key);

    # Fix env() function on AlterVista
    if ($value === false && isset($_SERVER[$key])) {
        $value = $_SERVER[$key];
    }

    if ($value === false) {
        return value($default);
    }
```

We have to use a new file `app/helpers.php` to create this custom function.

## Apache .htaccess

Enable **mod_rewrite** into Dockerfile:

```
RUN a2enmod rewrite
```

Add `/L56/.htaccess` file:

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /L56
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

and update `/L56/public/.htaccess` with:

```
RewriteBase /L56

# ...

RewriteRule ^(.*)$ public/index.php/$1 [L]
```

Use these routes:

```
Route::get('/L56', function () {
    return view('welcome');
});

Route::get('/L56/test', function () {
    return 'TEST';
});
```

and try the URLs:

 - http://127.0.0.1/L56/
 - http://127.0.0.1/L56/test
