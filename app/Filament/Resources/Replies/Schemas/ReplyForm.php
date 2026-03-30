<?php

namespace App\Filament\Resources\Replies\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReplyForm
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
                Select::make('comment_id')
                    ->relationship('comment', 'id')
                    ->required(),
            ]);
    }
}
