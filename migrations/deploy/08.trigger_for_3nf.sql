-- Deploy myBank:08.trigger_for_3nf to pg

BEGIN;

CREATE VIEW loan_summary AS
  SELECT
      loan.id,
      loan.amount,
      loan.interest_rate,
      loan.start_date,
      loan.duration,
      loan.status,
      loan.user_id,
      loan.created_at,
      loan.updated_at,
      calculate_end_date(loan.id) AS end_date,
      calculate_remaining_month(loan.id) AS remaining_month,
      calculate_total_payment(loan.id)::DECIMAL(12,2) AS total_payment,
      calculate_monthly_payment(loan.id)::DECIMAL(12,2) AS monthly_payment,
      calculate_remaining_amount(loan.id)::DECIMAL(12,2) AS remaining_amount
  FROM loan;
  
COMMIT;
