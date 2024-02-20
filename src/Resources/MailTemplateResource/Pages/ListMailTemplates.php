<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources\MailTemplateResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources\MailTemplateResource;

class ListMailTemplates extends ListRecords
{
    protected static string $resource = MailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
