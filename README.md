# myBank 🏦

A simple banking application backend to manage accounts, loans, and transactions.

## Project Overview 📄

This project provides a PostgreSQL database schema and migration system for a banking application. It allows you to track user accounts, loans, and transactions. The migrations are managed with [Sqitch](https://sqitch.org/).

## Features ✨

- 👤 User management
- 💳 Account management (checking, savings, etc.)
- 💸 Loan tracking
- 📈 Transaction history
- 🏷️ Category and operation types

## Tech Stack 🛠️

- 🐘 PostgreSQL
- 🦑 Sqitch (database migrations)
- 🐘 PHP (for the application logic, not included here)

## Getting Started 🚀

### Setting up a Local Dev Environment ⚙️

> *Environment variables in Linux are variables that store configuration. Each time you start a shell session, the system loads these variables from config files to set up your environment.*

#### 🐘 PostgreSQL expects environment variables (like PGUSER) to be set in your Linux environment (e.g., in `.bashrc` or `.zshrc`)

##### 🐚 Check your environment variables

- `env` — shows all environment variables
- `echo $USER` — shows your Linux username
- `echo $PGUSER` — shows your PostgreSQL user (if set)
- `echo $0` — shows your shell type (bash/zsh)

##### 🪄 Create a PostgreSQL SUPERUSER

1. Edit your shell config file:
   - `code ~/.bashrc` (or `code ~/.zshrc`)
   - Add: `export PGUSER=<your_linux_user>`
   - Save and reload: `source ~/.bashrc` (or `source ~/.zshrc`)
   - Check: `echo $PGUSER` (should show your user)
2. Enter Postgres as the postgres user:
   - `sudo -i -u postgres`
   - `psql`
3. Create your superuser:
   - `CREATE ROLE <your_linux_user> WITH SUPERUSER LOGIN PASSWORD '<your_password>';`
   - List roles: `\du`
4. Try connecting directly:
   - `psql` (should connect as your user)
   - If you get an error about the database not existing, create it:
     - `createdb <your_linux_user>`
5. (Optional, for dev only) Set local trust authentication:
   - `sudo nano /etc/postgresql/<version>/main/pg_hba.conf`
   - Change METHOD to `trust` for local connections (⚠️ Not for production!)
   - Restart Postgres: `sudo systemctl restart postgresql`

Now you should be able to run `psql` and `createdb` without a password prompt, and Sqitch will work locally.

> ⚠️ **NEVER set trust authentication on a production server!**

---

### Prerequisites

- 🐘 PostgreSQL
- 🦑 Sqitch

### Setup

1. **Clone the repository**

   ```bash
   git clone git@github.com:Damien-Ancelin/myBank.git
   cd myBank
   ```

2. **Install Sqitch dependencies**

   ```bash
   # On Debian/Ubuntu
   sudo apt update
   sudo apt install sqitch libdbd-pg-perl postgresql-client
   ```

3. **Configure your database connection**

   Edit `sqitch.conf` if needed:

   ```ini
   [core]
      engine = pg
      top_dir = migrations
      # plan_file = migrations/sqitch.plan
   [engine "pg"]
      target = db:pg:<your_db_name>
      # registry = sqitch
      # client = psql
   ```

4. **Deploy the database schema and seed data**

   ```bash
   sqitch deploy db:pg:<your_db_name>
   ```

5. **Verify the deployment**

   ```bash
   sqitch verify db:pg:<your_db_name>
   ```

6. **Reset the database (dev only)**

   ```bash
   bash ./script/resetdb.sh
   ```

## Folder Structure 📁

- `migrations/` : Sqitch migration scripts (deploy, revert, verify)
- `script/` : Helper scripts for database management
- `docs/` : Documentation (ERD, MCD, MLD, etc.)

## License 📜

MIT
