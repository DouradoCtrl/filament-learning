<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações da Publicação')
                    ->description('Detalhes da publicação selecionada')
                    ->columns(3)
                    ->schema([ 
                        TextEntry::make('title')
                            ->label('Título'),
                        TextEntry::make('slug')
                            ->label('Slug'),
                        TextEntry::make('category.name')
                            ->label('Categoria')
                            ->getStateUsing(function ($record) {
                                return strtoupper($record->category->name);
                            }),
                        TextEntry::make('tags.tag_name')
                            ->label('Tags')
                            ->badge(),
                        TextEntry::make('is_published')
                            ->label('Publicado?')
                            ->getStateUsing(function ($record) {
                                return $record->is_published ? "Sim" : "Não";
                            })
                            ->badge()
                            ->color(fn($state) => $state === 'Sim' ? 'success' : 'danger'),
                        TextEntry::make('created_at')
                            ->label('Criado em')
                            ->dateTime(),
                ])->columnSpanFull(),
                Section::make('Conteúdo da Publicação')
                    ->description('Conteúdo completo da publicação')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('thumbnail')
                            ->label('Thumbnail'),
                        TextEntry::make('content')
                            ->label('Conteúdo')
                            ->html(),
                ])->columnSpanFull(),
                Section::make('Informações do Autor')
                    ->description('Detalhes do autor da publicação')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('user.avatar')
                            ->circular(),
                        Group::make([
                            TextEntry::make('user.name')
                                ->icon(Heroicon::OutlinedUser)
                                ->label('Nome'),
                            TextEntry::make('user.email')
                                ->icon(Heroicon::OutlinedEnvelope)
                                ->label('Email'),
                            TextEntry::make('user.phone')
                                ->icon(Heroicon::OutlinedPhone)
                                ->label('Telefone'),
                            IconEntry::make('user.is_admin')
                                ->label('Administrador?')
                                ->icon(fn($record) => $record->user->is_admin ? Heroicon::OutlinedShieldCheck : Heroicon::OutlinedXCircle)
                                ->color(fn($record) => $record->user->is_admin ? 'success' : 'danger')
                                ->state(fn($record) => $record->user->is_admin ? 'Sim' : 'Não'),
                        ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }
}
