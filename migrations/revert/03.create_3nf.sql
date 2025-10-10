-- Revert myBank:03.create_3nf from pg

BEGIN;

ALTER TABLE loan
  DROP COLUMN end_date;

COMMIT;
