<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';



    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.articles');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.articles');
    }
    public static function getNavigationGroup(): string
    {
        return __(key: 'general.article-management');
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
                Select::make('category_id')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->label(__("general.categoryName")),

                TextInput::make(name: 'title')
                    ->required()
                    ->maxLength(255)
                    ->label(__("general.title")),

                Textarea::make(name: 'description')
                    ->required()
                    ->maxLength(255)
                    ->label(__("general.description")),

                FileUpload::make('image')
                    ->label(__('general.image'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.name')->label(__('general.categoryName')),
                TextColumn::make('title')->label(__('general.title')),
                TextColumn::make(name: 'description')->label(__('general.description'))->limit(30),
                ImageColumn::make('image')->label(__('general.image')),
                TextColumn::make('view_count')->label(__('general.view_count')),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
