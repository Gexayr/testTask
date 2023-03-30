<?php
namespace App;

use DateTimeImmutable;

abstract class Transaction
{

    protected float $amount;
    protected string $comment;
    protected DateTimeImmutable $date;

    public function __construct(float $amount, string $comment, DateTimeImmutable $date)
    {
        $this->amount = $amount;
        $this->comment = $comment;
        $this->date = $date;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getdate(): DateTimeImmutable
    {
        return $this->date;
    }

    abstract public function execute(Account $account): bool;
}
