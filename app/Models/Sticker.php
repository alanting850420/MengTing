<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   * @property varchar $name name
* @property int $counts counts
* @property timestamp $created_at created at
* @property timestamp $updated_at updated at
   * @method \Illuminate\Database\Eloquent\Builder name(varchar $name)name
* @method \Illuminate\Database\Eloquent\Builder count(int $counts)counts
* @method \Illuminate\Database\Eloquent\Builder createdAt(timestamp $created_at)created at
* @method \Illuminate\Database\Eloquent\Builder updatedAt(timestamp $updated_at)updated at
 * @method static where(string $string,String $name)
 */
class Sticker extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'stickers';
    /**
    * Protected columns from mass assignment
    */
    protected $guarded=['id'];


    /**
    * Date time columns.
    */
    protected $dates=[];

    /**
    * name column mutator.
    */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = htmlspecialchars($value);
    }


    /**
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param $name
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    /**
    *
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param $counts
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeCounts($query, $counts)
    {
        return $query->where('counts', $counts);
    }

    /**
    * Table wise search
    * @param \Illuminate\Database\Eloquent\Builder $query
    * @param $q
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeQ($query, $q)
    {
        return $query->where(function($sq)use($q){
        $sq	->orWhere('counts',$q)

	->orWhere('name','LIKE','%'.$q.'%')
;
        });
    }
}