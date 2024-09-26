<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    
    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.contacts');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.contacts');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                ->required()
                ->maxLength(length: 30)
                 ->label(__("general.first_name")),        

                TextInput::make('last_name')
                ->required()
                ->maxLength(50)
                 ->label(__("general.last_name"))
                 ,              
                TextInput::make('email')
                ->required()
                ->maxLength(50)
                 ->label(__("general.email")),    

                TextInput::make('phone_number')
                ->required()
                ->maxLength(50)
                 ->label(__("general.phone_number")),              

                 Textarea::make('message')
                 ->required()
                 ->maxLength(500)
                  ->label(__("general.message")),

                  Select::make('status')
                  ->options([
                      'rejected' => 'rejected',
                      'pending' => 'pending',
                      'answered' => 'answered',
                  ])->label(__(key: "general.status"))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->label(__('general.first_name')),
                TextColumn::make('last_name')->label(__('general.last_name')),
                TextColumn::make('email')->label(__('general.email')),
                TextColumn::make('phone_number')->label(__('general.phone_number')),
                TextColumn::make('message')->label(__('general.message'))->limit(20),
                SelectColumn::make('status')->label(__('general.status')) ->options([
                    'rejected' => __('general.rejected'),
                    'pending' => __('general.pending'),
                    'answered' => __('general.answered'),
                ]),
                TextColumn::make('created_at')->label(__('general.created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
