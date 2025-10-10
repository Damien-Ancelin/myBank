dropdb myBank_db
createdb myBank_db
sqitch deploy 01.init_db
sqitch verify 01.init_db
sqitch deploy 02.seeding
sqitch verify 02.seeding
sqitch deploy 03.create_3nf
sqitch verify 03.create_3nf
sqitch deploy 04.create_3nf_remaining_month
sqitch verify 04.create_3nf_remaining_month
sqitch deploy 05.create_3fn_total_payment
sqitch verify 05.create_3fn_total_payment
sqitch deploy 06.create_3fn_monthly_payment
sqitch verify 06.create_3fn_monthly_payment
sqitch deploy 07.create_3nf_remaining_amount
sqitch verify 07.create_3nf_remaining_amount