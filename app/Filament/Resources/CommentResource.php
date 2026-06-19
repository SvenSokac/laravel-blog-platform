<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Comment Details')
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author_email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('blog_id')
                            ->relationship('blog', 'title')
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'content')
                            ->label('Reply To')
                            ->searchable()
                            ->nullable(),
                    ]),
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Engagement')
                    ->schema([
                        Forms\Components\TextInput::make('likes')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author_email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('blog.title')
                    ->searchable()
                    ->sortable()
                    ->label('Blog Post'),
                Tables\Columns\TextColumn::make('content')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('likes')
                    ->sortable()
                    ->label('Likes'),
                Tables\Columns\IconColumn::make('parent_id')
                    ->boolean()
                    ->label('Is Reply'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('replies')
                    ->query(fn(Builder $query) => $query->whereNotNull('parent_id'))
                    ->label('Show Replies Only'),
                Tables\Filters\Filter::make('top_comments')
                    ->query(fn(Builder $query) => $query->whereNull('parent_id'))
                    ->label('Show Top Comments Only'),
                Tables\Filters\SelectFilter::make('blog_id')
                    ->relationship('blog', 'title')
                    ->label('Blog Post'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNull('parent_id')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
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
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
