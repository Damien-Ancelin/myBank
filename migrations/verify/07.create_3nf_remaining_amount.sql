-- Verify myBank:07.create_3nf_remaining_amount on pg

BEGIN;

SELECT * FROM "loan" WHERE "remaining_amount" IS NOT NULL;

ROLLBACK;
