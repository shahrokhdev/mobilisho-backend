<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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

                 FileUpload::make('image')->required(),
                 
                 $update ? Select::make('parent_id')
                 ->relationship(name:'child' , titleAttribute:'name')
                 ->preload()
                 ->label(__("general.categoryName")): TextInput::make('parent_id')
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
                  TextColumn::make('created_at')->label(__('general.created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\CreateAction::make()->url(fn (Model $category) => "/admin/categories/create?parent_id={$category->id}")->button()->label(__('general.create-subcategory')),
              /*   Tables\Actions\ViewAction::make()->button()->color('info')->color('info'), */
                Tables\Actions\EditAction::make()->button()->color('warning'),
                Tables\Actions\DeleteAction::make()->button(),
                ActionsViewAction::make()
                ->form([
                    TextEntry::make('categories.child')
                    ->listWithLineBreaks()
                    ->limitList(3)
                    ->expandableLimitedList()
                ]),
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
