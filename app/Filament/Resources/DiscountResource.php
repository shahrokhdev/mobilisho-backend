<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiscountResource\Pages;
use App\Filament\Resources\DiscountResource\RelationManagers;
use App\Models\Discount;
use Filament\Actions\Modal\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.discounts');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.discounts');
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
                
                 Select::make('discount_type')
                  ->options([
                      'percent' => 'percent',
                      'price' => 'price',
                  ])->label(__(key: "general.state")),


                  TextInput::make('discount_value')->
                  required()
                  ->label(__('general.discount_value')),
                  
                  Select::make('state')
                  ->options([
                      'unexpire' => __("general.unexpired"),
                      'expired' =>__("general.expired")
                  ])->label(__(key: "general.state")),
                  
                  DatePicker::make('start_date')
                  ->required()
                  ->jalali()
                   ->label(__("general.start_date")),   
                   
                   DatePicker::make('end_date')
                   ->required()
                   ->jalali()
                    ->label(__("general.end_date")),   

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('discount_type')
                 ->searchable(isIndividual:true)
                  ->label(__('general.discount_type')),

                TextColumn::make(name: 'discount_value')
                 ->searchable(isIndividual:true)
                  ->label(__('general.discount_value')),

                  BadgeColumn::make('state')
                  ->getStateUsing(function (Discount $record){
                       return $record->isExpired() ? "unexpire" :"expired"; 
                  })->colors([
                     'success' => "unexpire",
                     'danger' => 'expired',
                  ])->searchable(isIndividual:true)
                  ->label(__('general.status')),  
                  
                TextColumn::make('start_date')
                 ->searchable(isIndividual:true)
                 ->jalaliDate()
                  ->label(__('general.start_date')),

                TextColumn::make('end_date')
                 ->searchable(isIndividual:true)
                 ->jalaliDate()
                  ->label(__('general.end_date')),
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
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }
}
