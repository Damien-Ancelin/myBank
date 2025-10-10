-- Deploy myBank:02.seeding to pg

BEGIN;

-- 1️⃣ Utilisateurs
INSERT INTO app_user ("email", "password", "firstname", "lastname")
VALUES
('alice@example.com', 'test', 'Alice', 'Martin'),
('bob@example.com', 'test', 'Bob', 'Dupont'),
('carol@example.com', 'test', 'Carol', 'Moreau');

-- 2️⃣ Comptes
INSERT INTO account ("IBAN", "interest_rate", "account_type", "currency", "limit", "start_date", "balance", "user_id")
VALUES
('FR7612345678901234567890123', 0.0, 'checking', 'EUR', 1000, NOW() - INTERVAL '6 months', 500, 1),
('FR7612345678901234567890124', 5.25, 'savings', 'EUR', 5000, NOW() - INTERVAL '4 months', 1500, 1),
('FR7612345678901234567890125', 0.0, 'checking', 'EUR', 2000, NOW() - INTERVAL '10 months', 800, 2),
('FR7612345678901234567890126', 2.5, 'savings', 'EUR', 3000, NOW() - INTERVAL '2 years', 1200, 3);

-- 3️⃣ Tiers
INSERT INTO counterparty ("IBAN", "BIC")
VALUES
('DE89370400440532013000', 'DEUTDEFF'),
('GB29NWBK60161331926819', 'NWBKGB2L'),
('ES9121000418450200051332', 'CAIXESBB'),
('FR1420041010050500013M02606', 'PSSTFRPPMON');

-- 4️⃣ Catégories
INSERT INTO category ("name")
VALUES
('Alimentation'),
('Loyer'),
('Factures'),
('Divertissement'),
('Salaire'),
('Transports'),
('Santé'),
('Voyages'),
('Cadeaux'),
('Remboursement'),
('Épargne'),
('Impôts');

-- 5️⃣ Types d'opération
INSERT INTO operation_type ("name")
VALUES
('Dépense'),
('Crédit'),
('Virement'),
('Prélèvement'),
('Remboursement'),
('Retrait'),
('Dépôt');

-- 6️⃣ Prêts
INSERT INTO loan ("amount", "interest_rate", "start_date", "duration", "status", "user_id")
VALUES
(1000, 5.0, NOW() - INTERVAL '6 months', 12, 'active', 1),
(5000, 3.5, NOW() - INTERVAL '3 months', 24, 'pending', 2),
(2500, 4.2, NOW() - INTERVAL '1 year', 36, 'active', 3),
(800, 6.0, NOW() - INTERVAL '2 months', 10, 'pending', 1),
(12000, 2.9, NOW() - INTERVAL '2 years', 60, 'active', 2),
(300, 7.5, NOW() - INTERVAL '15 days', 6, 'pending', 3),
(4500, 3.8, NOW() - INTERVAL '8 months', 24, 'active', 1);

-- 7️⃣ Transactions
INSERT INTO "transaction" ("label", "amount", "status", "user_id", "account_id", "counterparty_id", "category_id", "operation_type_id")
VALUES
('Salaire Octobre', 2500, 'completed', 1, 1, 3, 5, 2),
('Loyer Octobre', 800, 'completed', 1, 1, 2, 2, 1),
('Courses alimentaires', 120, 'completed', 1, 2, 1, 1, 1),
('Soirée cinéma', 40, 'completed', 3, 4, 3, 4, 1),
('Facture électricité', 60, 'completed', 2, 3, 1, 3, 1),
('Remboursement prêt', 100, 'pending', 1, 1, NULL, 10, 5),
('Achat médicaments', 35, 'completed', 2, 3, NULL, 7, 1),
('Abonnement transport', 50, 'completed', 1, 2, NULL, 6, 1),
('Cadeau anniversaire', 70, 'completed', 3, 4, NULL, 9, 1),
('Virement vacances', 500, 'completed', 1, 1, 4, 8, 3),
('Dépôt épargne', 200, 'completed', 2, 3, NULL, 11, 7),
('Prélèvement impôts', 150, 'completed', 1, 1, NULL, 12, 4);

COMMIT;
