<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
// use Filament\Models\Contracts\HasAvatar;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;
//implements HasAvatar
#[Fillable(['name', 'email', 'is_admin', 'phone', 'avatar', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable 
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function sendEmail(array $data) {
        try {
            Mail::to($this->email)->send(new DemoMail($data, $this));
            Notification::make()
                ->success()
                ->duration(3000)
                ->title('Email enviado para ' . $this->name)
                ->body('Email enviado para usuário')
                ->send();
        } catch (\Throwable $th) {
            Notification::make()
                ->danger()
                ->duration(3000)
                ->title('Erro ao enviar email para ' . $this->name)
                ->body('Ocorreu um erro ao enviar o email para o usuário')
                ->send();
        }
    }

    // public function getFilamentAvatarUrl(): ?string
    // {
    //     return $this->avatar;
    // }
}
