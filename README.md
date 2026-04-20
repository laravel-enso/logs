# Logs

[![License](https://poser.pugx.org/laravel-enso/logs/license)](LICENSE)
[![Stable](https://poser.pugx.org/laravel-enso/logs/version)](https://packagist.org/packages/laravel-enso/logs)
[![Downloads](https://poser.pugx.org/laravel-enso/logs/downloads)](https://packagist.org/packages/laravel-enso/logs)
[![PHP](https://img.shields.io/badge/php-8.2%2B-777bb4.svg)](composer.json)
[![Issues](https://img.shields.io/github/issues/laravel-enso/logs.svg)](https://github.com/laravel-enso/logs/issues)
[![Merge Requests](https://img.shields.io/github/issues-pr/laravel-enso/logs.svg)](https://github.com/laravel-enso/logs/pulls)

## Description

Logs provides Enso endpoints for browsing, downloading, showing, and deleting application log files.

The package exposes a compact log-management API over the application's log storage and is meant to back the corresponding Enso administration screen.

It is an operational helper package, not a general-purpose logging driver.

## Installation

Install the package:

```bash
composer require laravel-enso/logs
```

Run the package migrations:

```bash
php artisan migrate
```

## Features

- Log index endpoint.
- Single-log show and download endpoints.
- Log deletion endpoint.
- Simple operational surface under the system namespace.

## Usage

The package mounts its routes under `system.logs.*`.

## API

### HTTP routes

- `GET api/system/logs`
- `DELETE api/system/logs/{log}`
- `GET api/system/logs/{log}/download`
- `GET api/system/logs/{log}`

## Depends On

Required Enso packages:

- [`laravel-enso/core`](https://docs.laravel-enso.com/backend/core.html) [↗](https://github.com/laravel-enso/core)
- [`laravel-enso/helpers`](https://docs.laravel-enso.com/backend/helpers.html) [↗](https://github.com/laravel-enso/helpers)
- [`laravel-enso/migrator`](https://docs.laravel-enso.com/backend/migrator.html) [↗](https://github.com/laravel-enso/migrator)

Companion frontend package:

- [`@enso-ui/logs`](https://docs.laravel-enso.com/frontend/logs.html) [↗](https://github.com/enso-ui/logs)

## Contributions

are welcome. Pull requests are great, but issues are good too.

Thank you to all the people who already contributed to Enso!
