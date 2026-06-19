<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Blog Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('excerpt')
                            ->required() // ADDED: This was missing but required in DB
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Media & Metadata')
                    ->schema([
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->directory('blogs')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->imagePreviewHeight('250'),

                        Forms\Components\TextInput::make('category')
                            ->required() // ADDED: This was missing but required in DB
                            ->maxLength(255),
                        Forms\Components\TagsInput::make('tags')
                            ->separator(','),
                    ]),
                Forms\Components\Section::make('Author Information')
                    ->schema([
                        Forms\Components\TextInput::make('author_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('author_initial')
                            ->required() // ADDED: This was missing but required in DB
                            ->maxLength(5),
                    ]),
                Forms\Components\Section::make('Publishing')
                    ->schema([
                        Forms\Components\DatePicker::make('published_date') // CHANGED: from DateTimePicker to DatePicker
                            ->required() // ADDED: This was missing but required in DB
                            ->default(now()),
                        Forms\Components\KeyValue::make('social_links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->circular()
                    ->disk('public')
                    ->label('Featured Image')
                    ->getStateUsing(function ($record) {
                        return $record->images ? $record->images[0] : null;
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('author_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tags')
                    ->formatStateUsing(fn($state) => $state ? implode(', ', $state) : '-')
                    ->limit(30),
                Tables\Columns\TextColumn::make('reactions_count')
                    ->counts('reactions')
                    ->label('Reactions')
                    ->sortable(),
                Tables\Columns\TextColumn::make('comments_count')
                    ->counts('comments')
                    ->label('Comments')
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->query(fn(Builder $query) => $query->whereNotNull('published_date')),
                Tables\Filters\Filter::make('unpublished')
                    ->query(fn(Builder $query) => $query->whereNull('published_date')),
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn() => Blog::distinct()->pluck('category', 'category')->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('publish')
                    ->action(fn(Blog $record) => $record->update(['published_date' => now()]))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn(Blog $record) => $record->published_date === null),
                Tables\Actions\Action::make('unpublish')
                    ->action(fn(Blog $record) => $record->update(['published_date' => null]))
                    ->icon('heroicon-o-x')
                    ->color('danger')
                    ->visible(fn(Blog $record) => $record->published_date !== null),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('publish')
                    ->action(fn($records) => $records->each->update(['published_date' => now()]))
                    ->icon('heroicon-o-check'),
                Tables\Actions\BulkAction::make('unpublish')
                    ->action(fn($records) => $records->each->update(['published_date' => null]))
                    ->icon('heroicon-o-x'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
