<?php

namespace App\Filament\Resources\Exports\Schemas;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class ExportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextColumn::make('file_name')
                    ->label('Nome do arquivo'),
                TextColumn::make('completed_at')
                    ->label('Completado em')

            ]);
    }
}
