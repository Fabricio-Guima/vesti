<?php

namespace App\Policies;

use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class ImagePolicy
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

    public function view(User $user, Image $image){        

        return $user->id === $image->product->user_id;

    }

    public function update(User $user, Image $image){        

        return $user->id === $image->product->user_id;

    }

    public function destroy(User $user, Image $image){        

        return $user->id === $image->product->user_id;

    }

    public function addPhotos(User $user, Image $image){        

        return $user->id === $image->product->user_id;

    }
}
