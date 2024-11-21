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

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';


    
    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.contacts');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.contacts');
    }
    public static function getNavigationGroup(): string
    {
        return __(key: 'general.system-management');
    }

     public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 5 ? 'primary' : 'warning';
    }

    public static function canCreate(): bool
    {
        return false; 
    }
    
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                ->required()
                ->maxLength(length: 70)
                 ->label(__("general.full_name")),       
                      
                TextInput::make('title')
                ->required()
                ->maxLength(100)
                 ->label(__("general.title")),    

                TextInput::make('phone_number')
                ->required()
                ->maxLength(50)
                 ->label(__("general.phone_number")),              

                 Textarea::make('message')
                 ->required()
                 ->maxLength(500)
                  ->label(__("general.message")),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->label(__('general.full_name'))->searchable(isIndividual:true),
                TextColumn::make('title')->label(__('general.title'))->searchable(isIndividual:true),
                TextColumn::make('phone_number')->label(__('general.phone_number'))->searchable(isIndividual:true),
                TextColumn::make('message')->label(__('general.message'))->limit(20)->searchable(isIndividual:true),
                TextColumn::make('created_at')->label(__('general.created_at'))->jalaliDate()->searchable(isIndividual:true),
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
