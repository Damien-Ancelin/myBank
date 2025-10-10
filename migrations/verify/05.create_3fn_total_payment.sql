-- Verify myBank:05.create_3fn_total_payment on pg

BEGIN;

SELECT "total_payment" FROM loan;

ROLLBACK;
