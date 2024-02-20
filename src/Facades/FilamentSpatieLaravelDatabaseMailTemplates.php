<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\FilamentSpatieLaravelDatabaseMailTemplates
 */
class FilamentSpatieLaravelDatabaseMailTemplates extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\FilamentSpatieLaravelDatabaseMailTemplates::class;
    }
}
