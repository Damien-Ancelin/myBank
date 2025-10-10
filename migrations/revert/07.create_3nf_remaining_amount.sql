-- Revert myBank:07.create_3nf_remaining_amount from pg

BEGIN;

DROP FUNCTION calculate_remaining_amount;

ALTER TABLE loan
  DROP COLUMN remaining_amount;

COMMIT;
