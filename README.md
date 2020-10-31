# Skill test Junior developer

This is a simple PHP oop application created for the test purpose;

## Starting an application using this framework

1. Run **composer update** to install the project dependencies.
1. Open [Config/Config.php](Config/Config.php) and enter your database configuration data.
1. Create a database and import property.sql
1. Run "php -S localhost:8000 -t public/" to start the server
1. Please refresh the page 2 times times if property are not showing

   See below for more details.

## Configuration

Configuration settings are stored in the [Config/Config.php](Config/Config.php) class. Default settings include database connection data and a setting to show or hide error detail.

## Routing

Routing occurs at the main index file using a switch statement which redirects routes to their controllers.

# SRC Folder

Src folder or App folder containes all the mvc logic , Models , Views and Controllers reside in there.

## Controllers

Controllers respond to user actions (clicking on a link, submitting a form etc.). Controllers are classes that is in [Src\Controller](Src/Controller) class which uses php logic to handle user requests or to display views.

## Views

Views are used to display information . View files go in the `Src/Views` folder. You can render a standard PHP view in a controller, optionally passing in variables, like this:

```php
 View::render("view file name", "additional data", "success message", "error message");
```

## Models

Models are used to get and store data in your application. All the logic for database management are stored here

## Database

You can get the PDO database connection instance like this:

```php
$db = static::getDB();
```

## Helpers

Helper class contain methods for helping users to validate or sanitize data.

## Actions

All the Api get file logic is stored here eg: getting data from api

## Web server configuration

Pretty URLs are enabled using web server rewrite rules. An [.htaccess](public/.htaccess) file is included in the `public` folder. Equivalent nginx configuration is in the [nginx-configuration.txt](nginx-configuration.txt) file.

---

## More to do if i have time:

    1. Get more designing done
    1. Implement more auto update task
