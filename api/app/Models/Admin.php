<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\Filterable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory,
        HasApiTokens,
        Notifiable,
        SoftDeletes,
        // LogsActivity,
        Filterable;

    const INACTIVE = 0;
    const ACTIVE = 1;
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'verify_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'module' => 'admin',
        ];
    }
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
}
