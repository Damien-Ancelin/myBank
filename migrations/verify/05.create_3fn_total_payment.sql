-- Verify myBank:05.create_3fn_total_payment on pg

BEGIN;

SELECT * FROM "loan" WHERE "total_payment" IS NOT NULL;

ROLLBACK;
