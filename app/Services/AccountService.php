<?php

namespace App\Services;

use App\Models\User;

class AccountService {
private User $user;

    function __construct(User $user=null) {        
        $this->user=$user??\Auth::user();
    }

}
