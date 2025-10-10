-- Revert myBank:05.create_3fn_total_payment from pg

BEGIN;

DROP COLUMN total_payment;

COMMIT;
