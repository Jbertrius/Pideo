<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \App\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSubject
 *
 */
	class UserSubject extends \Eloquent {}
}

