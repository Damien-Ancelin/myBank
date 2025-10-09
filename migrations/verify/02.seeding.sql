-- Verify myBank:02.seeding on pg

BEGIN;

SELECT "email" FROM "app_user" WHERE "email" = 'alice@example.com';
SELECT "IBAN" FROM "account" WHERE "IBAN" = 'FR7612345678901234567890123';
SELECT "name" FROM "category" WHERE "name" = 'Alimentation';
SELECT "name" FROM "operation_type" WHERE "name" = 'Dépense';
SELECT "IBAN" FROM "counterparty" WHERE "IBAN" = 'DE89370400440532013000';
SELECT "amount", "interest_rate", "duration", "status" FROM "loan" WHERE "user_id" = 1;

ROLLBACK;
