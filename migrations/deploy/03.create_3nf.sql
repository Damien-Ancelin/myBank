-- Deploy myBank:03.create_3nf to pg

BEGIN;

-- ADD & UPDATE Column

ALTER TABLE "loan"
  ADD COLUMN "end_date" TIMESTAMPTZ;

UPDATE "loan"
  SET "end_date" = "start_date" + ("duration" || ' months')::INTERVAL;

COMMIT;
