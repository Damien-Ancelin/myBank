-- Verify myBank:08.trigger_for_3nf on pg

BEGIN;

SELECT * FROM loan_summary WHERE false;

ROLLBACK;
