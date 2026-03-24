<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Models\Post;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\ToggleColumn;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    //arredondar as bordas da imagem,
                    ->label('Thumbnail'),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->wrap()
                    ->description(function (Post $record) {
                        return Str::of($record->content)->limit(50);
                    })
                    ->sortable(),

                TextColumn::make('tags.tag_name')
                    ->label('Tags')
                    ->badge()
                    ->color(function ($state) {
                        if (in_array($state, ['shoes', 'clothing'])) {
                            return 'success';
                        }
                    }),

                ToggleColumn::make('is_published')
                    ->label('Publicado?')
                    ->sortable(),

                SelectColumn::make('category_id')
                    ->label('Categoria')
                    ->searchable()
                    ->options(Category::pluck('name', 'id'))
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Autor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->icon(Heroicon::OutlinedEye)->label('Visualizar post'),
                    EditAction::make()->color('primary')->icon(Heroicon::OutlinedPencil)->label('Editar publicação'),
                    DeleteAction::make()->color('danger')->icon(Heroicon::OutlinedTrash)->label('Deletar publicação'),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->striped();
    }
}
