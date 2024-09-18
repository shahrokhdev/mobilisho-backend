<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use AymanAlhattami\FilamentPageWithSidebar\FilamentPageSidebar;
use AymanAlhattami\FilamentPageWithSidebar\PageNavigationItem;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

     public static function getNavigationLabel(): string
    {
        return __(key: 'users.users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                     TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                     ->label(__("users.name")),

                     TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label(__(key: "users.email")),

                    TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->required()
                    ->label(__(key: "users.password"))
                    ->maxLength(255),

                     TextInput::make('username')
                    ->required()
                    ->label(__(key: "users.username"))
                    ->maxLength(255),

                     TextInput::make('phone_number')
                    ->required()
                    ->unique()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->label(__(key: "users.phone_number"))
                    ->maxLength(11),

                    Select::make('state')
                    ->options([
                        'active' => 'active',
                        'inActive' => 'inActive',
                    ])->label(__(key: "users.state"))
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                     TextColumn::make('name')
                    ->searchable(isIndividual:true)
                    ->sortable()
                    ->label(__("users.name")),

                     TextColumn::make('email')
                    ->searchable(isIndividual:true)
                    ->sortable()
                    ->label(__("users.email")),

                     TextColumn::make('username')
                     ->sortable()
                     ->searchable(isIndividual:true)
                     ->label(__("users.username")),

                     TextColumn::make('phone_number')
                     ->searchable(isIndividual:true)
                     ->label(__("users.phone_number")),

                     TextColumn::make('state')
                    ->searchable(isIndividual:true)
                    ->sortable()
                    ->label(__("users.state")),

                     TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable(isIndividual:true)
                    ->sortable()
                    ->label(__("users.created_at")),
                  

                     TextColumn::make('updated_at')
                    ->dateTime()
                    ->searchable(isIndividual:true)
                    ->sortable()
                    ->label(__("users.updated_at")),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    
}
