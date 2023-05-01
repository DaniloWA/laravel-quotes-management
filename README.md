# Laravel Quotes Management

Laravel Quotes Management is a package for Laravel that allows you to fetch quotes from various quote APIs and store the retrieved data in the local database. It provides methods to retrieve quotes from the database based on different criteria, including author and length.

## Installation

To install Laravel Quotes Management, run the following command:

```bash
composer require danilowa/laravel-quotes-management
```

> If the migration does not come automatically, do the steps below

Once you've installed the package, you'll need to publish the quotes migration and run it to create the quotes table in your database. To do this, run the following commands:

```bash
php artisan vendor:publish --tag=quotes-migration
php artisan migrate
```

You can also publish the config file to customize the package's behavior. To do this, run the following command:

```bash
php artisan vendor:publish --tag=quotes-config
```

## Usage

To import quotes from various quote APIs, you can use the importQuotes() method of the Quotes class:

```php
use Danilowa\LaravelQuotesManagement\Quotes;

Quotes::importQuotes();
```

This will import quotes from various quote APIs and insert them into the quotes table in your database.

To retrieve quotes from the database, you can use the following methods:

## getQuotePaginate

This method returns a paginated list of quotes.

```php
use Danilowa\LaravelQuotesManagement\Quotes;

$quotes = Quotes::getQuotePaginate($perPage);
```

<details> 
  <summary>Response</summary>

```json
{
  "status": "success",
  "message": "Operation completed successfully.",
  "content": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "author": "Thomas Edison",
        "author_slug": "thomas-edison",
        "quote": "As a cure for worrying, work is better than whisky.",
        "length": 51,
        "created_at": null,
        "updated_at": null
      },
      {
        "id": 2,
        "author": "Thomas Edison",
        "author_slug": "thomas-edison",
        "quote": "Everything comes to him who hustles while he waits.",
        "length": 51,
        "created_at": null,
        "updated_at": null
      },
      {
        "id": 3,
        "author": "Thomas Edison",
        "author_slug": "thomas-edison",
        "quote": "I never did a day's work in my life.  It was all fun.",
        "length": 53,
        "created_at": null,
        "updated_at": null
      },
      {
        "id": 4,
        "author": "Charles Dickens",
        "author_slug": "charles-dickens",
        "quote": "I do not know the American gentleman, god forgive me for putting two such words together.",
        "length": 89,
        "created_at": null,
        "updated_at": null
      },
      {
        "id": 5,
        "author": "Charles Dickens",
        "author_slug": "charles-dickens",
        "quote": "We need never be ashamed of our tears.",
        "length": 38,
        "created_at": null,
        "updated_at": null
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/getquotes?page=1",
    "from": 1,
    "last_page": 855,
    "last_page_url": "http://127.0.0.1:8000/getquotes?page=855",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=2",
        "label": "2",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=3",
        "label": "3",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=4",
        "label": "4",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=5",
        "label": "5",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=6",
        "label": "6",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=7",
        "label": "7",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=8",
        "label": "8",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=9",
        "label": "9",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=10",
        "label": "10",
        "active": false
      },
      {
        "url": null,
        "label": "...",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=854",
        "label": "854",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=855",
        "label": "855",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/getquotes?page=2",
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "next_page_url": "http://127.0.0.1:8000/getquotes?page=2",
    "path": "http://127.0.0.1:8000/getquotes",
    "per_page": 5,
    "prev_page_url": null,
    "to": 5,
    "total": 4274
  }
}
```

</details>

Where $perPage is the number of quotes per page (default is 5, maximum is 20).

## getRandomQuote

This method returns a random quote from the database.

```php
use Danilowa\LaravelQuotesManagement\Quotes;

$quote = Quotes::getRandomQuote();
```

<details> 
  <summary>Response</summary>

```json
{
  "status": "success",
  "message": "Operation completed successfully.",
  "content": {
    "id": 24,
    "author": "Charles Dickens",
    "author_slug": "charles-dickens",
    "quote": "I do not know the American gentleman, god forgive me for putting two such words together.",
    "length": 89,
    "created_at": null,
    "updated_at": null
  }
}
```

</details>

## getRandomQuoteByAuthor

This method returns a random quote by a specific author.

```php
use Danilowa\LaravelQuotesManagement\Quotes;

$quote = Quotes::getRandomQuoteByAuthor($authorName);
```

Where $authorName is the author name.

<details> 
  <summary>Response</summary>

```json
{
  "status": "success",
  "message": "Operation completed successfully.",
  "content": {
    "id": 4221,
    "author": "Benjamin Franklin",
    "author_slug": "benjamin-franklin",
    "quote": "Well done is better than well said.",
    "length": 35,
    "created_at": null,
    "updated_at": null
  }
}
```

</details>

## getRandomQuoteByLength

This method returns a random quote by a specific length.

```php
use Danilowa\LaravelQuotesManagement\Quotes;

$quote = Quotes::getRandomQuoteByLength($length);
```

Where $length is the length of the quote in characters.

> The `getRandomQuoteByLength` returns a random quote that is approximately the same length as the length specified in the method call. The method searches for quotes with lengths that are within 10 characters of the specified length. For example, if the specified length is 50 characters, the method will search for quotes with lengths between 40 and 60 characters.

<details> 
  <summary>Response</summary>

```json
{
  "status": "success",
  "message": "Operation completed successfully.",
  "content": {
    "id": 4109,
    "author": "Laozi",
    "author_slug": "laozi",
    "quote": "Great acts are made up of small deeds.",
    "length": 38,
    "created_at": null,
    "updated_at": null
  }
}
```

</details>

## Service Provider and Facade

> Provider and Facade are done automatically but if there are any problems follow the steps below

If you want to use the package's service provider and facade, you can add the following lines to the providers and aliases arrays in your config/app.php file:

```php
'providers' => [
    // ...
    Danilowa\LaravelQuotesManagement\QuotesServiceProvider::class,
],

'aliases' => [
    // ...
    'Quotes' => Danilowa\LaravelQuotesManagement\Facades\Quotes::class,
],
```

This will register the package's service provider and alias the Quotes facade to the Danilowa\LaravelQuotesManagement\Facades\Quotes class, allowing you to use the Quotes facade in your application.

## License

Laravel Quotes Management is open-sourced software licensed under the MIT license.
