# Financial transactions system

This project implements a set of classes for managing financial operations of an account, including deposits, withdrawals, and transfers. The project follows SOLID and GRASP principles and uses design patterns such as the Factory Method, Strategy, and Singleton.


## Prerequisites
PHP 7.0 or higher
phpstan, phpcs analyzers

## Installation

To use this project, clone the repository and include the necessary files in your PHP project.

## Usage

To use the application, create an instance of the AccountManager class and use the methods to manage accounts and transactions. Here are the available methods.
And the project includes the following methods:

- `createAccount($accountNumber, $initialBalance = 0)`: creates a new account with the specified account number and initial balance. Returns the new account object.
- `findAccount($accountNumber)`: finds an account by its account number. Returns the account object or null if not found.
- `getAllAccounts()`: returns an array of all accounts in the system.
- `getAccountBalance($accountNumber)`: gets the current balance of the specified account.
- `performTransaction($transaction, $accountNumber)`: performs a transaction on the specified account.
- `getAccountTransactionsByComment($accountNumber)`: gets all transactions for the specified account, sorted by comment in alphabetical order.
- `getAccountTransactionsByDate($accountNumber)`: gets all transactions for the specified account, sorted by date.

- `getBalance($accountId)`: returns the balance of a specific account
- `getAllTransactionsSortedByComment($accountId)`: returns all transactions for a specific account sorted by comment
- `getAllTransactionsSortedByDate($accountId)`: returns all transactions for a specific account sorted by date

### Example usage:
```
$accountManager = new AccountManager();
$account = $accountManager->createAccount('12345', 100);
$transaction = TransactionFactory::createWithdrawal(50, 'ATM withdrawal');
$accountManager->performTransaction($transaction, $account->getId());
$balance = $accountManager->getBalance($account->getId());
$transactionsByComment = $accountManager->getAllTransactionsSortedByComment($account->getId());
$transactionsByDate = $accountManager->getAllTransactionsSortedByDate($account->getId());
```

## Design Patterns
The following design patterns were used in this application:

- Factory Pattern: Used in the TransactionFactory class to create different types of transactions without exposing the creation logic to the client code.
- Repository Pattern: Used in the AccountManager class to provide a way to manage and store accounts.
- Strategy Pattern: Used in the Transaction class to implement different types of transactions (deposit, withdrawal, transfer) as separate strategies.

### SOLID Principles

#### Single Responsibility Principle (SRP)

Each class in this system has a single responsibility. The `Account` class is responsible for maintaining account information and performing transactions. The `Transaction` class is responsible for representing a financial transaction. The `TransactionFactory` class is responsible for creating new transaction objects. This ensures that each class has only one reason to change, making the code easier to maintain and modify.

#### Open-Closed Principle (OCP)

This principle states that classes should be open for extension but closed for modification. The system is designed to allow for the addition of new transaction types by creating new concrete transaction classes that inherit from the `Transaction` class. The `TransactionFactory` class can create instances of these new classes without needing to modify any existing code.

#### Liskov Substitution Principle (LSP)

This principle states that subtypes should be able to be substituted for their parent types without affecting the correctness of the program. The concrete transaction classes (`Deposit`, `Withdrawal`, `Transfer`) can be substituted for their parent type (`Transaction`) without affecting the correctness of the `Account` class or any other parts of the system.

#### Interface Segregation Principle (ISP)

This principle states that classes should not be forced to depend on interfaces they do not use. There are no interfaces used in this system, but the `Transaction` class is an abstract class that defines the methods that all transaction types must implement. This ensures that only the necessary methods are defined for each transaction type.

#### Dependency Inversion Principle (DIP)

This principle states that high-level modules should not depend on low-level modules; both should depend on abstractions. In this system, the `Account` class depends on the `Transaction` class, but it does not depend on any concrete transaction classes. The `TransactionFactory` class depends on the `Transaction` class` and the `TransactionType` enum, but it does not depend on any concrete transaction classes. This allows for greater flexibility and extensibility in the system.


## Code quality check:

The code has been analyzed using the following tools:

- PHPStan - a static analysis tool that checks for potential errors in PHP code.
- PHP_CodeSniffer (PHPCS) - a set of rules to check the coding standard of your PHP code.

To run the code quality check, you can use the following commands:
````
vendor/bin/phpstan analyze

vendor/bin/phpcs
