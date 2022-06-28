## Main problem to solve

Create a CRUD panel for the Nearthest and farthest points.

I used the Pythagorean theorem to find the distance between points in a 2d space. Worked flawlessly!

<img width="1161" alt="Screen Shot 2022-06-27 at 5 39 17 PM" src="https://user-images.githubusercontent.com/5456155/176062614-801f0076-4eb5-44a7-b246-9db6b41f1963.png">

<img width="1165" alt="Screen Shot 2022-06-27 at 5 41 01 PM" src="https://user-images.githubusercontent.com/5456155/176062705-2ca0770a-1763-4039-93a0-b0ddd9d31a86.png">

<img width="1149" alt="Screen Shot 2022-06-27 at 5 41 53 PM" src="https://user-images.githubusercontent.com/5456155/176062791-f7e8968d-40a7-47a3-8eaf-72d6155208b1.png">

### Known issue (performance)

There is a need for improvement because as of now this test is computing all distances for all stored points.

### Possible solution 

Compute all point distances from point (0, 0), store this value in the points table in column "distance" or "d", DB query the nearest and fartest points based on the next formula:

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
