-- Revert myBank:03.create_3nf from pg

BEGIN;

DROP FUNCTION calculate_end_date;

ALTER TABLE loan
  DROP COLUMN end_date;

COMMIT;
