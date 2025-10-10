-- Deploy myBank:05.create_3fn_total_payment to pg

BEGIN;

ALTER TABLE "loan"
  ADD COLUMN "total_payment" DECIMAL(12, 2);

UPDATE "loan"
  SET "total_payment" = "amount" + ("amount" * "interest_rate" / 100 * ("duration" / 12.0));

COMMIT;
