<?php
namespace App;

use DateTimeImmutable;

class Transfer extends Transaction
{
    private Account $fromAccount;
    private Account $toAccount;

    public function __construct(
        float $amount,
        string $comment,
        DateTimeImmutable $date,
        Account $fromAccount,
        Account $toAccount
    ) {
        parent::__construct($amount, $comment, $date);
        $this->fromAccount = $fromAccount;
        $this->toAccount = $toAccount;
    }

    public function execute(Account $account): bool
    {
        $withdrawal = new Withdrawal(-$this->amount, $this->comment, $this->date);
        $deposit = new Deposit($this->amount, $this->comment, $this->date);

        if ($this->fromAccount->performTransaction($withdrawal) && $this->toAccount->performTransaction($deposit)) {
            return true;
        } else {
            // If either transaction fails, roll back the other transaction
            $this->toAccount->performTransaction(new Withdrawal($this->amount, $this->comment, $this->date));
            return false;
        }
    }
}
