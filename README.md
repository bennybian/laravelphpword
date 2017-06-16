## Laravel PHP Word v1.0

Laravel PHP brings the power of PHPOffice's PHPWord https://github.com/PHPOffice/PHPWord to Laravel 4. It includes features like: 
...

#Installation

Require this package in your `composer.json` and update composer. This will download the package and PHPExcel of PHPOffice.

```php
"maatwebsite/excel": "~1.3.0"
```

After updating composer, add the ServiceProvider to the providers array in `app/config/app.php`

```php
'Maatwebsite\Excel\ExcelServiceProvider',
```

You can use the facade for shorter code. Add this to your aliases:

```php
'Excel' => 'Maatwebsite\Excel\Facades\Excel',
```

The class is bound to the ioC as `excel`

```php
$excel = App::make('excel');
```

# License

This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
