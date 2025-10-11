# Installation

You can install the Livewire Tables package via composer.

```sh
composer require ramonrietdijk/livewire-tables
```

## Tailwind Configuration

::: info
You can skip this step if you are planning to customize the views.
:::

This package does not ship with any assets except views. Therefore, you will have to add the views to your Tailwind configuration.

```css
@source "../../vendor/ramonrietdijk/livewire-tables/resources/**/*.blade.php";
```

## Publishing Views

To make the tables blend into the style of your project, you may wish to make changes to the layout. This can be done by publishing the views and customize them any way you like.

```sh
php artisan vendor:publish --provider="RamonRietdijk\LivewireTables\ServiceProvider" --tag=views
```
