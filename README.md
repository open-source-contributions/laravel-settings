# [RaggiTech] Laravel >= 6.0 - Settings/Info.

#  [![Latest Stable Version](https://poser.pugx.org/raggitech/laravel-settings/v/stable)](https://packagist.org/packages/raggitech/laravel-settings) [![Total Downloads](https://poser.pugx.org/raggitech/laravel-settings/downloads)](https://packagist.org/packages/raggitech/laravel-settings) [![License](https://poser.pugx.org/raggitech/laravel-settings/license)](https://packagist.org/packages/raggitech/laravel-settings)

#### Laravel Settings/Info provides a quick and easy methods.

###### Example:

```php
// Create/Update Setting
$page->setSetting('facebook_url', 'https://www.facebook.com/RaggiTech');

// Retrieve Setting's Value
echo $page->setting('facebbok_url');	// https://www.facebook.com/RaggiTech
```



## Install

Install the latest version using [Composer](https://getcomposer.org/):

```bash
$ composer require raggitech/laravel-settings
```

then publish the migration & config files
```bash
$ php artisan vendor:publish --tag=laravel-settings
$ php artisan migrate
```




## Usage
```php
// An Example : (Page Model)
// Using HasSettings in Page Model
...
use RaggiTech\Laravel\Settings\HasSettings;

class Page extends Model
{
    use hasSettings;
...
```



- [General Settings](#gs)
  - [Create/Update](#gs_cu)
  - [Retrieve Value & All](#gs_get)
  - [Delete & Clear](#gs_dc)
  
- [Model Settings](#m)
  - [Create/Update](#m_cu)
  - [Retrieve Value & All](#m_get)
  - [Delete & Clear](#m_dc)
  - [Relationship](#m_relationship)
  - [Scopes](#m_scopes)



<a name="gs"></a>
## General Settings




<a name="gs_cu"></a>

#### Create / Update Setting's Value

```php
use RaggiTech\Laravel\Settings\Settings;

// Single
Settings::set('website_status', true);

// Multi
Settings::set([
	'website_status' => false,
	'website_off_message' => 'OFFLINE!',
]);
```



<a name="gs_get"></a>

#### Retrieve Value & All

```php
use RaggiTech\Laravel\Settings\Settings;

// Single
$setting = Settings::get('website_keywords'); // raggitech, raggi, ...

// All
$settings = Settings::get(); // => All General Setting
```




<a name="gs_dc"></a>

#### Delete & Clear

```php
use RaggiTech\Laravel\Settings\Settings;

// Delete/Remove
Settings::remove('website_keywords');

// Clear
Settings::clear(); // Clearing the general settings
```









<a name="m"></a>
## Model Settings



<a name="m_cu"></a>

#### Create / Update Setting's Value

```php
// Single
$page->setSetting('status', true);

// Multi
$page->setSettings([
	'website_url'    => 'https://raggitech.com',
	'facebook_url'   => 'https://www.facebook.com/RaggiTech',
	'twitter_url'    => 'https://www.twitter.com/RaggiTech',
	'instagram_url'  => 'https://www.instagram.com/raggitech',
]);
```



<a name="m_get"></a>

#### Retrieve Value & All

```php
// Single
$setting = $page->setting('website_url');

// All
$settings = $page->settings;
```




<a name="gs_dc"></a>

#### Delete & Clear

```php
// Delete/Remove
$page->removeSetting('instagram_url');

// Clear
$page->clearSettings();// Clearing page's settings
```





<a name="scopes"></a>

#### Scopes 
```php
// Get every element has no Settings.
$p1 = Page::withoutSettings()->get();

// Get every element has setting (status).
$p2 = Page::withSettings('status')->get();

// Get every element has setting (status == true).
$p3 = Page::withSettingsValue('status', true)->get();

// Get every element has [facebook or twitter or all] settings.
$p4 = Page::withAnySettings(['facebook', 'twitter'])->get();
```




## License

[MIT license](LICENSE.md)