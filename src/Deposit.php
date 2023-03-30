<?php

namespace App;

class Deposit extends Transaction
{
    public function execute(Account $account): bool
    {
        $account->performTransaction($this);

        return true;
    }
}
