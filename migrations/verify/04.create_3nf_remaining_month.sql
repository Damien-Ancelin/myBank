-- Verify myBank:04.create_3nf_remaining_month on pg

BEGIN;

SELECT "remaining_month" FROM loan;

ROLLBACK;
