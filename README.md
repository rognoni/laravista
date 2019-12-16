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
