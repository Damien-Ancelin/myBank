-- Deploy myBank:01.init_db to pg

BEGIN;

-- ? DOMAINS
CREATE DOMAIN "email" AS text
CHECK(
    value ~ '(?:[a-z0-9!#$%&''*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&''*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])'
);

CREATE DOMAIN "unsigned_decimal" AS DECIMAL(12, 2)
CHECK (value >= 0);

CREATE DOMAIN "loan_status_enum" AS TEXT
CHECK (value IN ('pending', 'active', 'paid'));

CREATE DOMAIN "account_status_enum" AS TEXT
CHECK (value IN ('active', 'closed', 'frozen'));

CREATE DOMAIN "transaction_status_enum" AS TEXT
CHECK (value IN ('pending', 'completed', 'failed'));

CREATE DOMAIN "positive_rate" AS DECIMAL(5, 2)
CHECK (value >= 0 AND value <= 100);

CREATE DOMAIN "account_type_enum" AS TEXT
CHECK (value IN ('savings', 'checking', 'joint', 'business'));

-- ? TABLES
CREATE TABLE "app_user" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "email" email NOT NULL UNIQUE,
  "password" TEXT NOT NULL,
  "firstname" TEXT NOT NULL,
  "lastname" TEXT NOT NULL,
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

CREATE TABLE "loan" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "amount" unsigned_decimal NOT NULL,
  "interest_rate" positive_rate NOT NULL,
  "start_date" TIMESTAMPTZ NOT NULL,
  "duration" INT NOT NULL,
  "status" loan_status_enum NOT NULL DEFAULT 'pending',
  "user_id" INT NOT NULL REFERENCES "app_user"("id") ON DELETE CASCADE,
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

CREATE TABLE "account" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "IBAN" VARCHAR(34) NOT NULL UNIQUE,
  "interest_rate" positive_rate NOT NULL DEFAULT 0,
  "account_type" account_type_enum NOT NULL DEFAULT 'checking',
  "currency" CHAR(3) NOT NULL DEFAULT 'EUR',
  "limit" unsigned_decimal NOT NULL,
  "start_date" TIMESTAMPTZ NOT NULL,
  "balance" unsigned_decimal NOT NULL DEFAULT 0,
  "status" account_status_enum NOT NULL DEFAULT 'active',
  "user_id" INT NOT NULL REFERENCES "app_user"("id") ON DELETE CASCADE,
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

CREATE TABLE "counterparty" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "IBAN" VARCHAR(34) NOT NULL UNIQUE,
  "BIC" VARCHAR(11),
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

CREATE TABLE "category" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "name" TEXT NOT NULL UNIQUE,
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

CREATE TABLE "operation_type" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "name" TEXT NOT NULL UNIQUE,
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

CREATE TABLE "transaction" (
  "id" INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  "label" TEXT NOT NULL,
  "amount" unsigned_decimal NOT NULL,
  "status" transaction_status_enum NOT NULL DEFAULT 'pending',
  "user_id" INT NOT NULL REFERENCES "app_user"("id") ON DELETE CASCADE,
  "loan_id" INT REFERENCES "loan"("id") ON DELETE SET NULL,
  "account_id" INT NOT NULL REFERENCES "account"("id") ON DELETE CASCADE,
  "counterparty_id" INT REFERENCES "counterparty"("id") ON DELETE SET NULL,
  "category_id" INT REFERENCES "category"("id") ON DELETE SET NULL,
  "operation_type_id" INT REFERENCES "operation_type"("id") ON DELETE SET NULL,
  "created_at" TIMESTAMPTZ NOT NULL DEFAULT now(),
  "updated_at" TIMESTAMPTZ
);

COMMIT;
