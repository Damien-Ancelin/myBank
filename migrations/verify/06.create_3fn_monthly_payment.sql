-- Verify myBank:06.create_3fn_monthly_payment on pg

BEGIN;

SELECT * FROM "loan" WHERE "monthly_payment" IS NOT NULL;

ROLLBACK;
