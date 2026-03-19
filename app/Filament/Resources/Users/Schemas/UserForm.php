<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->rules(['required', 'min:10'])
                    ->label('Nome')
                    ->placeholder('Digite o nome do usuário')
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
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->rules(['required'])
                    ->password()
                    ->placeholder('Senha do usuário')
                    ->required()
                    ->visibleOn(['create']),

                TextInput::make('phone')
                    ->label('Telefone')
                    ->mask('(61) 99999-9999')
                    ->placeholder('(61) 99999-9999'),

                Toggle::make('is_admin')
                    ->label('Administrador?')
                    ->helperText('Indica se o usuário tem privilégios de administrador.'),

                FileUpload::make('avatar')
                    ->label('Anexo')
                    ->avatar()
                    ->directory('avatars')
                    ->helperText('Faça o upload da imagem de perfil do usuário.'),
            ]);
    }
}
