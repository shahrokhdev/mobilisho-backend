<?php

namespace App\Filament\Resources;

use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use App\Filament\Exports\CategoryExporter;
use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use App\Models\Comment;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
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
                 ->label(__("general.image")),     

                 Hidden::make('parent_id')
                  ->default($parent_id)
                ->label(__("general.parentName")),

                Select::make('parent_id')
                ->relationship('parent', 'name')
                ->live()
                ->visible(fn ($livewire, $record) => $livewire instanceof EditRecord)
                ->label(__("general.parentName")),   
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('general.categoryName'))->searchable(isIndividual:true),
                ImageColumn::make('image')->label(__('general.image')),
                TextColumn::make('child.name')->label(__('general.subcategories'))->limit(25)->searchable(isIndividual:true),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                ->options([
                    0 => __('general.main-categories'),
                ])->label(__("general.show_by"))
            ])
            ->actions([
                Tables\Actions\CreateAction::make()->url(fn (Model $category) => "/admin/categories/create?parent_id={$category->id}")->button()->label(__('general.create-subcategory')),
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\EditAction::make()->button()->color('warning'),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(CategoryExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exporter(CategoryExporter::class)
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
       return $infolist
       ->schema([
            TextEntry::make('name')->label(__("general.name")),
            TextEntry::make('child.name')->label(__("general.subcategories"))
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
