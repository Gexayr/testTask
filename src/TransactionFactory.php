<?php
namespace App;

class TransactionFactory
{
    public static function create(
        string $type,
        float $amount,
        string $comment,
        \DateTimeImmutable $date,
        Account $fromAccount,
        Account $toAccount
    ): Transaction {
        switch ($type) {
            case 'Deposit':
                /** @var \DateTimeImmutable $date */
                return new Deposit($amount, $comment, $date);
            case 'Withdrawal':
                return new Withdrawal($amount, $comment, $date);
            case 'Transfer':
                return new Transfer($amount, $comment, $date, $fromAccount, $toAccount);
            default:
                throw new \Exception("Invalid transaction type.");
        }
    }
}
