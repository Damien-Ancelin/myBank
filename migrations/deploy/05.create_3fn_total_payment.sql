-- Deploy myBank:05.create_3fn_total_payment to pg

BEGIN;

ALTER TABLE "loan"
  ADD COLUMN "total_payment" DECIMAL(12, 2);

CREATE FUNCTION calculate_total_payment(loan_id INT)
RETURNS DECIMAL(12, 2) AS $$
  BEGIN
    RETURN (SELECT loan.amount + (loan.amount * loan.interest_rate / 100 * (loan.duration / 12.0))
      FROM "loan"
      WHERE "id" = loan_id);
  END;
$$ LANGUAGE plpgsql;

UPDATE "loan"
  SET "total_payment" = calculate_total_payment("id");

COMMIT;
