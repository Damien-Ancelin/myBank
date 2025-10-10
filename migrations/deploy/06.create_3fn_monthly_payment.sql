-- Deploy myBank:06.create_3fn_monthly_payment to pg

BEGIN;

ALTER TABLE "loan"
  ADD COLUMN "monthly_payment" DECIMAL(12, 2);

CREATE FUNCTION calculate_monthly_payment(loan_id INT)
RETURNS DECIMAL(12, 2) AS $$
  BEGIN
    RETURN (
      SELECT calculate_total_payment(loan_id) / loan.duration
      FROM "loan"
      WHERE "id" = loan_id
    );
  END;
$$ LANGUAGE plpgsql;

UPDATE "loan"
  SET "monthly_payment" = calculate_monthly_payment("id");

COMMIT;
