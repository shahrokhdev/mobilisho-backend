<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\ReplicateAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use App\Filament\Exports\CommentExporter;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\Hidden;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Actions\Modal\Actions\ButtonAction;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    public static function getpluralModelLabel(): string
    {
        return __(key: 'general.comments');
    }

    public static function getNavigationLabel(): string
    {
        return __(key: 'general.comments');
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
                MarkdownEditor::make('comment')
                ->required()
                ->columnSpan('full')
                ->maxLength(500)
                 ->label(__("general.comment")),      
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
                 TextColumn::make('user.username')->label(__('general.username'))->searchable(isIndividual:true),
                 TextColumn::make('commentable.title')->label(__('general.comment-subject'))->searchable(isIndividual:true),
               BadgeColumn::make('status')->searchable(isIndividual:true)
               ->getStateUsing(function (Comment $record){
                    return $record->isApproved() ? "approved" :"pending"; 
               })->colors([
                  'success' => "approved",
                  'danger' => "pending",
               ])->label(__('general.status')),  
               TextColumn::make('created_at')->label(__('general.created_at'))->jalaliDate()->searchable(isIndividual:true),
            ])
            ->filters([
                SelectFilter::make(__('status'))
                ->options([
                    'approved' => __('general.approved'),
                    'pending' => __('general.pending'),
                ])->label(__('general.status')),

                SelectFilter::make('commentable_id')
                ->options([
                    1 => __('general.articles'),
                    2 =>__('general.products'),
                ])->label(__("general.show_by"))
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                ->action(function (Comment $comment) {
                    $comment->status = 'approved';
                    $comment->save();
                    Notification::make() 
                    ->title(__('general.approved'))
                    ->success()
                    ->send(); 
                })->requiresConfirmation()
                ->hidden(function (Comment $comment){
                    return $comment->isApproved();
                })
                ->color('success')
                ->icon('heroicon-s-check-circle')
                ->label(__('general.approve')),

                Tables\Actions\Action::make('reject')
                ->action(function (Comment $comment) {
                    $comment->delete();
                    Notification::make() 
                    ->title(__('general.deleted'))
                    ->success()
                    ->send(); 
                })->requiresConfirmation()
                ->visible(function (Comment $comment){
                   return $comment->isApproved();
                })
                ->color('danger')
                ->icon('heroicon-s-x-mark')
                ->label(__('general.delete')),
                Tables\Actions\ViewAction::make()->button()->color('info'),
                Tables\Actions\Action::make('reply')
               ->form([
                TextInput::make('user.username')->default(fn(Comment $record)=> $record->user->username)->required(),
                TextInput::make('commentable.title')->default(fn(Comment $record)=> $record->commentable->title)->required(),
                Hidden::make('commentable_id')->required()->default(fn(Comment $record)=> $record->commentable_id),
                Hidden::make('commentable_type')->required()->default(fn(Comment $record)=> $record->commentable_type),
                Hidden::make('child')->default(fn(Comment $record)=> $record->id),
                TextInput::make('comment')
                ->required()
                ->columnSpan('full')
                ->maxLength(500)
                 ->label(__("general.comment")),     
               ])
                ->action(function ($data) {
                     $comment = new Comment();
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
            'index' => Pages\ListComments::route('/'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
       return $infolist
       ->schema([
            TextEntry::make('user.username')->label(__("general.username")),
            TextEntry::make('comment')->label(__("general.comment")),
            TextEntry::make(name: 'child.comment')->label(__("general.admin-reply"))
       ]);    
    }
}
