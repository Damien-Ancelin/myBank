-- Verify myBank:04.create_3nf_remaining_month on pg

BEGIN;

SELECT * FROM "loan" WHERE "remaining_month" IS NOT NULL;

ROLLBACK;
