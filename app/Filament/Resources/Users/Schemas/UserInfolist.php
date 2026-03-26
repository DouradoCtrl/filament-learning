<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use \Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //exibir avatar
                ImageEntry::make('avatar')
                    ->label('Avatar')
                    ->circular(),
                TextEntry::make('name')
                    ->label('Name'),
                TextEntry::make('email')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->label('Endereço de e-mail'),
                TextEntry::make('email_verified_at')
                    ->label('Email verificado em')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('phone')
                    ->icon(Heroicon::OutlinedPhone)
                    ->label('Telefone'),
                IconEntry::make('is_admin')
                    ->label('Administrador?')
                    ->boolean(),
                TextEntry::make('comments_count')
                    ->icon(Heroicon::OutlinedChatBubbleOvalLeft)
                    ->label('Número de comentários')
                    ->counts('comments'),
                TextEntry::make('posts_count')
                    ->icon(Heroicon::OutlinedDocumentText)
                    ->label('Número de posts')
                    ->counts('posts'),   
                TextEntry::make('created_at')
                    ->label("Criado em")
                    ->dateTime()
                    ->placeholder('-'),
            ])->columns(3);
    }
}
