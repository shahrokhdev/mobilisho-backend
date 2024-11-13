<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportTicketResource\Pages;
use App\Filament\Resources\SupportTicketResource\RelationManagers;
use App\Models\SupportTicket;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
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

    public static function canCreate(): bool
    {
        return false; 
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
                BadgeColumn::make('state')
                ->getStateUsing(function (SupportTicket $record){
                     return $record->isAnswered() ? "answered" :"pending"; 
                })->colors([
                   'success' => "answered",
                   'warning' => "pending",
                ])->label(__('general.state')),  
                TextColumn::make('completed_at')
                ->label(__('general.completed_at')),
                TextColumn::make('created_at')->label(__('general.created_at')),
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
                Tables\Actions\Action::make('answered')
                ->action(function (SupportTicket $ticket) {
                    $ticket->state = 'answered';
                    $ticket->save();
                    Notification::make() 
                    ->title(__('general.answered'))
                    ->success()
                    ->send(); 
                })->requiresConfirmation()
                ->hidden(function (SupportTicket $ticket){
                    return $ticket->isAnswered();
                })
                ->color('success')
                ->icon('heroicon-s-check-circle')
                ->label(__('general.approve')),
                Tables\Actions\Action::make('rejected')
                ->action(function (SupportTicket $ticket) {
                    $ticket->delete();
                    Notification::make() 
                    ->title(__('general.deleted'))
                    ->success()
                    ->send(); 
                })->requiresConfirmation()
                ->visible(function (SupportTicket $ticket){
                   return $ticket->isAnswered();
                })
                ->color('danger')
                ->icon('heroicon-s-x-mark')
                ->label(__('general.delete')),
                Tables\Actions\Action::make('reply')
                ->form([
                 TextInput::make('user.username')->default(fn(SupportTicket $record)=> $record->user->username)->required(),
                 TextInput::make('subject')->default(fn(SupportTicket $record)=> $record->subject)->required(),
                 TextInput::make('messages')->required()->default(fn(SupportTicket $record)=> $record->messages),
                /*  Hidden::make('commentable_type')->required()->default(fn(SupportTicket $record)=> $record->commentable_type),
                 Hidden::make('child')->default(fn(SupportTicket $record)=> $record->id),
                 TextInput::make('comment')
                 ->required()
                 ->columnSpan('full')
                 ->maxLength(500)
                  ->label(__("general.comment")),      */
                ])
                 ->action(function ($data) {
                      $comment = new SupportTicket();
                       $comment->create([
                          'user_id' => auth()->user()->id ,
                          'commentable_id' => $data['commentable_id'] ,
                          'commentable_type' => $data['commentable_type'] ,
                          'parent' => $data['child'] ,
                          'comment' => $data['comment'],
                          'status' => 'approved'
                       ]);
                       Notification::make()
                       ->title(__("general.created"))
                       ->success()
                       ->send();
                 })
                 ->button()
                 ->color('warning')
                 ->label(__("general.reply")),
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
