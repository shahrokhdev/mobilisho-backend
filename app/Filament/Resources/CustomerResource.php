<?php

namespace App\Filament\Resources;

use App\Filament\Exports\CustomerExporter;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 3;
    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.customers');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.customers');
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
    }public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make(name: 'user_id')
                ->relationship('user' , 'username')
                ->required()
              ->label(__(key: "general.user")),

                TextInput::make('name')
                ->required()
                ->maxLength(length: 30)
                 ->label(__("general.name")),        

                TextInput::make('family')
                ->required()
                ->maxLength(50)
                 ->label(__("general.family")),              

                 FileUpload::make('image')->required()
                     ->label(__("general.image")), 

                 TextInput::make('mobile')
                 ->required()
                 ->maxLength(11)
                 ->tel()
                  ->label(__("general.mobile")),   

                 DatePicker::make('birth_date')
                 ->required()
                 ->jalali()
                  ->label(__("general.birth_date")),   

                  Select::make('gender')
                  ->options([
                      'male' => 'male',
                      'female' => 'female',
                  ])->label(__(key: "general.gender"))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('general.name'))->searchable(isIndividual:true),
                TextColumn::make('family')->label(__('general.family'))->searchable(isIndividual:true),
                ImageColumn::make('image')->label(__('general.image')),
                TextColumn::make('birth_date')->label(__('general.birth_date'))->searchable(isIndividual:true)->jalaliDate(),
                TextColumn::make('mobile')->label(__('general.mobile'))->searchable(isIndividual:true),
                TextColumn::make('gender')->label(__('general.gender'))->searchable(isIndividual:true),
                TextColumn::make('created_at')->label(__('general.created_at'))->searchable(isIndividual:true)->jalaliDate(),
            ])
            ->filters([
                SelectFilter::make(__('gender'))
                ->options([
                    'male' => __('general.male'),
                    'female' => __('general.female'),
                ])->label(__('general.gender')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(CustomerExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exporter(CustomerExporter::class)
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
