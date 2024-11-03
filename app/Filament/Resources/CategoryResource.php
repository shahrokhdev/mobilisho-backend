<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';


    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.categories');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.categories');
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
    }

    public static function form(Form $form): Form
    {
        $parent_id = request('parent_id');
        request('parent_id') == null ? $parent_id = 0 : $parent_id;
        $update = request()->routeIs('filament.admin.resources.categories.edit');

        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255)
                 ->label(__("general.name")),              

                 FileUpload::make('image')
                 ->required()
                 ->label(__("general.image")),     
                 
                 $update ? Select::make('parent_id')
                 ->relationship(name:'child' , titleAttribute:'name')
                 ->preload()
                 ->label(__("general.parentName")): TextInput::make('parent_id')
                 ->type('hidden')
                 ->hiddenLabel()
                  ->default($parent_id),    
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('general.categoryName')),
                ImageColumn::make('image')->label(__('general.image')),
                TextColumn::make('child.name')->label(__('general.subcategories'))->limit(25),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\CreateAction::make()->url(fn (Model $category) => "/admin/categories/create?parent_id={$category->id}")->button()->label(__('general.create-subcategory')),
                Tables\Actions\EditAction::make()->button()->color('warning'),
                Tables\Actions\DeleteAction::make()->button(),
                ActionsViewAction::make()
                ->form([
                    TextInput::make('name')
                     ->label(__("general.name")),

                     FileUpload::make(name: 'image')
                     ->label(__("general.image")),     

                     Select::make('parent_id')
                     ->relationship(name:'child' , titleAttribute:'name')
                    ->label(__("general.parentName"))
                    
                ])->button()->color('info'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
