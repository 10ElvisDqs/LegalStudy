<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GuzzleHttp\Client;
use Spatie\Permission\Models\Role;
use Google_Client;
use Google_Service_Plus;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function adminlte_image(){
        $user=auth()->user();
        if ($user->google_token!=NULL){
            $token=$user->google_token;

            $client = new Client();
            $url = 'https://www.googleapis.com/oauth2/v2/userinfo';

            // Realiza la solicitud a la API de Google con el token de acceso en el encabezado de autorización.
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' .$token,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $datosUsuario = json_decode($response->getBody());
                $fotoPerfil = $datosUsuario->picture;
                return $fotoPerfil;
                // $fotoPerfil contendrá la URL de la foto de perfil del usuario.
            }
        }else {
            return 'https://picsum.photos/300/300';
            // Maneja cualquier error que pueda ocurrir durante la solicitud.
        }
    }

    public function adminlte_desc(){

        $user = auth()->user();

        if($user->hasRole('Administrador')){

            return 'Administrador';
        }
        if($user->hasRole('Empleado')){
            return 'Empleado';
        }
        if($user->hasRole('usuario')){
            return 'Usuario ';
        }

    }


}
