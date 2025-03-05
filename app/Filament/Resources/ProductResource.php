<?php

namespace App\Filament\Resources;

use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\ProductExporter;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\AttributeValue;
use App\Models\Discount;
use App\Models\Product;
use CodeWithDennis\FilamentPriceFilter\Filament\Tables\Filters\PriceFilter;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?int $navigationSort = 2;

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.products');
    }

    public static function getNavigationLabel(): string
    {
        return __(key: 'general.products');
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
        return $form
            ->schema([
                Select::make('category_id')
                    ->relationship(name: 'categories', titleAttribute: 'name')
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
                    ->numeric()
                    ->live()
                    ->afterStateUpdated(function ($state, $component, Get $get, Set $set) {
                        $dis_value = Discount::find($get("discount_id"))->discount_value ?? null;
                        $price_str = str_replace(",", "", $state);
                        $price = intval($price_str);
                        $discount_amount = ($price * $dis_value) / 100;
                        $final_price = $price - $discount_amount;
                        $set('dis_price', $final_price);
                    }),

                Select::make('discount_id')
                    ->options(function (Discount $discount) {
                        return $discount->where('state', 'unexpire')->pluck('discount_value', 'id');
                    })
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function ($state, $component, Get $get, Set $set) {
                        $dis_value = Discount::find($state)->discount_value;
                        $price_str = str_replace(",", "", $get("price"));
                        $price = intval($price_str);
                        $discount_amount = ($price * $dis_value) / 100;
                        $final_price = $price - $discount_amount;
                        $set('dis_price', $final_price);
                    })
                    ->label(__("general.discount_percent")),

                TextInput::make('dis_price')
                    ->readOnly()
                    ->label(__("general.dis_price"))
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->numeric(),

                FileUpload::make('image')
                    ->required()
                    ->label(__("general.image")),

                TextInput::make('inventory')
                    ->required()
                    ->maxLength(255)
                    ->rules('numeric')
                    ->label(__("general.inventory")),
                Grid::make(1)
                    ->schema([
                        Repeater::make('properties')
                            ->afterStateHydrated(function (Component $component, $livewire, $context) {

                                if ($context == "edit") {
                                    $ar = [];
                                    $attrs = $livewire->record->attributes->toArray();

                                    foreach ($attrs as $attr) {
                                        $ar[] = [
                                            'attribute_id' => $attr['pivot']['attribute_id'],
                                            'value_id' => $attr['pivot']['value_id'],
                                            'quantity' => $attr['pivot']['quantity'],
                                            'unit_price' => $attr['pivot']['unit_price']
                                        ];
                                    }
                                    $component->state($ar);
                                }
                            })
                            ->schema([
                                Select::make('attribute_id')
                                    ->relationship('attributes', 'name')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->unique()
                                            ->label(__('general.name')),
                                    ])
                                    ->live()
                                    ->preload()
                                    ->label(__('general.attribute')),

                                Select::make('value_id')
                                    ->options(function (Get $get) {
                                        return AttributeValue::query()
                                            ->where('attribute_id', $get('attribute_id'))
                                            ->pluck('value', 'id');
                                    })
                                    ->createOptionForm(function (Get $get) {
                                        return [
                                            TextInput::make('value')
                                                ->required()
                                                ->label(__('general.value'))
                                        ];
                                    })
                                    ->createOptionUsing(function (array $data, Get $get) {
                                        $data['attribute_id'] = $get('attribute_id');
                                        return AttributeValue::create($data);
                                    })
                                    ->label(__('general.value'))
                                    ->hidden(fn(Get $get): bool => ! $get('attribute_id'))
                                    ->live()
                                    ->preload(),

                                TextInput::make('unit_price')
                                    ->mask(RawJs::make(js: '$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric()
                                    ->hidden(fn(Get $get): bool => ! $get('value_id'))->label(__('general.unit_price')),

                                TextInput::make('quantity')
                                    ->hidden(fn(Get $get): bool => ! $get('value_id'))->label(__('general.quantity'))
                            ])
                            ->columns(4)
                            ->label(__('general.attribute')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('general.name'))->searchable(isIndividual: true),

                TextColumn::make('description')->tooltip(fn(Product $record): string => $record->description)->limit(30)->label(__('general.description'))->searchable(isIndividual: true),

                TextColumn::make('price')->numeric(decimalPlaces: 0)
                    ->label(__('general.price'))->searchable(isIndividual: true),

                TextColumn::make('dis_price')->default(function ($record) {
                    return $record->dis_price ?: '______';
                })->numeric(decimalPlaces: 0)
                    ->label(__('general.dis_price'))->searchable(isIndividual: true),

                ImageColumn::make('image')->label(__('general.image')),

                TextColumn::make('inventory')->label(__('general.inventory'))->searchable(isIndividual: true),

                TextColumn::make('view_count')->label(__('general.view_count'))->searchable(isIndividual: true),

                TextColumn::make('created_at')->label(__('general.created_at'))->searchable(isIndividual: true)->jalaliDate(),
            ])
            ->filters([
                Filter::make('discount')->label(__('general.has_discount'))
                    ->query(fn(Builder $query): Builder => $query->where('dis_price', '!=', null)),

                PriceFilter::make('price')
                    ->min(100)
                    ->max(1000)
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ProductExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exporter(ProductExporter::class)
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
