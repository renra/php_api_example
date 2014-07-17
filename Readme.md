# PHP API Example

This is a small project for a job evaluation. It has no db support, all is stubbed. It requires PHP cURL to run integration tests. On Debian you can install that by running:

```
apt-get install php5-curl
```

## Seeing output in the browser

```
ln -s /path/to/your/clone/dir /var/www/ #or some other location you use for serving files
```

Then you can navigate your browser to localhost/php_api_example/ and see some output coming from within the micro-app.

## Running tests

PHPUnit is included in the repo for you which means you don't have to install it using pear. Then you can just run:

```
vendor/phpunit/phpunit/phpunit --colors test/unit/resource_test.php
vendor/phpunit/phpunit/phpunit --colors test/integration/destroy_test.php
```

Currently I have integration tests for scripts all.php, show.php, create.php, update.php and destroy.php. These scripts represent endpoints of the API. The do not work from the browser, because they enforce json in the Accept header, but you can interact with them using curl (may the tests quide you).
