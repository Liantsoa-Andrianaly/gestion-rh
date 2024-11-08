<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;

class PaymentPolicy
{
    /**
     * Determine whether the user can view the payment.
     */
    public function view(User $user, Payment $payment)
    {
        // Logique pour vérifier si l'utilisateur peut voir le paiement
        return $user->id === $payment->employe_id; // Exemple de condition
    }
}

