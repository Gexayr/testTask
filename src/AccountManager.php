<?php

namespace App;

class AccountManager
{
    /** @var Account[] */
    private array $accounts;

    public function __construct()
    {
        $this->accounts = [];
    }

    public function createAccount(int $id, float $balance = 0): Account
    {
        $account = new Account($balance, $id);
        $this->accounts[] = $account;
        return $account;
    }

    public function findAccount(int $id): ?Account
    {
        foreach ($this->accounts as $account) {
            if ($account->getId() == $id) {
                return $account;
            }
        }
        return null;
    }

    /**
     * @return Account[]
     */
    public function getAllAccounts(): array
    {
        return $this->accounts;
    }

    public function getAccountBalance(int $id): ?float
    {
        $account = $this->findAccount($id);
        return $account ? $account->getBalance() : null;
    }

    public function performTransaction(Transaction $transaction, int $id): bool
    {
        try {
            $account = $this->findAccount($id);
            if ($account) {
                $account->performTransaction($transaction);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param int $id
     * @return Transaction[]
     */
    public function getAccountTransactionsByComment(int $id): array
    {
        $account = $this->findAccount($id);
        return $account ? $account->getAllTransactionsSortedByComment() : [];
    }

/**
     * @param int $id
     * @return Transaction[]
     */
    public function getAccountTransactionsByDate(int $id): array
    {
        $account = $this->findAccount($id);

        return $account ? $account->getAllTransactionsSortedByDate() : [];
    }
}
