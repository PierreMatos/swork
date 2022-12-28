<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< Updated upstream
=======

     // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

     /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'NIF_UTILIZADOR' => $this->USER_NIF,
            // 'PASS_UTILIZADOR' => $user->USER_NAME,
            // 'id' => 33
            
        ];
    }

    //  we have added getUser here so we have flexibility of changing column  //  name in future without modifying at other places
    public function getUser($USER_NIF)
    {
        // dd($USER_NIF);
        $user = $this->userRepository->userGet($USER_NIF)[0];
        // DD($user);
        $collection = collect($user);

        $collection->transform(function($item, $key) {
            if ($key == 'USER_QUALIFICATION'){
                $this->convertUTF8($item);
            }else {
                return $item;
            }
        });


        return ($collection);
        return $user;

        // return $this->where('USER_NIF', $username)->first();

    }

//    Uncomment this function to use your customer columns,
//    By default it will use your primary key defiled above.
//
   public function getAuthIdentifier() {
       return $this->attributes['NIF_UTILIZADOR'];
   }
//
   public function getAuthPassword() {
       return $this->attributes['PASS_UTILIZADOR'];
   }

   public function setPasswordAttribute($value)
    {
        $this->attributes['PASS_UTILIZADOR'] = bcrypt($value);
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'EMAIL_UTILIZADOR'
        );
    }

    public function getEmailForPasswordReset()
    {

        return $this->EMAIL;
    }

    public function sendPasswordResetNotification($token)
    {
      
        $this->notify(new ResetPassword($token));
    }
        public function getRememberTokenName()
    {
        return 'REMEMBER_TOKEN';
    }
>>>>>>> Stashed changes
}
