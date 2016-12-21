## Deploy Notifier

We’re using the deploy notifier to send deployment notifications to our source for communicating. This package currently supports only HipChat. You’re welcome to create “pull requests” to add more notifiers.

[![Build Status](https://travis-ci.org/afriendofmine/deploy-notifier.svg?branch=master)](https://travis-ci.org/afriendofmine/deploy-notifier) [![Latest Stable Version](https://poser.pugx.org/afom/deploy-notifier/v/stable)](https://packagist.org/packages/afom/deploy-notifier) [![Total Downloads](https://poser.pugx.org/afom/deploy-notifier/downloads)](https://packagist.org/packages/afom/deploy-notifier) [![Coverage Status](https://coveralls.io/repos/github/afriendofmine/deploy-notifier/badge.svg?branch=master)](https://coveralls.io/github/afriendofmine/deploy-notifier?branch=master)

## Usage
Add following settings to .env

Available colors: "yellow", "green", "red", "purple", "gray", "random".
```config
DEPLOY_NOTIFIER=hipchat
DEPLOY_NOTIFIER_COLOR=purple
DEPLOY_NOTIFIER_SENDER=Project X
DEPLOY_NOTIFIER_HIPCHAT_ROOM_ID=1111111
DEPLOY_NOTIFIER_HIPCHAT_ROOM_TOKEN=YourRoomToken
```
Install the package
```bash
composer require afom/deploy-notifier
```
Add the service provider to **config/app.php**
```php
Afom\DeployNotifier\DeployNotifierServiceProvider::class,
```
Vendor publish
```php
php artisan vendor:publish
```
Trigger the notification using php artisan
```php
php artisan send:deploy:notification
```
Or doing it manually
```php
$message = new \Afom\DeployNotifier\Message('Project X', 'Project X has been deployed to staging', 'gray');
$notifier = app(DeployNotifierInterface::class);
$notifier->sendNotification($message);
```

## Questions?

For any questions you can reach us at **development@afriendofmine.nl**
