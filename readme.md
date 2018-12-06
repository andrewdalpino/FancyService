# Fancy Service

### Objective

See *email-question.txt*

### Implementation

As the task was to achieve a *production-ready* implementation of the aforementioned objective, the micro-framework Lumen was chosen because it is widely known and stable solution for rapid prototyping.

The requirements of the FancyService wrapper class are fulfilled through the Product model which extends an Eloquent ORM class. All SQL queries are constructed automatically by the ORM. Validation has been employed to check for a bad UPC code and results in a *ValidationException* if triggered. In addition, a mechanism to only make API calls if the UPC is not found first in the database has been implemented. This addition was largely influenced by the *production-ready* suggestion as it will prevent unneccesary API calls.

To look up a product model by UPC code:
```php
use App\Product;

$product = Product::lookup('1234567890');
```

> See the Eloquent documentation for further ways to interact with the model. Note that properties (fields) are accessable as if they were public via magic getters.

Since Lumen comes with HTTP support out of the box, a simple REST endpoint has been implemented to support HTTP querying:
```
GET http://api.fancyservice.com/products/1234567890
```

```json
{
    id: 1,
    upc: '1234567890',
    name: 'china cymbal',
    description: 'this thing crashes',
    created_at: '2018-06-12 12:00:00',
}
```

The FancyService client which provides a PHP interface to their imaginary network backend is instantiated as a singleton using Lumen's autowiring IOC container and accessed via facade in the Product model. The implementation can be found in FancyServiceProvider. For convenience, the client configuration has been copied into a configuration file. The original configuration has been left in but commented out.

### Database
The database schema is defined in the *migrations* folder and includes a single table for products which defines the fields noted in the problem description. In addition, a *unique* index has been added to the UPC field to speed up  lookups and since UPC codes are unique by definition.

To run the database migrations:
```sh
php artisan migrate
```

### Testing
Unit tests for the Product model can be found in the test folder.

To run the testing suite:
```sh
$ composer test
```

> **Note**: A database is required for testing. Configuration can be given in the .env file (see .env.example).

### Other Considerations
The UPC code is a good candidate for an immutable value object, however was foregone for simplicity sake. Also, no authentication or additional security was implemented as was not part of the requirements.

### About The Framework
Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).
