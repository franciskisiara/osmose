# Osmose Eloquent Filter

An elegant way to filter data sets from eloquent models for simplistic presentation

## Getting Started
Osmose can be pulled in using composer by running the command

```
composer require agog/osmose
```

## Usage
Once installed, osmose can be used to generate a FormFilter by running the command

```
php artisan osmose:make-filter
```
This will generate commands within the `App\Http\Filters` namespace.

***NB: The Filters fold will be automatically created if it does not exist.***

A FormFilter is simply a class extending the `Kisiara\Osmose\Library\FormFilter` template and implementing
the `Kisiara\Osmose\Library\FilterInterface` interface.

The FormFilter object must define a method called residue that returns an array representing the sifts that are to be 
filtered

```php

<?php

namespace App\Http\Filters;

use Agog\Osmose\Library\FormFilter;
use Agog\Osmose\Library\FilterInterface;

class DummyFilter extends FormFilter implements FilterInterface
{
    /**
     * defines the form elements that are to be sieved
     * @return array
     */
    public function residue()
    {
        return [

        ];
    }
}

```

The array defines, `key => value` pairs that will be filtered once a request is sent to a controller.

### Dependency injection

A FormFilter is injected within a controller's method as a dependency.
The object has a `sieve()` method that accepts an Eloquent model as a parameter and returns a query builder. 
An example is outline below

```php
<?php

namespace App\Http\Controllers;

use App\Dummy;
use App\Http\DummyFilter;

class DummyController extends Controller
{
    public function index(DummyFilter $filter)
    {
        $builder = $filter->sieve(Dummy::class);

        return $builder->get();
    }
}

```

### The residue() method

The residue method returns an array whose value determine the filtered results

Consider the data sets;

`Comic.php`
| id   | name    |
| -----| --------|
| 1    | DC      |
| 2    | Marvel  | 

`Hero.php`
| name           | comic_id    |
| ---------------| ------------|
| Avengers       | 2           |
| Justice League | 1           |
| Teen Titans    | 1           |
| X Force        | 2           |



## Built With

* [Laravel](https://laravel.com/docs/5.6/packages/) - The framework used
* [Coffee](https://www.google.com/search?q=cofee) - The stimulus used
* [Kisiara](https://github.com/franciskisiara/) - The labourer used

## License

This project is licensed under the DBAD License - see [DBAD Public License](https://dbad-license.org/)

## Acknowledgments

* Hat tip to bosses and peers
* Inspired by laziness
