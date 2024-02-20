<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Commands\FilamentSpatieLaravelDatabaseMailTemplatesCommand;
use Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Testing\TestsFilamentSpatieLaravelDatabaseMailTemplates;

class FilamentSpatieLaravelDatabaseMailTemplatesServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-spatie-laravel-database-mail-templates';

    public static string $viewNamespace = 'filament-spatie-laravel-database-mail-templates';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('olivierguerriat/filament-spatie-laravel-database-mail-templates');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-spatie-laravel-database-mail-templates/{$file->getFilename()}"),
                ], 'filament-spatie-laravel-database-mail-templates-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentSpatieLaravelDatabaseMailTemplates());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'olivierguerriat/filament-spatie-laravel-database-mail-templates';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-spatie-laravel-database-mail-templates', __DIR__ . '/../resources/dist/components/filament-spatie-laravel-database-mail-templates.js'),
            Css::make('filament-spatie-laravel-database-mail-templates-styles', __DIR__ . '/../resources/dist/filament-spatie-laravel-database-mail-templates.css'),
            Js::make('filament-spatie-laravel-database-mail-templates-scripts', __DIR__ . '/../resources/dist/filament-spatie-laravel-database-mail-templates.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentSpatieLaravelDatabaseMailTemplatesCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_filament-spatie-laravel-database-mail-templates_table',
        ];
    }
}
