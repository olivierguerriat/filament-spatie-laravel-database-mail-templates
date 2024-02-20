<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Commands;

use Illuminate\Console\Command;

class FilamentSpatieLaravelDatabaseMailTemplatesCommand extends Command
{
    public $signature = 'filament-spatie-laravel-database-mail-templates';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
