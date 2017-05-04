# Loggr

---

Provides an interface for storing and retrieving database stored system log messages.

---

## Installation

Just place require new package for your laravel installation via composer.json

    "c4studio/loggr": "1.0.*"

Then simply ```composer update```

### Registering to use it with laravel

Add following lines to ```app/config/app.php```

ServiceProvider array

```php
C4studio\Loggr\LoggrServiceProvider::class,
```

Alias array
```php
'Loggr' => C4studio\Loggr\Facades\Loggr::class,
```

### Publishing migrations (Laravel 5.2 and lower only)

	php artisan vendor:publish --provider="C4studio\Loggr\LoggrServiceProvider" --tag=migrations

### Running migrations

Loggr uses a database table for storage, so you'll need to run the migrations

	php artisan migrate

## Usage

### Add log message using facade

```php
Loggr::add('Message');
```

You can specify the owner using the second parameter which accepts either a User model or a user ID

```php
Loggr::add('Message', Auth::user());
```

You can also add any additional data as a 3rd parameter, which will be stored in a binary type column

```php
Loggr::add('Message', Auth::user(), serialize($myArray));
```

### Add log message using helper function

```php
loggr('Message');
```

As in the case of the facade, you can specify the owner using the second parameter

```php
loggr('Message', Auth::user());
```

### Retrieving log messages

To get all log messages use

```php
Loggr::get();
```

You can also easily get log messages belonging to a user

```php
Loggr::owner(Auth::user());
```

or between two dates

```php
Loggr::interval(\Carbon\Carbon::yesterday(), \Carbon\Carbon::today());
```

If you want to only set starting or end date, just leave off parameter or pass in null

```php
Loggr::interval(\Carbon\Carbon::yesterday());
Loggr::interval(null, \Carbon\Carbon::yesterday());
```

For more complex queries, you can return a Builder object by using query(). Easy, right?

```php
Loggr::query()->orderBy('timestamp', 'desc')->take(2)->get();
```