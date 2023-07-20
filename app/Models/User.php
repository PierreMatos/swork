<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\ResetPassword;


class User extends Authenticatable implements JWTSubject, CanResetPassword
{

    private $userRepository;
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'NIF_UTILIZADOR';


    use HasApiTokens, HasFactory, Notifiable;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    // protected $table = 'API_USER_LIST';
    protected $table = 'EMPREGADOS_UTILIZADORES_PORTAL';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'USER_NAME',
        'USER_EMAIL',
        'USER_PASSWORD',
        'USER_NAME',
        'NIF_UTILIZADOR',
        'PASS_UTILIZADOR',
        'EMAIL_UTILIZADOR',
        'VALIDADO',
        'USER_COMMUNICATION_TYPE',
        'USER_BIRTHDATE',
        'USER_COUNTRY_ID',
        'USER_QUALIFICATION_ID',
        'USER_POSTAL_CODE',
        'USER_SOCIAL_SECURITY_NUMBER',
        'USER_SEX',
        'USER_TELEPHONE',
        'USER_DISTRICT_ID',
        'USER_COUNTY_ID',
        'USER_HAS_CAR',
        'USER_HAS_DRIVERS_LICENCE',
        'USER_COMMUNICATION_TYPE',
        'USER_NEWSLETTER',
        'USER_PRIVACY_POLICY',
        'USER_ADDRESS_1',
        'USER_ADDRESS2',
        'EMAIL',
        'USER_SEX',
        'USER_WHATSAPP',
        'USER_LOCAL_ID'
        // 'ID'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'USER_NAME' => 'string',
        'USER_EMAIL'=> 'string',
        'USER_NAME' => 'string',
        'USER_PASSWORD'=> 'string',
        'NIF_UTILIZADOR' => 'string',
        'PASS_UTILIZADOR' => 'string',
        'EMAIL_UTILIZADOR' => 'string',
        'VALIDADO' => 'string',
        'USER_BIRTHDATE' => 'string',
        'USER_COUNTRY_ID' => 'integer',
        'USER_QUALIFICATION_ID' => 'integer',
        'USER_POSTAL_CODE' => 'string',
        'USER_SOCIAL_SECURITY_NUMBER' => 'integer',
        'USER_SEX' => 'string',
        'USER_TELEPHONE' => 'integer',
        'USER_DISTRICT_ID' => 'integer',
        'USER_COUNTY_ID' => 'integer',
        'USER_HAS_CAR' => 'integer',
        'USER_HAS_DRIVERS_LICENCE' => 'integer',
        'USER_COMMUNICATION_TYPE' => 'integer',
        'USER_NEWSLETTER' => 'boolean',
        'USER_PRIVACY_POLICY' => 'boolean',
        'USER_ADDRESS_1' => 'string',
        'USER_ADDRESS_2' => 'string',
        'EMAIL' => 'string',
        'USER_SEX' => 'string',
        'USER_WHATSAPP' => 'string',
        'USER_LOCAL_ID' => 'integer',


        // 'ID' => 'integer',

    ];

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
}
