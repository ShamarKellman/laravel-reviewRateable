[![Latest Stable Version](https://poser.pugx.org/shamarkellman/reviewrateable/v/stable)](https://packagist.org/packages/shamarkellman/reviewrateable)
[![Total Downloads](https://poser.pugx.org/shamarkellman/reviewrateable/downloads)](https://packagist.org/packages/shamarkellman/reviewrateable)
[![Latest Unstable Version](https://poser.pugx.org/shamarkellman/reviewrateable/v/unstable)](https://packagist.org/packages/shamarkellman/reviewrateable) [![License](https://poser.pugx.org/shamarkellman/reviewrateable/license)](https://packagist.org/packages/shamarkellman/reviewrateable)

# Laravel ReviewRateable
ReviewRateable system for laravel 5

## Installation

First, pull in the package through Composer.

```bash
composer require shamarkellman/reviewrateable
```

And then include the service provider within `app/config/app.php`.

```php
'providers' => [
    ShamarKellman\ReviewRateable\ReviewRateableServiceProvider::class
];
```

At last you need to publish and run the migration.
```php
php artisan vendor:publish --provider="ShamarKellman\ReviewRateable\ReviewRateableServiceProvider" && php artisan migrate
```

-----

### Setup a Model
```php
<?php

namespace App;

use ShamarKellman\ReviewRateable\Contracts\ReviewRateable;
use ShamarKellman\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements ReviewRateable
{
    use ReviewRateableTrait;
}
```

### Create a rating
```php
$user = User::first();
$post = Post::first();

$rating = $post->rating([
    'title' => 'Some title',
    'body' => 'Some body',
    'rating' => 5,
], $user);

dd($rating);
```

### Update a rating
```php
$rating = $post->updateRating(1, [
    'title' => 'new title',
    'body' => 'new body',
    'rating' => 3,
]);
```

### Delete a rating:
```php
$post->deleteRating(1);
```

### Fetch the average rating:
````php
$post->averageRating()
````

or

````php
$post->averageRating(2) //round to 2 decimal place
````

### Count total rating:
````php
$post->countRating()
````

### Fetch the rating percentage.
This is also how you enforce a maximum rating value.
````php
$post->ratingPercent()

$post->ratingPercent(10)); // Ten star rating system
// Note: The value passed in is treated as the maximum allowed value.
// This defaults to 5 so it can be called without passing a value as well.
````
