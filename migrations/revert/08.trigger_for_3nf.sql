-- Revert myBank:08.trigger_for_3nf from pg

BEGIN;

DROP VIEW loan_summary;

COMMIT;
