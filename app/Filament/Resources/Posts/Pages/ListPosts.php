<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;

// use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make()
                ->icon(Heroicon::OutlinedDocument)
                ->badge(function () {
                    return static::getModel()::count();
                })
                ->badgeColor('primary'),
            'Publicados' => Tab::make()
                ->query(function ($query) {
                    return $query->where('is_published', true);
                })
                ->icon(Heroicon::OutlinedCheckCircle)
                ->badge(function () {
                     return static::getModel()::where('is_published', true)->count();
                })
                ->badgeColor('success')
                ,
            'Não Publicados' => Tab::make()
                ->query(function ($query) {
                    return $query->where('is_published', false);
                })
                ->icon(Heroicon::OutlinedXCircle)
                ->badge(function (){
                     return static::getModel()::where('is_published', false)->count();
                })
                ->badgeColor('warning')
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->slideOver(),
        ];
    }
}
