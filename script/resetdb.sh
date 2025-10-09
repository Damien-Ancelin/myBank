dropdb myBank_db
createdb myBank_db
sqitch deploy 01.init_db
sqitch verify 01.init_db