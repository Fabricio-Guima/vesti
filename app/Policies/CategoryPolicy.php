<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Category $category){        

        return $user->id === $category->user_id;

    }

    public function update(User $user, Category $category){        

        return $user->id === $category->user_id;

    }

    public function destroy(User $user, Category $category){        

        return $user->id === $category->user_id;

    }

    public function addCategory(User $user, Category $category){        

        return $user->id === $category->user_id;

    }
}
