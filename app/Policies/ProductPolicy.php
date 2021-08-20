<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
       
    }

    public function allProducts(User $user, Product $product){        

        return $user->id === $product->user_id;

    }

    public function view(User $user, Product $product){        

        return $user->id === $product->user_id;

    }

    public function update(User $user, Product $product){        

        return $user->id === $product->user_id;

    }

    public function destroy(User $user, Product $product){        

        return $user->id === $product->user_id;

    }

    public function addCategory(User $user, Product $product){        

        return $user->id === $product->user_id;

    }
}
