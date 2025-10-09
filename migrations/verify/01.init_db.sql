-- Verify myBank:01.init_db on pg

BEGIN;

SELECT * FROM "transaction" WHERE false;
SELECT * FROM "loan" WHERE false;
SELECT * FROM "account" WHERE false;
SELECT * FROM "app_user" WHERE false;
SELECT * FROM "counterparty" WHERE false;
SELECT * FROM "category" WHERE false;
SELECT * FROM "operation_type" WHERE false;

ROLLBACK;
