-- Revert myBank:05.create_3fn_total_payment from pg

BEGIN;

DROP FUNCTION calculate_total_payment;

ALTER TABLE loan
  DROP COLUMN total_payment;

COMMIT;
