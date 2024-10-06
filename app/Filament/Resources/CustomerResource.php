<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    
    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.customers');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.customers');
    }

    public static function getNavigationGroup(): string
    {
        return __(key: 'general.product-management');
    }

     public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 5 ? 'primary' : 'warning';
    }public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(length: 30)
                 ->label(__("general.name")),        

                TextInput::make('family')
                ->required()
                ->maxLength(50)
                 ->label(__("general.family")),              

                 FileUpload::make('image')->required()
                     ->label(__("general.image")), 

                 TextInput::make('mobile')
                 ->required()
                 ->maxLength(11)
                 ->tel()
                  ->label(__("general.mobile")),   

                 DatePicker::make('birth_date')
                 ->required()
                  ->label(__("general.birth_date")),   

                  Select::make('gender')
                  ->options([
                      'male' => 'male',
                      'female' => 'female',
                  ])->label(__(key: "general.gender"))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('general.name')),
                TextColumn::make('family')->label(__('general.family')),
                ImageColumn::make('image')->label(__('general.image')),
                TextColumn::make('birth_date')->label(__('general.birth_date')),
                TextColumn::make('mobile')->label(__('general.mobile')),
                TextColumn::make('gender')->label(__('general.gender')),
                TextColumn::make('created_at')->label(__('general.created_at')),
               TextColumn::make('updated_at')->label(__('general.updated_at')),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
