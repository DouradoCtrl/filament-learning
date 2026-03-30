<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use ParagonIE\ConstantTime\Hex;

class UserStats extends StatsOverviewWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Total de usuários', User::count())
                ->description('Número total de usuários')
                ->color('primary')
                ->icon(Heroicon::OutlinedUserGroup),
            Stat::make('Usuários Administradores', User::where('is_admin', true)->count())
                ->description('Número de administradores')
                ->color('success')
                ->icon(Heroicon::OutlinedShieldCheck),
            Stat::make('Usuários comuns', User::where('is_admin', false)->count())
                ->description('Número de usuários comuns')
                ->icon(Heroicon::OutlinedUser),
        ];
    }

    // protected function getColumns(): int
    // {
    //     return 2; // Ou count($this->getStats())
    // }
}


