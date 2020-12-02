<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\Mixed_;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that should be guarded in mass assignments.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFirstNameAttribute($value) : string
    {
        return ucfirst($value);
    }

    public function setFirstNameAttribute($value) : void
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function getLastNameAttribute($value) : string
    {
        return ucfirst($value);
    }

    public function setLastNameAttribute($value) : void
    {
        $this->attributes['last_name'] = strtolower($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getGenderAttribute($value) : string
    {
        switch ((int)$value)
        {
            case 0:
                return 'Male';
            case 1:
                return 'Female';
            default:
                return '-';
        }
    }

    public function setGenderAttribute($value) : void
    {
        switch (strtolower(trim($value)))
        {
            case 'male':
                $this->attributes['gender'] = 0;
                break;
            case 'female':
                $this->attributes['gender'] = 1;
                break;
            default:
                $this->attributes['gender'] = null;
                break;
        }
    }

    public function getOccupationAttribute($value) : string
    {
        switch ((int)$value)
        {
            case 0:
                return 'Private job';
            case 1:
                return 'Government job';
            case 2:
                return 'Business';
            default:
                return '-';
        }
    }

    public function setOccupationAttribute($value) : void
    {
        switch (strtolower(trim($value)))
        {
            case 'private job':
                $this->attributes['occupation'] = 0;
                break;
            case 'government job':
                $this->attributes['occupation'] = 1;
                break;
            case 'business':
                $this->attributes['occupation'] = 2;
                break;
            default:
                $this->attributes['occupation'] = null;
                break;
        }
    }

    public function getFamilyTypeAttribute($value) : string
    {
        switch ((int)$value)
        {
            case 0:
                return 'Joint family';
            case 1:
                return 'Nuclear family';
            default:
                return '-';
        }
    }

    public function setFamilyTypeAttribute($value) : void
    {
        switch (strtolower(trim($value)))
        {
            case 'joint family':
                $this->attributes['family_type'] = 0;
                break;
            case 'nuclear family':
                $this->attributes['family_type'] = 1;
                break;
            default:
                $this->attributes['family_type'] = null;
                break;
        }
    }

    public function getManglikAttribute($value) : string
    {
        switch ((int)$value)
        {
            case 0:
                return 'No';
            case 1:
                return 'Yes';
            default:
                return '-';
        }
    }

    public function setManglikAttribute($value) : void
    {
        switch (strtolower(trim($value)))
        {
            case 'no':
                $this->attributes['manglik'] = 0;
                break;
            case 'yes':
                $this->attributes['manglik'] = 1;
                break;
            default:
                $this->attributes['manglik'] = null;
                break;
        }
    }

    /**
     * @param string $value
     * @return mixed|null
     */
    public function getExpectedIncomeAttribute($value)
    {
        if ($value !== null) 
            return json_decode($value, true);
        return null;
    }

    public function setExpectedIncomeAttribute($value) : void
    {
        $this->attributes['expected_income'] = $value !== null 
            ? json_encode($value) 
            : null;
    }

    /**
     * @param string $value
     * 
     * @return mixed|null
     */
    public function getExpectedOccupationAttribute($value)
    {
        if ($value !== null)
            return json_decode($value, true);
        return null;
    }

    public function setExpectedOccupationAttribute($value) : void
    {
        $this->attributes['expected_occupation'] = $value !== null ? json_encode($value) : null;
    }

    /**
     * @param string $value
     * @return mixed|null
     */
    public function getExpectedFamilyTypeAttribute($value)
    {
        if ($value !== null)
            return json_decode($value, true);
        return null;
    }

    public function setExpectedFamilyTypeAttribute($value) : void
    {
        $this->attributes['expected_family_type'] = $value !== null ? json_encode($value) : null;
    }

    public function getExpectedManglikAttribute($value) : string
    {
        switch ((int)$value)
        {
            case 0:
                return 'No';
            case 1:
                return 'Yes';
            case 2:
                return 'Both';
            default:
                return '-';
        }
    }

    public function setExpectedManglikAttribute($value) : void
    {
        switch (strtolower(trim($value)))
        {
            case 'no':
                $this->attributes['expected_manglik'] = 0;
                break;
            case 'yes':
                $this->attributes['expected_manglik'] = 1;
                break;
            case 'both':
                $this->attributes['expected_manglik'] = 2;
                break;
            default:
                $this->attributes['expected_manglik'] = null;
                break;
        }
    }
}
