## Main problem to solve

Create a CRUD panel for the Nearthest and farthest points.

I used the Pythagorean theorem to find the distance between points in a 2d space. Worked flawlessly!

### Known issue (performance)

There is a need for improvement because as of now this test is computing all distances for all stored points.

### Possible solution 

Compute all point distances from point (0, 0), store this value in the point table, column "distance" o "d", query (DB) the nearthest and fartest points based on the next formula:

> Sample: A(1, 1): d(1)

> d = √(x2-x1)<sup>2</sup> * (y2-y1)<sup>2</sup>


### SQL

```sql
$nearest = "SELECT name, x, y FROM points WHERE (1 - d) <= 1 ORDER BY d ASC LIMIT 10";
$farthest = "SELECT name, x, y FROM points WHERE (1 - d) >= 1 ORDER BY d DESC LIMIT 10";
```

## Requirements

* PHP v8.X
* Laravel v8.x - Laravel 9.11 was used for this task
* VueJS 3
* NodeJS v18.3.0

## Setup

Touch database file from main folder (app):

```
$ touch database/database.sqlite
```

Migrate tables:

```
$ php artisan migrate
```

## Run the project

```
php artisan serve
```

Go to http://127.0.0.1:8000/
