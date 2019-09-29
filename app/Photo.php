<?php

namespace App; /* Part 14 */

use Illuminate\Database\Eloquent\Model; /* Part 14 */

/* Part 14 */
class Photo extends Model
{

    public $timestamps = false; /* Part 40 */

    /* Part 14 */
    public function photoable()
    {
        return $this->morphTo();
    }

    /* Part 40 */
    public function getPathAttribute($value)
    {
        return asset("storage/{$value}");
    }


    /* Part 40 */
    public function getStoragepathAttribute()
    {
        return $this->original['path'];
    }

    /* Part 43 */
    public static function imageRules($request,$type)
    {
        for ( $i = 0; $i <= count($request->file($type))-1 ; $i++ )
        {
            $rules["$type.$i"] = 'image|max:4000';
        }

        return $rules;
    }


}
