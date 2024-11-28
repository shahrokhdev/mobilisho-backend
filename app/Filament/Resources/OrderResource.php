<?php

namespace App\Filament\Resources;

use App\Filament\Exports\OrderExporter;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Copen;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?int $navigationSort = 6;
    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.orders');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.orders');
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

                Wizard::make([
                     Step::make('Order Details')
                     ->schema([      
                       Repeater::make('OrderData')
                       ->afterStateHydrated( function (Component $component, $livewire, $context) {
                        if ($context !== "create")
                        {
                        $ar = [];

                        $products = $livewire->record->products->toArray();
                        foreach($products as $item){
                            $ar[] = [
                                'product_id' => $item['pivot']['product_id'],
                                'quantity' => $item['pivot']['quantity'],
                                'price' => $item['pivot']['price'],
                            ];
                        }
                        $component->state($ar);
                    }
                    })->label(__('general.add_order'))
                       ->schema([
                        Select::make('product_id')  
                        ->label(__('general.product'))
                        ->options(Product::all()->pluck('title', 'id'))
                        ->afterStateUpdated(function ($state ,$component , Get $get , Set $set) {
                            $product = Product::find($state);
                            $finalPrice = $product->price * $get('quantity');
                            $set('price' , $finalPrice);
                        })
                        ->searchable()
                        ->reactive()
                        ->live(),         
                         TextInput::make('quantity')
                         ->label(__('general.quantity'))
                        ->required()
                        ->default(1)
                        ->numeric()
                        ->reactive()
                       ->afterStateUpdated(function ($state ,$component , Get $get , Set $set) {
                        $product = Product::find($get("product_id"));
                        $finalPrice = ($product->price * $get('quantity'));
                        $set('price' , $finalPrice);                         
                    }),
                    TextInput::make('price')
                       ->label(__('general.price'))
                        ->numeric()
                        ->readOnly()
                       ])->columns(3)               
                     ])->afterValidation(function (Get $get,Set $set) {
                           $data = $get('OrderData');
                           $total = 0;
                           foreach($data as $item) {
                                $total += $item['price'];  
                           }
                        $set('total_amount' , $total);   
                     })
                    ->label(__('general.order_details')),

                     
                     Step::make('Order Items')
                     ->schema([
                        Select::make('customer_id')
                        ->relationship('customer' , titleAttribute: 'name')
                        ->afterStateUpdated(function($state , Get $get , Set $set) {
                            $set("copen_code" , "");
                            $set("final_price" , "");
                          })
                        ->reactive()
                        ->required()
                       ->label(__(key: "general.customer")),
        
                        TextInput::make('total_amount')
                         ->live()
                         ->readOnly()
                        ->label(__("general.total_amount")),    
        
                        Textarea::make('delivery_address')  
                        ->maxLength(300)
                        ->required()
                         ->label(__("general.delivery_address")),              
    
                          TextInput::make(name: 'copen_code')
                          ->reactive()
                          ->afterStateUpdated(function($state , Get $get , Set $set) {
                            $customer = Customer::find($get('customer_id'));      

                            $code = Copen::query()
                            ->where('code' , $state)
                            ->where('state' , 'unexpire')
                            ->where('end_date', '>' ,now())
                            ->first() ??  null;       
                             
                               if($code){
                                   $discountAmount = $get("total_amount") * ($code->discount_value / 100);
                                   $finalPrice = ($get("total_amount") -  $discountAmount);
                                   $set("final_price" , $finalPrice);

                                     if($customer->orders->count() != 0 )
                                     {     
     
                                         foreach ($customer->orders as $item) {
                                             $copenCode = $item->copen_code;
                
                                             if ($customer->orders->where('copen_code', $code->code)->count() >= 1) {
                                                 $set("final_price" , $get("total_amount"));
                                             }
                                             else{
                                                 $set("final_price" , $finalPrice);
                                             }
                                         }   
                                     }   
                               }
                               else
                               $set("final_price" , $get("total_amount"));

                          })
                          ->label(__("general.copen_code")),   
          
                         TextInput::make('final_price')
                         ->readOnly()
                         ->live()
                          ->label(__("general.final_price")),   
                  
                         TextInput::make(name: 'copen_reason')
                         ->label(__("general.copen_reason")),   
                                 
                          Select::make('status')
                          ->required()
                          ->options([
                              'pending' => __("general.pending"),
                              'shipped' => __("general.shipped"),
                              'delivered' => __("general.delivered"),
                              'cancelled' => __("general.cancelled"),
                          ])->label(__(key: "general.status")),
        
                          Select::make('payment_method')
                          ->required()
                          ->options([
                              'credit-card' => __(key: "general.credit_card"),
                              'cash-on-delivery' =>__(key: "general.cash-on-delivery"),
                          ])->label(__(key: "general.payment_method")),
                                   
                          DatePicker::make('order_date')  
                          ->required()  
                          ->jalali()            
                           ->label(__("general.order_date")),        
        
                     ])->label(__('general.order_items'))
                ])
                ->columnSpan(12),                  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 /*  TextColumn::make('customer.fullname')
                  ->searchable(isIndividual:true)
                  ->label('Full Name'), */

                  TextColumn::make('order_date')
                   ->searchable(isIndividual:true)
                   ->jalaliDate()
                   ->label(__("general.order_date")),

                  TextColumn::make('total_amount')
                   ->searchable(isIndividual:true)
                   ->label(__("general.total_amount")),

                  TextColumn::make('delivery_address')
                   ->searchable(isIndividual:true)
                   ->label(__("general.delivery_address")),

                  TextColumn::make('copen_code')
                   ->searchable(isIndividual:true)
                   ->label(__("general.copen")),

                  TextColumn::make('copen_reason')
                   ->searchable(isIndividual:true)
                   ->label(__("general.copen_reason")),

                  TextColumn::make('copens.code')
                   ->searchable(isIndividual:true)
                   ->label(__("general.copen_priced")),

                  TextColumn::make('final_price')
                   ->searchable(isIndividual:true)
                   ->label(__("general.final_price")),

            
                  TextColumn::make('star')
                   ->searchable(isIndividual:true)
                   ->label(__("general.star")),

                  TextColumn::make('status')
                   ->searchable(isIndividual:true)
                   ->label(__("general.status")),

                  TextColumn::make('payment_method')
                   ->searchable(isIndividual:true)
                   ->label(label: __("general.payment_method")),

                  TextColumn::make('pay_status')
                   ->searchable(isIndividual:true)
                   ->label(__("general.pay_status")),
            ])
            ->filters([
                Filter::make('order_date')
                ->form([
                    Forms\Components\DatePicker::make('order_date')->jalali(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['order_date'],
                            fn (Builder $query, $date): Builder => $query->whereDate('order_date',  $date),
                        );         
                })
            ])
            ->actions(actions: [
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(OrderExporter::class)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exporter(OrderExporter::class)
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
