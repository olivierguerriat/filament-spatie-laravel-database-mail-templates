<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSpatieLaravelDatabaseMailTemplatesServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-spatie-laravel-database-mail-templates';

    public function configurePackage(Package $package): void
    {

        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews(static::$name);
    }

}
