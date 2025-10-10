-- Verify myBank:03.create_3nf on pg

BEGIN;

SELECT "end_date" FROM loan;

ROLLBACK;
