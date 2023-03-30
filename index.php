<?php
echo "<pre>";
ini_set("display_errors",1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use App\AccountManager;
use App\Transfer;
use App\Withdrawal;
use App\Deposit;

// Create an instance of the AccountManager class
$accountManager = new AccountManager();
/*
// Create a few accounts
$account1 = $accountManager->createAccount(1, 1000);
$account2 = $accountManager->createAccount(2, 500);


// Check the updated balances of both accounts
echo "Account 1 balance before transfer: " . $accountManager->getAccountBalance($account1->getId()) . "\n"; // should output 800
echo "Account 2 balance before transfer: " . $accountManager->getAccountBalance($account2->getId()) . "\n"; // should output 700

//
$transferAmount = 700;

$account1->transfer($account2, $transferAmount,'Transfer from account 1 to account 2' );


// Check the updated balances of both accounts
echo "Account 1 balance: " . $accountManager->getAccountBalance($account1->getId()) . "\n"; // should output 800
echo "Account 2 balance: " . $accountManager->getAccountBalance($account2->getId()) . "\n"; // should output 700


$transfer = new Transfer(10,
    'Transfer from account 1 to account 2',
    new DateTimeImmutable(),
    $account1,
    $account2
);

$transfer->execute($account1);


// Check the updated balances of both accounts
echo "Account 1 balance: " . $accountManager->getAccountBalance($account1->getId()) . "\n"; // should output 800
echo "Account 2 balance: " . $accountManager->getAccountBalance($account2->getId()) . "\n"; // should output 700

//
//die;
// Transfer 200 from account 1 to account 2
$transaction = new Withdrawal(-200, 'Transfer to account 2', new DateTimeImmutable());
$accountManager->performTransaction($transaction, $account1->getId());

// Transfer 200 from account 1 to account 2
$transaction = new Deposit(200, 'Transfer to account 2', new DateTimeImmutable());
$accountManager->performTransaction($transaction, $account2->getId());



// Check the updated balances of both accounts
echo "Account 1 balance: " . $accountManager->getAccountBalance($account1->getId()) . "\n"; // should output 800
echo "Account 2 balance: " . $accountManager->getAccountBalance($account2->getId()) . "\n"; // should output 700
*/

//die;

$accountManager->createAccount(1, 1000);
$accountManager->createAccount(2, 500);
$accountManager->createAccount(3, 2500);

print_r($accountManager->getAllAccounts());
//var_dump($accountManager->getAllAccounts());

$transaction1 = new Withdrawal(1200.0, 'Rent', new DateTimeImmutable());
$transaction2 = new Withdrawal(600.0, 'Rent', new DateTimeImmutable());


$accountManager->performTransaction( $transaction1, 1); // This should fail since the account balance is insufficient.
$accountManager->performTransaction( $transaction1, 2); // This should succeed.

print_r($accountManager->getAllAccounts());


echo "</pre>";




