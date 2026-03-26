<?php

namespace App\Filament\Resources\Exports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Models\Export;

class ExportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_name')
                    ->icon(Heroicon::OutlinedTableCells)
                    ->label('Nome do arquivo'),
                TextColumn::make('completed_at')
                    ->label('Exportado em')
                    ->icon(Heroicon::OutlinedClock)
                    ->dateTime('d/m/Y H:i:s'),
                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Baixar')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->url(function ($record) {
                        return route('filament.exports.download', ['export' => $record, 'format' => 'xlsx'], absolute: false);
                    }
                )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
