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
use Filament\Tables\Filters\TernaryFilter;
use Filament\Support\Enums\Width;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use App\Models\User;
use App\Filament\Exports\UserExporter;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\ExportBulkAction;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->headerActions([
                ExportAction::make()
                    ->label('Relatório')
                    ->icon(Heroicon::OutlinedArrowDownOnSquare)
                    ->exporter(UserExporter::class)
                    ->fileName(fn (Export $export): string => "users-{$export->getKey()}")
                    ->formats([
                        ExportFormat::Xlsx,
                        ExportFormat::Csv,
                    ])
                    ->slideOver(),
                ])
            ->filtersTriggerAction(function (Action $action) {
                return $action->button()->label('Filtrar usuários');
            })
            ->filtersFormWidth(Width::ExtraLarge)
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular()
                    ->visibleFrom('md'),
                    
                TextColumn::make('name')
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
                    ->icon(Heroicon::OutlinedChatBubbleOvalLeft)
                    ->color(function ($state): string {
                        return ($state >= 2) ? 'success' : 'danger';
                    })
                    ->counts('comments')
                    ->visibleFrom('md'),
            ])
            ->filters([
                // TernaryFilter::make('is_admin')
                //     ->label('Publicado?'),

                SelectFilter::make('is_admin')
                    ->label('Administrador?')
                    ->searchable()
                    ->options([
                        1 => 'Sim',
                        0 => 'Não',
                    ]),
                SelectFilter::make('id')
                    ->label('Nome')
                    ->searchable()
                    ->multiple()
                    ->options(User::pluck('name', 'id')),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->slideOver()
                        ->icon(Heroicon::OutlinedEye)
                        ->label('Visualizar usuário'),
                    EditAction::make()
                        ->slideOver()
                        ->color('primary')
                        ->icon(Heroicon::OutlinedPencil)
                        ->label('Editar usuário'),
                    DeleteAction::make()->color('danger')->icon(Heroicon::OutlinedTrash)->label('Deletar usuário'),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->label('Exportar Usuários')
                        ->exporter(UserExporter::class)
                        ->slideOver()
                ]),
        ])->striped();
    }
}
