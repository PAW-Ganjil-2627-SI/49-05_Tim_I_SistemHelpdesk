<?php

namespace App\Policies;

use App\Models\FAQ;
use App\Models\User;

class FAQPolicy
{
    public function update(User $user, FAQ $faq): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        // Teknisi hanya boleh mengubah artikel yang statusnya belum Published (Draft)
        return $user->hasRole('teknisi') && $faq->status !== 'Published';
    }

    public function delete(User $user, FAQ $faq): bool
    {
        return $user->hasRole('admin');
    }
}