<?php

namespace App\Policies;

use App\Models\Gangguan;
use App\Models\User;

class GangguanPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Gangguan $gangguan): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin', 'teknisi', 'user');
    }

    public function update(User $user, Gangguan $gangguan): bool
    {
        return $user->hasRole('admin', 'teknisi');
    }

    public function delete(User $user, Gangguan $gangguan): bool
    {
        return $user->hasRole('admin');
    }
}