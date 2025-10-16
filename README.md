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
- 🐳 Docker deployment

## Tech Stack 🛠️

- 🐘 PostgreSQL 16
- 🦑 Sqitch (database migrations)
- 🐳 Docker & Docker Compose
- 🐘 PHP (for the application logic, not included here)

## Getting Started 🚀

### Prerequisites

- 🐘 PostgreSQL 16
- 🦑 Sqitch
- 🐳 Docker & Docker Compose

### Setup

1. **Clone the repository**

   ```bash
   git clone git@github.com:Damien-Ancelin/myBank.git
   cd myBank
   ```

2. **Install Sqitch**

   ```bash
   # On macOS with Homebrew
   brew install sqitch

   # On Debian/Ubuntu
   sudo apt update
   sudo apt install sqitch libdbd-pg-perl postgresql-client
   ```

3. **Create environment file**

   ```bash
   # Create .env file from example
   cp .env.example .env

   # Or create manually
   cat > .env << EOF
   POSTGRES_DB=mybank
   POSTGRES_USER=mybank_user
   POSTGRES_PASSWORD=mybank_password
   POSTGRES_PORT=5432
   EOF
   ```

   *Note: Use port `5433` if `5432` is already in use.*

4. **Start PostgreSQL with Docker**

   ```bash
   composer docker:up
   ```

5. **Configure Sqitch (optional)**

   The `sqitch.conf` file is already configured with the complete URI:

   ```ini
   [core]
      engine = pg
      top_dir = migrations
   [engine "pg"]
      target = db:pg://mybank_user:mybank_password@localhost:5432/mybank
      registry = sqitch
      client = psql
   ```

   *Note: Use port `5433` if `5432` is already in use.*

6. **Deploy the database schema**

   ```bash
   composer sqitch:deploy
   ```

7. **Verify the deployment**

   ```bash
   composer sqitch:verify
   ```

8. **Revert the last change (if needed)**

   ```bash
   composer sqitch:revert
   ```

9. **Reset the database (development only)**

   ```bash
   composer sqitch:reset-db
   ```

## Sqitch Commands 🦑

### Available Targets

- `db:pg://mybank_user:mybank_password@localhost:5432/mybank`: Complete URI
- *Note: Use port `5433` if `5432` is already in use.*

## Folder Structure 📁

- `migrations/` : Sqitch migration scripts (deploy, revert, verify)
- `script/` : Helper scripts for database management
- `docs/` : Documentation (ERD, MCD, MLD, etc.)

## Launch PHP Application 🚀

1. Ensure you have PHP and Composer installed.
2. Install dependencies:

   ```bash
   composer install
   ```

3. Configure your PHP application to connect to the PostgreSQL database using the credentials in the `.env` file.
4. Run the PHP application:

   ```bash
   composer start
   ```

   or directly with PHP's built-in server:

   ```bash
   php -S localhost:8000 -t src/public -d display_errors=1 -d display_startup_errors=1 -d error_reporting=E_ALL
   ```

## License 📜

MIT
