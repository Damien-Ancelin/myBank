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

4. **Start PostgreSQL with Docker**

   ```bash
   docker-compose up -d
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

6. **Deploy the database schema**

   ```bash
   sqitch deploy
   ```

7. **Verify the deployment**

   ```bash
   sqitch verify
   ```

8. **Reset the database (development only)**

   ```bash
   sqitch revert && sqitch deploy && sqitch verify
   ```

## Sqitch Commands 🦑

### Available Targets

- `db:pg://mybank_user:mybank_password@localhost:5432/mybank`: Complete URI

## Folder Structure 📁

- `migrations/` : Sqitch migration scripts (deploy, revert, verify)
- `script/` : Helper scripts for database management
- `docs/` : Documentation (ERD, MCD, MLD, etc.)

## License 📜

MIT
