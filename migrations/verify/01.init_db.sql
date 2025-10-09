-- Verify myBank:01.init_db on pg

BEGIN;

SELECT * FROM "transaction" LIMIT 1;
SELECT * FROM "loan" LIMIT 1;
SELECT * FROM "account" LIMIT 1;
SELECT * FROM "app_user" LIMIT 1;
SELECT * FROM "counterparty" LIMIT 1;
SELECT * FROM "category" LIMIT 1;
SELECT * FROM "operation_type" LIMIT 1;

ROLLBACK;
