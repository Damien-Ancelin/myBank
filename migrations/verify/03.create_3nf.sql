-- Verify myBank:03.create_3nf on pg

BEGIN;

SELECT * FROM "loan" WHERE "end_date" IS NOT NULL;

ROLLBACK;
