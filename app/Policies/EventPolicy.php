<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function create(?User $user): bool
    {
        return $user?->role === 'admin';
    }

    public function view(?User $user, Event $event): bool
    {
        return true;
    }

    public function update(?User $user, Event $event): bool
    {
        return $user?->role === 'admin';
    }

    public function delete(?User $user, Event $event): bool
    {
        return $user?->role === 'admin';
    }
}
