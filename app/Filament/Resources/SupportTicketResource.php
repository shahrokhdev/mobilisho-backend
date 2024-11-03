<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportTicketResource\Pages;
use App\Filament\Resources\SupportTicketResource\RelationManagers;
use App\Models\SupportTicket;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupportTicketResource extends Resource
{
    protected static ?string $model = SupportTicket::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';


    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.tickets');
    }
    public static function getNavigationLabel(): string
    {
        return __(key: 'general.tickets');
    }

    public static function getNavigationGroup(): string
    {
        return __(key: 'general.system-management');
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
                Select::make('user_id')
                ->relationship('user' , 'username')
               ->label(__(key: "general.user_id")),

                TextInput::make(name: 'subject')
                ->required()
                ->maxLength(length: 30)
                 ->label(__("general.subject")),        
      
               Select::make('priority')
                ->options([
                    'low' => 'low',
                    'medium' => 'medium',
                    'high' => 'high',
                    'important' => 'important',
                ])->label(__(key: "general.priority")),

                  FileUpload::make('attached_file')
                     ->label(__("general.attached_file")), 

                  Select::make('state')
                  ->options([
                      'rejected' => 'rejected',
                      'pending' => 'pending',
                      'answered' => 'answered',
                  ])->label(__(key: "general.state")),

                  DatePicker::make('completed_at')
                  ->jalali()
                  ->label(__('general.completed_at')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label(__('general.subject')),
                TextColumn::make('subject')->label(__('general.subject')),
                TextColumn::make('priority')->label(__('general.priority')),
                TextColumn::make('state')->label(__('general.state')),
                TextColumn::make('completed_at')->label(__('general.completed_at')),
                TextColumn::make('created_at')->label(__('general.created_at')),
                TextColumn::make('updated_at')->label(__('general.updated_at')),
            ])
            ->filters([
                SelectFilter::make(name: 'state')
                ->options([
                    'rejected' => 'rejected',
                    'pending' => 'medium',
                    'answered' => 'answered',
                ])->label(__('general.filter_by_state')),


                SelectFilter::make(name: 'priority')
                  ->options([
                      'low' => 'low',
                      'medium' => 'medium',
                      'high' => 'high',
                      'important' => 'important',
                      ])->label(__('general.filter_by_priority'))
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
            'index' => Pages\ListSupportTickets::route('/'),
            'create' => Pages\CreateSupportTicket::route('/create'),
            'edit' => Pages\EditSupportTicket::route('/{record}/edit'),
        ];
    }
}
