<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Usuário')
                            ->icon(Heroicon::OutlinedUser)
                            ->schema([
                                Section::make('Informações do usuário')
                                ->description(fn ($operation) => match ($operation) {
                                    'create' => 'Crie um novo usuário preenchendo as informações abaixo.',
                                    'edit' => 'Edite as informações do usuário conforme necessário.',
                                    default => null,
                                })
                                ->columns(2)
                                ->columnSpanFull()
                                ->collapsible()
                                ->schema([
                                    TextInput::make('name')
                                        ->rules(['required', 'min:10'])
                                        ->label('Nome')
                                        ->placeholder('Digite o nome do usuário')
                                        ->hint("Nome do usuário")
                                        ->validationMessages([
                                            'required' => 'O nome é obrigatório.',
                                            'min' => 'O campo nome deve conter no mínimo :min caracteres. Por gentileza, informe um nome completo.',
                                        ])
                                        ->required(),
                    
                                    TextInput::make('email')
                                        ->rules(['required'])
                                        ->unique()
                                        ->email()
                                        ->label('E-mail')
                                        ->placeholder('Digite o email do usuário')
                                        ->hint("Email do usuário")
                                        ->email()
                                        ->required(),
                    
                                    TextInput::make('password')
                                        ->rules(['required'])
                                        ->password()
                                        ->placeholder('Digite a senha do usuário')
                                        ->hint("Senha do usuário")
                                        ->required()
                                        ->visibleOn(['create']),
                    
                                    TextInput::make('phone')
                                        ->label('Telefone')
                                        ->mask('(61) 99999-9999')
                                        ->placeholder('(61) 99999-9999')
                                        ->hint("Telefone do usuário"),
                                ]),
                        ]),
                        Tab::make('Avatar')
                            ->icon(Heroicon::OutlinedPhoto)
                            ->schema([
                                Section::make('Avatar')
                                    ->description('Defina o avatar do usuário.')
                                    ->schema([
                                        FileUpload::make('avatar')
                                            ->label('Anexo')
                                            ->image()
                                            ->imageEditor()
                                            ->directory('avatars')
                                            ->helperText('Faça o upload da imagem de perfil do usuário.')
                                            ->columnSpanFull(),
                                    ])->columnSpanFull(),
                            ]),
                        Tab::make('Privilégios')
                            ->icon(Heroicon::OutlinedShieldCheck)
                            ->schema([
                                Section::make('Privilégios de administrador')
                                    ->description('Configurações de privilégios de administrador.')
                                    ->schema([
                                        Toggle::make('is_admin')
                                            ->label('Administrador')
                                            ->hint('Defina se o usuário tem privilégios de administrador.')
                                            ->helperText('Usuário é admin?')
                                            ->columnSpanFull(), 
                                    ])->columnSpanFull()
                            ]),
                    ])->contained(false)->columnSpanFull(),
        ]);
    }
}
