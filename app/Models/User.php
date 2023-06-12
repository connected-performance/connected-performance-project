<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;



/**
 * @method static where(string $string, bool $true)
 * @method getProvider($provider)
 * @method providers()
 * @method truncate()
 * @method create(array $array)
 * @method static find($end_by)
 * @property mixed is_admin
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed id
 * @property mixed roles
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use ImageTrait {
        deleteImage as traitDeleteImage;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin'    => 'boolean',
        'is_customer' => 'boolean',
        'is_employee' => 'boolean',
        'is_lead' => 'boolean'
    ];
    public static $PATH = 'users';

    const HEIGHT = 250;

    const WIDTH = 250;
    public function getAvatarAttribute($value)
    {
        if (!empty($value)) {
            return $this->imageUrl(self::$PATH . DIRECTORY_SEPARATOR . $value, $this->storage_disk);
        }
        return asset('images/avatars/male.png');
    }
    public function deleteImage()
    {
        $image = $this->getRawOriginal('avatar');
        if (empty($image)) {
            return true;
        }
        $this->update(['avatar' => null]);
        return $this->traitDeleteImage(self::$PATH . DIRECTORY_SEPARATOR . $image, $this->storage_disk);
    }
    /**
     * Find item by uid.
     *
     * @param $uid
     *
     * @return object
     */
    public static function findByUid($uid): object
    {
        return self::where('uid', $uid)->first();
    }
    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class);
    }

    public function systemJobs(): HasMany
    {
        return $this->hasMany(SystemJob::class)->orderBy('created_at', 'desc');
    }
    /**
     * Check if user has admin account.
     */
    public function isAdmin(): bool
    {
        return 1 == $this->is_admin;
    }

    /**
     * Check if user has admin account.
     */
    public function isCustomer(): bool
    {
        return 1 == $this->is_customer;
    }

    /*
     *  Display User Name
     */
    public function displayName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * generate two factor code
     */
    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    /**
     * Reset two factor code
     */
    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    /**
     * generate two factor backup code
     *
     * @return false|string
     */
    public static function generateTwoFactorBackUpCode()
    {
        $backUpCode = [];
        for ($i = 0; $i < 8; $i++) {
            $backUpCode[] = rand(100000, 999999);
        }

        return json_encode($backUpCode);
    }

    public static function boot()
    {
        parent::boot();

        // Create uid when creating list.
        static::creating(function ($item) {
            // Create new uid
            $uid = uniqid();
            while (self::where('uid', $uid)->count() > 0) {
                $uid = uniqid();
            }
            $item->uid = $uid;

            if (config('app.two_factor')) {
                $item->two_factor_backup_code = self::generateTwoFactorBackUpCode();
            }
        });
    }
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function getCanEditAttribute(): bool
    {
        return 1 === auth()->id();
    }

    public function getCanDeleteAttribute(): bool
    {
        return $this->id !== auth()->id() && (Gate::check('delete customer'));
    }


    public function getIsSuperAdminAttribute(): bool
    {
        return 1 === $this->id;
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasRole($name): bool
    {
        return $this->roles->contains('name', $name);
    }


    /**
     * @return Collection
     */

    public function getPermissions(): Collection
    {
        $permissions = [];

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if (!in_array($permission, $permissions, true)) {
                    $permissions[] = $permission;
                }
            }
        }

        return collect($permissions);
    }

    /**
     * get route key by uid
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    public function hasPermission($permission){
        
        if (in_array($permission, auth()->user()->roles[0]->permissions))
        {
        return  true;
        }
        else
        {
        return false;
        }
    }

    public function employee(){
        return $this->hasOne(Employee::class);
    }

    public function referrals()
    {
        return  $this->hasMany(Customer::class, 'referral_id','id');
        

    }
    public function deals()
    {
        return $this->hasMany(Customer::class,'referral_id', 'id')->where('status','1');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'countrie_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'citie_id');
    }

    public function notifications()
    {
        return $this->hasOne(Notification::class);
    }

    public function user_notifications()
    {
        // return $this->hasManyThrough(Notification::class,UserNotifiction::class,'user_id','id');
        return $this->hasMany(UserNotifiction::class,)->with('notifications');
    }

    public function extra_charge(){
        return $this->hasMany(ExtraCharge::class);
    }
    
}
