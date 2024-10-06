<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.comments');
    }

    public static function getNavigationLabel(): string
    {
        return __(key: 'general.comments');
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
                Textarea::make('comment')
                ->required()
                ->maxLength(500)
                 ->label(__("general.comment")),      
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('user.name')->label(__('general.name')),
                 TextColumn::make('comment')->label(__('general.comment'))->limit(20),
                  SelectColumn::make('status')->label(__('general.status')) ->options([
                    'pending' => __('general.pending'),
                    'approved' => __('general.approved'),
                ]),
               TextColumn::make('created_at')->label(__('general.created_at')),
            ])
            ->filters([
                Filter::make(__('general.approved'))
                ->query(fn (Builder $query): Builder => $query->where('status', 'approved')),
                Filter::make(__('general.pending'))
                ->query(fn (Builder $query): Builder => $query->where('status', 'pending'))
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
            'index' => Pages\ListComments::route('/'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
