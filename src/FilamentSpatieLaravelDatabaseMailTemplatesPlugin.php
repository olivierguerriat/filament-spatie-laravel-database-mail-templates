<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources\MailTemplateResource;

class FilamentSpatieLaravelDatabaseMailTemplatesPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-spatie-laravel-database-mail-templates';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([MailTemplateResource::class]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
