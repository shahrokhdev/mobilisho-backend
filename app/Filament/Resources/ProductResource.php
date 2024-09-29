<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.products');
    }

    public static function getNavigationLabel(): string
    {
        return __(key: 'general.products');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([  
                 Select::make('category_id')
                ->relationship(name:'categories' , titleAttribute:'name')
                ->multiple()
                ->preload()
                 ->label(__("general.categoryName")),       

                TextInput::make('title')
                ->required()
                ->maxLength(255)
                 ->label(__("general.title")),       

                 Textarea::make('description')
                ->required()
                ->maxLength(255)
                 ->label(__("general.description")),      
                 
                TextInput::make('price')
                ->required()
                ->maxLength(255)
                 ->label(__("general.price"))
                  ->mask(RawJs::make('$money($input)'))
                 ->stripCharacters(',')
                 ->numeric() ,     
    
                 FileUpload::make('image')
                ->required()
                 ->label(__("general.image")),     

                TextInput::make('inventory')
                ->required()
                ->maxLength(255)
                 ->label(__("general.inventory")),          
                 

                   Grid::make(1)
                    ->schema([
                        Repeater::make('attribute')
                        ->schema([
                            Select::make('attribute_id')
                                ->relationship('attributes', 'name' )
                                ->createOptionForm([
                                     TextInput::make('name')
                                        ->required(),
                                ])
                                ->live()
                                ->reactive()
                                ->preload()
                                ->label(__('general.attribute')),
                    
                            Select::make('value_id')
                            ->options(function (Get $get) {
                                return AttributeValue::query()->where('attribute_id', $get('attribute_id'))->pluck('value', 'id');
                            })
                            ->createOptionForm([
                                TextInput::make('attribute_id')
                                    ->required(),
                                TextInput::make('value')
                                    ->required(),
                            ])          
                            ->hidden(fn (Get $get): bool => ! $get('attribute_id'))
                            
                            ->live()
                            ->preload()
                            ->label(__('general.value')),
                        ])
                        ->columns(2)
                        ->label(__('general.attribute')),
                    ]),      
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('general.name')),
                TextColumn::make('description')->label(__('general.description')),
                TextColumn::make('price')->label(__('general.price')),
                ImageColumn::make('image')->label(__('general.image')),
                TextColumn::make('inventory')->label(__('general.inventory')),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
