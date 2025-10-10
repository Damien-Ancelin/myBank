-- Deploy myBank:03.create_3nf to pg

BEGIN;

-- ADD & UPDATE Column

ALTER TABLE "loan"
  ADD COLUMN "end_date" TIMESTAMPTZ;

CREATE FUNCTION calculate_end_date(loan_id INT)
RETURNS TIMESTAMPTZ AS $$
  BEGIN
    RETURN (SELECT loan.start_date + (loan.duration || ' months')::INTERVAL
      FROM "loan"
      WHERE "id" = loan_id);
  END;
$$ LANGUAGE plpgsql;

UPDATE "loan"
  SET "end_date" = calculate_end_date("id");

COMMIT;
