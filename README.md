# Smarty template engine for Codeigniter 4.

![GitHub](https://img.shields.io/github/license/seunex17/codeigniter4-smarty)
![Hits](https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=seunex17/codeigniter4-smarty)
![Packagist Downloads](https://img.shields.io/packagist/dt/seunex17/codeigniter4-smarty)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/seunex17/codeigniter4-smarty)
![GitHub stars](https://img.shields.io/github/stars/seunex17/codeigniter4-smarty)


Easily implement the Smarty templating engine in your CodeIgniter 4 project.

## Description
Separate the application logic from your presentation layer in CodeIgniter 4 using this clean and semantic pre-built Smarty template.


## Requirements
* Codeigniter 4.x
* Smarty 5.x

## Installation
Installation is best done via Composer, you may use the following command:

```shell
composer require seunex17/codeigniter4-smarty
```

This will simply add the latest release of **ci4-smarty** as a module to your project.



## Example:
By default without any additonal configuration this library will look into Views/templates/default for you template files.

Here is an example of basic usage:

* PHP:
```php
<?php 
namespace App\Controllers;

use Seunex17\Codeigniter4Smarty\Template\Smartie;

class Home extends BaseController
{
   public function index() {
		
      return Smartie::view('test');
  }
}
```

If you view file is in a sub directory e.g Views/dashboard/test.tpl you can load you view file like below example

* PHP:
```php
<?php 
namespace App\Controllers;

use Seunex17\Codeigniter4Smarty\Template\Smartie;

class Home extends BaseController
{
   public function index() {
		
      return Smartie::view('dashboard.test');
  }
}
```

To pass data from the Controller to the View:

* PHP:
```php
<?php 
namespace App\Controllers;

use Seunex17\Codeigniter4Smarty\Template\Smartie;

class Home extends BaseController
{
   public function index() {
	
      return Smartie::view('test', [
         'message' => 'smarty template engine',
         'title' => 'Showing example on how to use smarty'
      ]);
   }
}
```

* View
> app/Views/test.tpl
```html
<!doctype html>
<html lang="en">
   <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{$title}</title>
   </head>
   <body>
	This is a message from controller: {$message}
   </body>
</html>

```

### Using native and custom php function in views
As at smarty v5 usage of native and custom php function as been removed. Should we need to use function in our views we need to register this functions and tell smarty we intended to use this functions.

* Publish the Smartie core config into your app
```shell
php spark smartie:publish
```

You publish fiel should now be located at app/Configs/Smartie.php

* Register you function
```php
public array $modifiers = ['base_url', 'site_url'];
```

* Declare global variables
```php
public array $globalVariables = ['name', 'John Doe'];
```

To learn more about the smarty tag you can check out the smarty official documentation here: https://smarty-php.github.io/smarty/stable/

<br />

## Contributing:
All contributions are extremely appreciated.
