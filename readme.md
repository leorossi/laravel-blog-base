# A Laravel simple blog

This is a simple Laravel project that is used as starting point for my intermediate/advanced laravel course.

It's a simple blog platform, where users can create posts and comments. There is an 'admin area' where you can publish/unpublish posts, and create users.

## Disclaimer

The purpose of this project is skip the basic laravel app-building phase and get started with more advanced topics. 

There are many refactors, optimizations and best practices to be implemented, I know ;) but that's intended! Please don't open issues/PR for this kind of stuff, but I am more than open for suggestions.


## Usage

Install as a normal laravel app (I suggest to use [Laradock](https://laradock.io))
Run `npm install` and `composer install` to install all dependencies.
Generate assets with `npm run development` (or `npm run watch`)

Run migrations and seed the database with `php artisan migrate --seed`. This will create 3 basic users for the 3 roles (`superadmin`, `admin` and `editor`): 


## Custom `artisan` commands

### Generate 100 fake posts

```
php artisan posts:generate 100
```

### Generate 10 fake posts

```
php artisan users:generate 10
```





