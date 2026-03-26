<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Editar Publicação')
                ->icon(Heroicon::Pencil)
                ->size('sm')
                ->color('primary')
                ->slideOver(),
            DeleteAction::make()
                ->label('Excluir Publicação')
                ->icon(Heroicon::Trash)
                ->size('sm')
                ->color('danger')
        ];
    }
}
