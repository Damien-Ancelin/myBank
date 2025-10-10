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