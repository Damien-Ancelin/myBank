-- Revert myBank:01.init_db from pg

BEGIN;

DROP TABLE "transaction";
DROP TABLE "loan";
DROP TABLE "account";
DROP TABLE "app_user";
DROP TABLE "counterparty";
DROP TABLE "category";
DROP TABLE "operation_type";
DROP DOMAIN email;
DROP DOMAIN unsigned_decimal;
DROP DOMAIN loan_status_enum;
DROP DOMAIN account_status_enum;
DROP DOMAIN transaction_status_enum;
DROP DOMAIN positive_rate;
DROP DOMAIN account_type_enum;


COMMIT;
