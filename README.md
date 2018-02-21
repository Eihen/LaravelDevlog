# LaravelDevlog

A Laravel library to generate migrations to keep a changelog in a database.

The original purpose of this is to keep a readable changelog to the showed to the end user inside a system.

### Installation
##### Composer
`composer require eihen/laravel-devlog`

### Setup
First publish the configuration file to your project using
`php artisan vendor:publish --tag="devlog"`
and change it to meet your needs.

The initial setup can be done with `php artisan devlog:setup`.
This will create the migration for the tables and the model classes for version and change.

If you'd like to do things step-by-step (or skip a step) you can use:
`php artisan devlog:migration`, `php artisan devlog:version` and `php artisn devlog:change`
to generate the migration and models respectively.

### Usage

The usage of the library is around using artisan commands to generate migrations that keep the changelog on the dabase
up to date.

Create new future version (or update it's information):
`php artisan devlog:new-version`

Add new changes to the version changelog:
`php artisan devlog:new-change`

Release the version (create the migration):
`php artisan devlog:release`

All the commands will interactively ask for the information needed.
