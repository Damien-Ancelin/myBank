-- Revert myBank:04.create_3nf_remaining_month from pg

BEGIN;

DROP FUNCTION calculate_remaining_month;

ALTER TABLE loan
  DROP COLUMN remaining_month;

COMMIT;
