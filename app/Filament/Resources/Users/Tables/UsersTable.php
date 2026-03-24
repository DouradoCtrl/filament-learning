<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular()
                    ->visibleFrom('md'),
                    
                TextInputColumn::make('name')
                    ->rules(['required'])
                    ->label('Nome')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->visibleFrom('md'),

                ToggleColumn::make('is_admin')
                    ->label('Admin?'),
                
                TextColumn::make('email_verified_at')
                    ->label('Email verificado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                    ->label('Telefone')
                    ->visibleFrom('md')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->sortable()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('comments_count')
                    ->label('Comentários')
                    ->badge()
                    ->color(function ($state): string {
                        if ($state >= 2) {
                            return 'success';
                        }
                        return 'danger';
                    })
                    ->counts('comments')
                    ->visibleFrom('md'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->icon(Heroicon::OutlinedEye)->label('Visualizar usuário'),
                    EditAction::make()->color('primary')->icon(Heroicon::OutlinedPencil)->label('Editar usuário'),
                    DeleteAction::make()->color('danger')->icon(Heroicon::OutlinedTrash)->label('Deletar usuário'),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
