<?php
/**
 * Created by PhpStorm.
 * User: sunqiang
 * Date: 2018/11/15
 * Time: 5:49 PM
 */

namespace App\Services;


use App\Contracts\BillerInterface;
use App\Contracts\BillingNotifierInterface;

class StripeBiller implements BillerInterface
{
    private $notifier;

    public function __construct(BillingNotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function bill(array $user, $amount)
    {
        // Bill the user via Stripe...
        $this->notifier->notify($user, $amount);
    }
}