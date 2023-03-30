<?php
namespace App;

class Withdrawal extends Transaction
{
    public function execute(Account $account): bool
    {
        if ($account->getBalance() >= $this->amount) {
            $account->performTransaction($this);
            return true;
        } else {
            return false;
//            throw new Exception("Insufficient balance.");
        }
    }
}
