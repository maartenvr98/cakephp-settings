# Settings plugin for CakePHP

The Settings Plugin allows you to manage your settings (normally used with cake's `Configure`-class) in your database.

- Is easy to use: you can use the `Configure::read()` and `Configure::write()` methods via the [`Setting`-class](#using-the-class).

- Also, you are able to read and write settings by your [console](#using-the-shell).

- Last but not least: If you use the [CakeAdmin Plugin](https://github.com/cakemanager/cakephp-cakeadmin) you get an [automatically generated form](#using-the-settings-form) :).

> Note: The Settings-plugin is prefix-minded. An example: `Prefix.Name`.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org). For existing applications you can add the following to your `composer.json` file:

```javascript
"require": {
	"maartenvr98/cakephp-settings": "dev-master"
}
```

And run `/composer update`.

## Requirements
* CakePHP 4.x
* PHP 8.x


## Configuration

You will need to add the following line to your application's bootstrap.php file:

```php
Plugin::load('Settings', ['bootstrap' => true, 'routes' => true]);

// or run in your shell

$ bin/cake plugin load -b -r Settings
```

Next you need to create the table. Use the following command to initialize the settings-table.

```
$ bin/cake migrations migrate -p Settings
```

## Usage

The `Setting`-class works the same like the `Configure`-class from CakePHP itself.

You can include the class with:

```php
use Settings\Core\Setting;
```

### Write

You can write settings with the following:

```php
Setting::write('App.Name', 'Custom Name');
```

The value `Custom Name` is now written to the database with the key `App.Name`. The empty array can contain multiple options

### Read

Now we gonna read the value from our just created key. Use:

```php
Setting::read('App.Name');
```

This will return our value: `Custom Name`.


### Register

To prevent missing configurations when migrating to another environment the `register` method is introduced.
Use the following to make sure the configuration exists in your application:

```php
Setting::register('App.Name', 'Default Value', []);
```

#### Options
The following options are available:
- `description` - Description of your setting.
- `type` - Type to use like `text`, `select`, and more.
- `options` - Array with available options. In combination with the `type = select` option, this will generate a 
select-box with the given options.
- `editable` - Bool if the setting should be editable.
- `weight` - Weight (order) of the setting.

The options key can handle multiple types. You can define an array with options, but you can also create a close to 
prevent long queries on every request. Example:

```php
Setting::register('App.Index', false, [
    'options' => function() {
        return TableRegistry::get('Blogs')->find('list')->toArray();
    }
]);
```

## Using the setting-forms

If you are using the [CakeAdmin Plugin](https://github.com/cakemanager/cakephp-cakeadmin), we will create a default form where you can edit your settings (if the field `editable` isset to `1`). The Settings-Plugin will automatically add a menu-item to the admin-area.

If you click the menu-item you will see a list with all editable settings who contains the chosen prefix (or default: `App`).

### Register

To add your prefix to the settings-list use the following:

```php
Configure::write('Settings.Prefixes.Test', 'Test');
```

## Credits

This work is based on the [code by CakeManager](https://github.com/cakemanager/cakephp-settings).


