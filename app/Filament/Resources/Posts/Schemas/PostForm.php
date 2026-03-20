<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use App\Models\Category;
use App\Models\User;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do post')
                    ->description(function ($operation) {
                        if ($operation === 'create') {
                            return 'Preencha as informações para criar um novo post.';
                        }
                        return 'Atualize as informações do post.';
                    })
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->hint('Título do post')
                            ->label('Título')    
                            ->required()
                            ->live()
                            ->afterStateUpdated(function($state, $set){
                                $set('slug', str()->slug($state));
                            })
                            ->placeholder('Digite o título do post'),
                        TextInput::make('slug')
                            ->hint('Slug do post')
                            ->label('Slug')    
                            ->required()
                            ->placeholder('Digite o slug do post'),
                ])->columnSpanFull(),
                Section::make('Conteúdo do post')
                    ->description(function ($operation) {
                        if ($operation === 'create') {
                            return 'Preencha o conteúdo para criar um novo post.';
                        }
                        return 'Atualize o conteúdo do post.';
                    })
                    ->columns(2)
                    ->schema([
                        RichEditor::make('content')
                            ->hint('Conteúdo do post')
                            ->label('Conteúdo')    
                            ->required()
                            ->placeholder('Digite o conteúdo do post')
                            ->columnSpanFull(),
                ])->columnSpanFull(),
                Section::make('Publicação thumbnail')
                    ->description(function ($operation) {
                        if ($operation === 'create') {
                            return 'Adicione uma thumbnail para o post.';
                        }
                        return 'Atualize a thumbnail do post.';
                    })
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->hint('Adicione uma imagem para a thumbnail do post')
                            ->directory('thumbnails')
                            ->image()   
                            ->required(),
                ])->columnSpanFull(),
                Section::make('Categoria e tags')
                    ->description(function ($operation) {
                        if ($operation === 'create') {
                            return 'Defina as configurações de publicação para o post.';
                        }
                        return 'Atualize as configurações de publicação do post.';
                    })
                    ->columns(2)
                    ->schema([
                        Select::make('category_id')
                            ->label('Categoria')
                            ->preload()
                            ->searchable()
                            // ->options(Category::all()->pluck('name', 'id')) --- IGNORE ---
                            ->relationship('category', 'name')
                            ->hint('Selecione a categoria do post')
                            ->required(),
                        Select::make('tags')
                            ->multiple()
                            ->label('Tags')
                            ->preload()
                            ->searchable()
                            ->relationship('tags', 'tag_name'),
                ])->columnSpanFull(),
                Section::make('Configurações de publicação')
                    ->description(function ($operation) {
                        if ($operation === 'create') {
                            return 'Defina as configurações de publicação para o post.';
                        }
                        return 'Atualize as configurações de publicação do post.';
                    })
                    ->columns(2)
                    ->schema([
                        Select::make('is_published')
                            ->label('Publicado?')
                            ->options([
                                0 => 'Não',
                                1 => 'Sim',
                            ])
                            ->default(0)
                            ->required(),
                ])->columnSpanFull(),
            ]);
    }
}
