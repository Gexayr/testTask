<?php

namespace App;

use http\Exception\InvalidArgumentException;
use DateTimeImmutable;

class Account
{
    private int $id;
    private float $balance;
    /** @var Transaction[] */
    private array $transactions;

    public function __construct(float $balance, int $id = null)
    {
        $this->id = $id;
        $this->balance = $balance;
        $this->transactions = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function performTransaction(Transaction $transaction): bool
    {
        try {
            $this->transactions[] = $transaction;
            $this->balance += $transaction->getAmount();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return Transaction[]
     */
    public function getAllTransactionsSortedByComment(): array
    {
        usort($this->transactions, function ($a, $b) {
            return strcmp($a->getComment(), $b->getComment());
        });
        return $this->transactions;
    }

    /**
     * @return Transaction[]
     */
    public function getAllTransactionsSortedByDate(): array
    {
        usort($this->transactions, function ($a, $b) {
            return $a->getDate() <=> $b->getDate();
        });
        return $this->transactions;
    }

    /**
     * @return Account[]
     */
    public static function getAllAccounts(): array
    {
        // Return all accounts in the system
        return [
            new Account(0, 1),
            new Account(100, 2),
            new Account(500, 3),
        ];
    }

//    if need to make transfer from account
    public function withdraw(float $amount, string $comment, DateTimeImmutable $date): void
    {
        $transaction = new Withdrawal(-$amount, $comment, $date);
        $this->performTransaction($transaction);
    }

    public function deposit(float $amount, string $comment, DateTimeImmutable $date): void
    {
        $transaction = new Deposit($amount, $comment, $date);
        $this->performTransaction($transaction);
    }

    public function transfer(Account $to, float $amount, string $comment = ''): void
    {

        if ($this === $to) {
            throw new InvalidArgumentException('Cannot transfer to the same account');
        }

        if ($amount <= 0) {
            throw new InvalidArgumentException('Transfer amount must be positive');
        }

        $this->withdraw($amount, "Transfer to {$to->getId()}", new DateTimeImmutable());
        $to->deposit($amount, "Transfer from {$this->getId()}", new DateTimeImmutable());
    }
}
