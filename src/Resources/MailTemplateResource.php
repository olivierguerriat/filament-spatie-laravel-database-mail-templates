<?php

namespace Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontFamily;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guerriat\FilamentSpatieLaravelDatabaseMailTemplates\Resources\MailTemplateResource\Pages;
use Spatie\MailTemplates\Models\MailTemplate;

class MailTemplateResource extends Resource
{
    protected static ?string $model = MailTemplate::class;

    protected static ?string $recordTitleAttribute = 'mailable';

    public static function getModelLabel(): string
    {
        return __('database-mail-templates:database-mail-templates.model.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('database-mail-templates::database-mail-templates.model.plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __(config('database-mail-templates.navigation_section_group'));
    }

    public static function getNavigationSort(): ?int
    {
        return config('database-mail-templates.navigation_sort');
    }

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Split::make([
                Section::make([
                    TextInput::make('subject')
                        ->label(__('database-mail-templates::database-mail-templates.field.subject')),
                    MarkdownEditor::make('text_template')
                        ->label(__('database-mail-templates::database-mail-templates.field.text_template'))
                        ->toolbarButtons([
                            'bulletList',
                            'orderedList',
                            'h2',
                            'h3',
                            'bold',
                            'italic',
                            'undo',
                            'redo',
                        ])
                        ->hint(__('database-mail-templates::database-mail-templates.hint.text_template')),
                    // ->dehydrateStateUsing(fn (string $state): string => strip_tags($state)),
                    RichEditor::make('html_template')
                        ->label(__('database-mail-templates::database-mail-templates.field.html_template'))
                        ->toolbarButtons([
                            'blockquote',
                            'bulletList',
                            'orderedList',
                            'h2',
                            'h3',
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'link',
                            'undo',
                            'redo',
                        ]),
                ])->columnSpan(['md' => 2, 'lg' => 3]),
                Section::make([
                    TextInput::make('mailable')
                        ->label(__('database-mail-templates::database-mail-templates.field.mailable'))
                        ->extraAttributes(['class' => 'font-mono'])
                        ->disabled(),
                    View::make('filament-spatie-laravel-database-mail-templates::fields.variables'),
                ])->columnSpan(1),

                // ]),
            ])
            ->columns(['md' => 3, 'lg' => 4]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mailable')
                    ->label(__('database-mail-templates::database-mail-templates.field.mailable'))
                    ->searchable()
                    ->sortable()
                    ->fontFamily(FontFamily::Mono),
                TextColumn::make('subject')
                    ->label(__('database-mail-templates::database-mail-templates.field.subject'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('database-mail-templates::database-mail-templates.field.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('database-mail-templates::database-mail-templates.field.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailTemplates::route('/'),
            'edit' => Pages\EditMailTemplate::route('/{record}/edit'),
        ];
    }
}
