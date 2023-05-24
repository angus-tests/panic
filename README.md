# Panic

## Overview
Panic is a website for showing distress calls from the ESP32 IOT project

## Run Locally

Clone the project

```bash
git clone git@github.com:angus-tests/panic.git
```

Go to the project directory

```bash
cd panic
```

Setup Laravel Sail

**_NOTE:_**  Ensure you have Docker installed

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Generate a .env file

```bash
cp .env.example .env
```
Run Laravel Sail (Development server)

```bash
./vendor/bin/sail up
```

**Open a new Terminal tab in the same project root folder**

Generate an app encryption key

```bash
./vendor/bin/sail php artisan key:generate
```

Migrate the database

```bash
./vendor/bin/sail php artisan migrate
```

Run Vite

```bash
./vendor/bin/sail npm run dev
```

Visit [Localhost](http://localhost/)


## Tips

When updating certain fields in the `.env` file when using Laravel Sail, you may need to restart the Docker container for changes to take affect.

## Demo

A live version is available [here](http://panic.angusgoody.com/)

## Authors

- [@angusgoody](https://github.com/angusgoody)

