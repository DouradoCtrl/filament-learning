<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make()
                ->icon(Heroicon::OutlinedDocument)
                ->badge(function () {
                    return static::getModel()::count();
                })
                ->badgeColor('primary'),
            'Administrador' => Tab::make()
                ->query(function ($query) {
                    return $query->where('is_admin', true);
                })
                ->icon(Heroicon::OutlinedCheckCircle)
                ->badge(function () {
                     return static::getModel()::where('is_admin', true)->count();
                })
                ->badgeColor('success')
                ,
            'Usuário' => Tab::make()
                ->query(function ($query) {
                    return $query->where('is_admin', false);
                })
                ->icon(Heroicon::OutlinedXCircle)
                ->badge(function (){
                     return static::getModel()::where('is_admin', false)->count();
                })
                ->badgeColor('warning')
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
