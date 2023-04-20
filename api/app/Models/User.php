<?php

namespace App\Models;

use App\Lib\Helpers;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customer\Contracts\MustVerify;
use Modules\Customer\Scopes\UserScope;
use Illuminate\Contracts\Translation\HasLocalePreference;
use App\Scopes\Filterable;

class User extends Authenticatable implements JWTSubject, MustVerify, HasLocalePreference
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use HasApiTokens;
    use UserScope;
    use Filterable;

    const INACTIVE = 0;
    const ACTIVE = 1;
    const PENDING_EMAIL = 2;
    const PENDING_PHONE = 3;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'verify_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
            'module' => 'user',
        ];
    }
    /**
     * getTableName
     *
     * @return String
     */
    public function getTableName()
    {
        return $this->getTable() . '.';
    }

    /**
     * getTableColumns
     *
     * @return void
     */
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * hasVerified
     *
     * @return Boolean
     */
    public function hasVerified()
    {
        if (empty($this->email_verified_at) || empty($this->phone_verified_at)) {
            return false;
        }
        return true;
    }
    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        $locale = Helpers::getLocaleFromTimezone($this->timezone);
        if (in_array($locale, ACCEPT_LOCALES)) {
            return $locale;
        }
        return 'en';
    }
}
