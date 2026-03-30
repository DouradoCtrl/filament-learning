<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('post_id')
                    ->relationship('post', 'title')
                    ->required(),
            ]);
    }
}
