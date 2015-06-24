<?php namespace App;

//use App\Commands\SortableTrait;
use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;//, SortableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdministrator()
    {

        if (Auth::user()->role == 4) {
            return true;
        }

        return false;
    }

    public function isAuthor()
    {

        if (Auth::user()->role == 1) {
            return true;
        }

        return false;
    }

    public function isEditor()
    {

        if (Auth::user()->role == 2) {
            return true;
        }

        return false;
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project');

    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function institution()
    {
        return $this->belongsTo('App\Institution');
    }

    public static function get_roles()
    {
        return ['1' => 'Autor', '2' => 'Editor', '4' => 'Administrador'];
    }

    public static function get_status()
    {
        return ['0' => 'Desactivo', '1' => 'Activo'];
    }

}
