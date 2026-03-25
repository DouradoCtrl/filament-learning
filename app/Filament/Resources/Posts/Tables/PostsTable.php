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
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Enums\FiltersLayout;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->filtersTriggerAction(function (Action $action) {
                return $action->button()->label('Filtrar posts');
            })
            ->filtersFormWidth(Width::FourExtraLarge)
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
                // TextColumn::make('created_at')
                //     ->label('Criado em')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->label('Atualizado em')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // TernaryFilter::make('is_published')
                //     ->label('Publicado?'),

                SelectFilter::make('is_published')
                    ->label('Publicado?')
                    ->searchable()
                    ->options([
                        1 => 'Sim',
                        0 => 'Não',
                    ]),

                SelectFilter::make('user_id')
                    ->label('Autor')
                    ->preload()
                    ->multiple()
                    ->searchable()
                    ->relationship('user', 'name'),

                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->preload()
                    ->multiple()
                    ->searchable()
                    ->relationship('category', 'name'),
            ], layout: FiltersLayout::AboveContentCollapsible)
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->slideOver()
                        ->icon(Heroicon::OutlinedEye)
                        ->label('Visualizar post'),
                    EditAction::make()
                        ->slideOver()   
                        ->color('primary')
                        ->icon(Heroicon::OutlinedPencil)
                        ->label('Editar publicação'),
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
