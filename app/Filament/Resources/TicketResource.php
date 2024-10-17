<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\FilesColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


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

    public static function canCreate(): bool
    {
        return false; 
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('priority')
                ->options([
                    'low' => 'low',
                    'medium' => 'medium',
                    'high' => 'high',
                    'important' => 'important',
                ])->label(__(key: "general.priority")),

                TextInput::make(name: 'title')
                ->required()
                ->maxLength(length: 30)
                 ->label(__("general.title")),        

                Textarea::make('description')
                ->required()
                ->maxLength(500)
                 ->label(__("general.description")),              

                 FileUpload::make('attached_file')->required()
                     ->label(__("general.attached_file")), 

                  Select::make('state')
                  ->options([
                      'rejected' => 'rejected',
                      'pending' => 'pending',
                      'answered' => 'answered',
                  ])->label(__(key: "general.state")),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('general.title')),
                TextColumn::make('description')->label(__('general.description')),
                TextColumn::make('state')->label(__('general.state')),
                TextColumn::make('priority')->label(__('general.priority')),
            /*     FileUploadColumn::make('attached_file')
                ->multiple()
                ->openable(), */
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public function replyToTicket($reply)
    {
        // Logic to reply to the ticket goes here
        // You can use the $reply variable to store the reply message
        // and then update the ticket status or add a new comment to the ticket
    }
}
