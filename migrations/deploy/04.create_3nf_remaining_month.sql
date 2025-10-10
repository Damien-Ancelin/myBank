-- Deploy myBank:04.create_3nf_remaining_month to pg

BEGIN;

ALTER TABLE "loan"
  ADD COLUMN "remaining_month" INT;

-- AGE extract interval between two dates (format => x year, x month, x day)
-- DATE_PART target year, multiply by number of month in one year, or month to get only the number of month

UPDATE "loan"
  SET "remaining_month" = (DATE_PART('year', AGE("end_date", NOW())) * 12 +
   DATE_PART('month', AGE("end_date", NOW()))
  )::INT;

COMMIT;
