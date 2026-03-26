<?php

namespace App\Filament\Exports;

use App\Models\Post;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PostExporter extends Exporter
{
    protected static ?string $model = Post::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('title')
                ->label('Título'),
            ExportColumn::make('user.name')
                ->label('Autor'),
            ExportColumn::make('category.name')
                ->label('Categoria'),
            ExportColumn::make('tags')
                ->label('Tags')
                ->formatStateUsing(function ($record) {
                    $tags = $record->tags()->pluck('tag_name')->toArray();
                    return empty($tags) ? 'No tags' : implode(', ', $tags);
                }),
            ExportColumn::make('is_published')
                ->label('Publicado?')
                ->formatStateUsing(function ($state) {
                    return $state ? 'Sim' : 'Não';
                }),
            ExportColumn::make('content')
                ->label('Conteúdo')
                ->words(20),
            ExportColumn::make('created_at')
                ->label('Criado em'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your post export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
