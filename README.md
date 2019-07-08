# Osmose Eloquent Filter 

[![Latest Stable Version](https://poser.pugx.org/agog/osmose/v/stable)](https://packagist.org/packages/agog/osmose)
[![Total Downloads](https://poser.pugx.org/agog/osmose/downloads)](https://packagist.org/packages/agog/osmose)
[![License](https://poser.pugx.org/agog/osmose/license)](https://packagist.org/packages/agog/osmose)

An elegant way to filter your eloquent collections 

## Getting Started
To pull osmose in your project, use the command

```
composer require agog/osmose
```

## Defining Osmose Filters
Osmose provides an artisan command `make-filter` that accepts the name of the filter to be generated, which quickly scaffolds a filter class

```
php artisan osmose:make-filter CharacterFilter
```
A <code>CharacterFilter.php</code> file will be created in the `App\Http\Filters` namespace.

***NB: The Filters folder will be automatically created if it does not exist.***

A filter class extends the `Agog\Osmose\Library\OsmoseFilter` template and implements the `Agog\Osmose\Library\Services\Contracts\OsmoseFilterInterface` interface.

It must define a <code>residue</code> method that returns an array defining the filtration rules

```php
<?php

namespace App\Http\Filters;

use Agog\Osmose\Library\OsmoseFilter;
use Agog\Osmose\Library\Services\Contracts\OsmoseFilterInterface;

class CharacterFilter extends OsmoseFilter implements OsmoseFilterInterface
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

## Usage
In order to use the osmose filter, you define rules as an array within the residue method's

Rules are defined as key => value pairs with the key representing the parameter passed as the request and the value represents the rule construct.

Rules are defined based on the type of filter driver intended. Osmose presents three internal filter drivers 

    1. Agog\Osmose\Library\Drivers\DirectFilter
    2. Agog\Osmose\Library\Drivers\CallbackFilter
    3. Agog\Osmose\Library\Drivers\RelationshipFilter

In our business logic, we call Osmose's sieve method on the filter object and pass the eloquent class that we intend to filter
The sieve method will return Eloquent's builder.

`CharacterController.php` <br>
```php
public function index (CharacterFilter $filter)
{
    $characters = $filter->sieve(Character::class)->get();
}
```

----------

Consider the following tables and their related eloquent models

`Character.php` <br>

| id   | name        | gender  |
|------|-------------|---------|
| 1    | Baraka      | male    |
| 2    | Cassie Cage | female  |
| 3    | D'Vorah     | female  |
| 4    | Geras       | male    |
| 5    | Cetrion     | female  |

----------

`Role.php` <br>

| id   | name        |
|------|-------------|
| 1    | hero        |
| 2    | villain     |
| 3    | god         |

----------

`CharacterRole.php` <br>

| id   | character_id   | role_id | 
|------|----------------|---------|
| 1    | 1              | 2       |
| 2    | 2              | 1       |
| 3    | 3              | 2       |
| 4    | 4              | 2       |
| 5    | 4              | 3       |
| 6    | 5              | 3       |

----------

### DirectFilter

To use the DirectFilter driver, we define the rule, prefixed with the word 'column'

```php
public function residue ()
{
    return [
        'character_id' => 'column:id'
    ]
}
```

Osmose will then look for the key 'character_id' within the request object and only return the result whose id matches the value passed

<code>/characters?character_id=1</code> 
Will return the character record with an id of '1'

<hr>

### RelationshipFilter

To use the RelationshipFilter driver, we define the rule, prefixed with the word 'relationship', giving the name of the relationship and the column that should be checked in the related table

```php
public function residue ()
{
    return [
        'role' => 'relationship:roles,name'
    ]
}
```
***NB: It is assumed a roles (belongsToMany) relationship exists in the Character model.***

Osmose will then look for the key 'role' within the request object and only return the result based on the rule definition

<code>/characters?role=god</code> 
Will return all characters with the role of 'god'

<hr>

### CallbackFilter

To use the CallbackFilter driver, we pass a callback that takes in the query builder and the value of the request as arguments. The callback must return the result of the builder

```php
public function residue ()
{
    return [
        'gender' => function ($query, $value) {

            return $query->where('gender', $value);

        }
    ]
}
```

Osmose will then look for the key 'gender' within the request object and only return results based on the callback

<code>/characters?gender=male</code> 
Will return all male characters

<hr>

## Feature Requests

If you have any feature requests, security vulnerabilities or just a good ol' thumbs up, dont hesitate to drop an email at [franciskisiara@gmail.com](mailto:franciskisiara@gmail.com) 

## Inspiration

This project was inspired by laravel's request validation. The name *osmose* comes from the biological word osmosis and how particles are able to *filter* through semi-permeable membranes. :)

## Osmose Authors
### Kisiara Francis
 - [Github](https://github.com/franciskisiara/)
 - [Medium](https://medium.com/@franciskisiara)
 - [LinkedIn](https://www.linkedin.com/in/francis-kisiara-289360ab/)
 
