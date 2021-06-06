# Docker PHP-FPM 7.3 & Nginx 1.18 on Alpine Linux
Example PHP-FPM 7.3 & Nginx 1.18 setup for Docker, build on [Alpine Linux](http://www.alpinelinux.org/).
The image is only +/- 35MB large.

Repository: https://websea@bitbucket.org/websea/wd-php7-laravel.git


* Built on the lightweight and secure Alpine Linux distribution
* Very small Docker image size (+/-35MB)
* Uses PHP 7.3 for better performance, lower CPU usage & memory footprint
* Optimized for 100 concurrent users
* Optimized to only use resources when there's traffic (by using PHP-FPM's on-demand PM)
* The servers Nginx, PHP-FPM and supervisord run under a non-privileged user (nobody) to make it more secure
* The logs of all the services are redirected to the output of the Docker container (visible with `docker logs -f <container name>`)
* Follows the KISS principle (Keep It Simple, Stupid) to make it easy to understand and adjust the image to your needs

## Build

    docker build -t iq-php8-laravel

## Usage

Start the Docker container:

    docker run -p 10000:8080 iq-php8-laravel

See the PHP info on http://localhost:10000, or the static html page on http://localhost/test.html

## Configuration
In [config/](config/) you'll find the default configuration files for Nginx, PHP and PHP-FPM.
If you want to extend or customize that you can do so by mounting a configuration file in the correct folder;
