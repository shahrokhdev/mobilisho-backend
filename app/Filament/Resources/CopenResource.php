<?php

namespace App\Filament\Resources;

use App\Filament\Exports\CopenExporter;
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
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CopenResource extends Resource
{
    protected static ?string $model = Copen::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';
    protected static ?int $navigationSort = 4;

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.copens');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.copens');
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
                Select::make('customer_id')
                ->relationship('customers' , 'name')
                ->multiple()
                ->preload()
                ->label(__('general.customer')),
                  
                TextInput::make('code')
                ->required()
                ->maxLength(8)
                ->label(__('general.code')),
                
                 Select::make('state')
                  ->options([
                      'unexpire' => __("general.unexpired"),
                      'expired' =>__("general.expired")
                  ])->label(__(key: "general.state")),

                 Select::make('discount_type')
                  ->options([
                      'percentage' => __("general.percentage"),
                      'fixed_amount' => __("general.fixed_amount"),
                      'free_shipping' => __("general.free_shipping"),
                      'buy_one_get_one' => __("general.buy_one_get_one"),                   
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
               /*  TextColumn::make('customer.name')
                  ->searchable(isIndividual:true)
                  ->label(__('general.full_name')), */

                  TextColumn::make('code')
                   ->searchable(isIndividual:true)
                    ->label(__('general.code')),

                    BadgeColumn::make('state')
                    ->getStateUsing(function (Copen $record){
                         return $record->isExpired() ? "unexpire" :"expired"; 
                    })->colors([
                       'success' => "unexpire",
                       'danger' => 'expired',
                    ])->searchable(isIndividual:true)
                    ->label(__('general.status')),  

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
                SelectFilter::make(__('state'))
                ->options([
                    'unexpire' => __('general.unexpired'),
                    'expired' => __('general.expired'),
                ])->label(__('general.state')),

                Filter::make('created_at')
                ->form([
                    Forms\Components\DatePicker::make('start_date')->jalali(),
                    Forms\Components\DatePicker::make('end_date')->jalali(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['start_date'],
                            fn (Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
                        )
                        ->when(
                            $data['end_date'],
                            fn (Builder $query, $date): Builder => $query->whereDate('end_date', '<=', $date),
                        );
                })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(CopenExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exporter(CopenExporter::class)
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
