<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSubject
 *
 * @mixin \Eloquent
 */
class UserSubject extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject_user';

    /**
     * The timestamps.
     *
     * @var bool
     */
    public $timestamps = false;


}
