-- Revert myBank:06.create_3fn_monthly_payment from pg

BEGIN;

DROP FUNCTION calculate_monthly_payment;

ALTER TABLE loan
  DROP COLUMN monthly_payment;

COMMIT;
