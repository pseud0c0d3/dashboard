<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the user can delete the reply.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Reply  $reply
     * @return bool
     */
    public function delete(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;  // Only allow if the user is the owner of the reply
    }
}
