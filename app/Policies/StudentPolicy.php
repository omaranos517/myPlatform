<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\Administrator; // لو المسؤولين موجودين هنا
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(Administrator $user)
    {
        $permissions = json_decode($user->permissions, true);
        return in_array('create_student', $permissions);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Administrator $user, Student $student)
    {
        $permissions = json_decode($user->permissions, true);
        return in_array('update_student', $permissions);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Administrator $user, Student $student)
    {
        $permissions = json_decode($user->permissions, true);
        return in_array('delete_student', $permissions);
    }
}
