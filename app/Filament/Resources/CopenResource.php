<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CopenResource\Pages;
use App\Filament\Resources\CopenResource\RelationManagers;
use App\Models\Copen;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CopenResource extends Resource
{
    protected static ?string $model = Copen::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                ->relationship('customers' , 'name')
                ->multiple()
                ->hint(Action::make("select All"))
                ->preload()
                ->label(__('general.customer')),
                  
                TextInput::make('code')
                ->required()
                ->maxLength(8)
                ->label(__('general.code')),
                
                 Select::make('state')
                  ->options([
                      'unexpire' => 'unexpire',
                      'expired' => 'expired',
                  ])->label(__(key: "general.state")),

                 Select::make('discount_type')
                  ->options([
                      'percentage' => 'percentage',
                      'fixed_amount' => 'fixed_amount',
                      'free_shipping' => 'free_shipping',
                      'buy_one_get_one' => 'buy_one_get_one',                   
                  ])->label(__(key: "general.discount_type")),


                  TextInput::make('discount_value')
                  ->required()
                  ->maxLength(8)
                  ->label(__('general.discount_value')),
                      
                  TextInput::make('usage_limit')
                  ->required()
                  ->label(__('general.usage_limit')),
                      
                 DatePicker::make('start_date')
                 ->jalali()
                 ->label(__('general.start_date')),

                 DatePicker::make('end_date')
                 ->jalali()
                 ->label(__('general.end_date')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                  ->searchable(isIndividual:true)
                  ->label(__('general.Full Name')),

                  TextColumn::make('code')
                   ->searchable(isIndividual:true)
                    ->label(__('general.code')),

                  TextColumn::make('state')
                   ->searchable(isIndividual:true)
                    ->label(__('general.state')),

                  TextColumn::make('discount_type')
                   ->searchable(isIndividual:true)
                    ->label(__('general.discount_type')),

                  TextColumn::make('discount_value')
                   ->searchable(isIndividual:true)
                    ->label(__('general.discount_value')),

                  TextColumn::make('start_date')
                   ->searchable(isIndividual:true)
                   ->jalaliDate()
                    ->label(__('general.start_date')),

                  TextColumn::make('end_date')
                   ->searchable(isIndividual:true)
                   ->jalaliDate()
                    ->label(__('general.end_date')),

                  TextColumn::make('usage_limit')
                   ->searchable(isIndividual:true)
                    ->label(__('general.usage_limit')),
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
            'index' => Pages\ListCopens::route('/'),
            'create' => Pages\CreateCopen::route('/create'),
            'edit' => Pages\EditCopen::route('/{record}/edit'),
        ];
    }
}
