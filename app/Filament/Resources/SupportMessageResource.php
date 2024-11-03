<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportMessageResource\Pages;
use App\Filament\Resources\SupportMessageResource\RelationManagers;
use App\Models\SupportMessage;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\textarea;

class SupportMessageResource extends Resource
{
    protected static ?string $model = SupportMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.support_messages');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.support_messages');
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('user_id')
                ->relationship('user' , 'username')
               ->label(__(key: "general.username")),

                Select::make('ticket.name')
               ->label(__(key: "general.ticket")),
                
                Textarea::make(name: 'content')
                ->required()
                ->maxLength(length: 30)
                 ->label(__("general.content")),        
    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')->label(__('general.username')),   
                TextColumn::make('ticket.subject')->label(__('general.subject')),
                TextColumn::make('content')->limit(30)->label(__('general.content')),
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
            'index' => Pages\ListSupportMessages::route('/'),
            'create' => Pages\CreateSupportMessage::route('/create'),
            'edit' => Pages\EditSupportMessage::route('/{record}/edit'),
        ];
    }
}
