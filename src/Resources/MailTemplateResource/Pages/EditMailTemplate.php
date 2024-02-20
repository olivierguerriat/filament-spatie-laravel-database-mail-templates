<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources\MailTemplateResource\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources\MailTemplateResource;
use Illuminate\Support\Facades\Mail;
use Spatie\MailTemplates\Interfaces\MailTemplateInterface;
use Spatie\MailTemplates\Models\MailTemplate;
use Spatie\MailTemplates\TemplateMailable;

class EditMailTemplate extends EditRecord
{
    protected static string $resource = MailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('send_test')
                ->label(__('database-mail-templates::database-mail-templates.action.send_test.label'))
                ->modalDescription(__('database-mail-templates::database-mail-templates.action.send_test.description'))
                ->modalSubmitActionLabel(__('database-mail-templates::database-mail-templates.action.send_test.submit'))
                ->form([
                    TextInput::make('recipient')
                        ->label(__('database-mail-templates::database-mail-templates.field.recipient'))
                        ->required()
                        ->rule('email'),
                    KeyValue::make('variables')
                        ->label(__('database-mail-templates::database-mail-templates.field.variables'))
                        ->addable(false)
                        ->editableKeys(false)
                        ->deletable(false)
                        ->default(function (MailTemplate $record) {
                            $keys = $record->getVariables();
                            return array_combine($keys, $keys);
                        }),
                ])
                ->action(function (MailTemplate $record, array $data) {
                    $mail = new class($record, $data['variables']) extends TemplateMailable {
                        public function __construct(MailTemplateInterface $mt, $v)
                        {
                            $this->mailTemplate = $mt;
                            $this->viewData = $v;
                        }
                    };
                    Mail::to($data['recipient'])->send($mail);
                }),
        ];
    }
}
