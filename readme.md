## Deploy Notifier

We’re using the deploy notifier to send deployment notifications to our source for communicating. This package currently supports only HipChat. You’re welcome to create “pull requests” to add more notifiers.

## Usage
Install the package
```bash
composer require afom/deploy-notifier
```
Add the service provider to **config/app.php**
```php
Afom\DeployNotifier\DeployNotifierServiceProvider::class,
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
