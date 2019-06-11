Expressive API Example
===================

A little example of how to build fast, small APIs using Expressive and Doctrine.

## Console Tool
In the ./bin directory there's a console.php script which provides a few commands.
You can also use the Doctrine ORM commands from this console script!

- cache:clear - clears the config cache.

# How To Install
1) You'll want to clone this repo:
```bash
$ git clone git@github.com:nic-d/expressive-api-example.git ~/my_directory
```

2) You'll then need to install composer dependencies, so:
```bash
$ composer install
```

3) You'll also need to create a .env file, and add your db details:
```bash
$ cp .env.dist .env
```

4) Now just run this command to set up the db schema:
```bash
$ php ./bin/console.php orm:schema-tool:update --force
```

5) That's pretty much it.