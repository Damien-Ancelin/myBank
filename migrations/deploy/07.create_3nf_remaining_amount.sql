-- Deploy myBank:07.create_3nf_remaining_amount to pg

BEGIN;

ALTER TABLE "loan"
  ADD COLUMN "remaining_amount" DECIMAL(12, 2);

CREATE FUNCTION calculate_remaining_amount(loan_id INT)
RETURNS DECIMAL(12, 2) AS $$
  BEGIN
    RETURN (
      SELECT calculate_remaining_month(loan_id) * calculate_monthly_payment(loan_id)
    );
  END;
$$ LANGUAGE plpgsql;

UPDATE "loan"
  SET "remaining_amount" = calculate_remaining_amount("id");


COMMIT;
