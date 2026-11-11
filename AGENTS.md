# AGENTS.md

## Overview
Anonymous, database-less voting system (PHP 8+, Twig 3.3+, Composer).

## Entry Points
- **Main**: `index.php` – renders the home page.
- **Create vote**: `create-vote.php` – POST with `type`, `description`, `pin` to create a new vote.
- **Vote**: `vote.php` – GET with `pin` to display a vote; POST with `votedata` to submit a vote.
- **Results**: `results.php` – GET with `pin` to show vote results.
- **Pull**: `pull.php` – resets to HEAD then pulls (dangerous – use with caution).

## Installation & Setup
```bash
# Install dependencies (Composer)
composer install --no-dev

# Run static analysis (Psalm)
psalm
```

## Voting Flow
1. **Create a vote** – POST to `create-vote.php` with `type` (e.g., "grade", "binary", "text"), `description`, and `pin`.
2. **View the vote** – GET `/vote.php?pin=<pin>` to see the vote details.
3. **See results** – GET `/results.php?pin=<pin>` to see the vote count and majority.

## Vote Storage
Votes are stored as JSON files in the PHP temporary directory, named `<pin>.json` (e.g., `/tmp/0520.json`). Each file is written with `0600` permissions and votes are appended to the existing file.

## Security
- HTTPS is required so that vote data and session information are not transmitted in plaintext.

## CI / Automation
- **Lint**: GitHub Actions (`linter.yml`) runs Super Linter on every push/PR.
- **PHP**: GitHub Actions (`php.yml`) validates `composer.json`/`composer.lock`, installs dependencies, and optionally runs tests.
- **Docker**: Builds a Docker image on push/PR (`docker-image.yml`).

## Agent Notes
- No test suite or lint script is configured locally; Super Linter runs via CI. Static analysis is available via `psalm` (see `psalm.xml`).
- Avoid running `pull.php` – it executes `git reset --hard HEAD` followed by `git pull` and discards local changes.
- Use `create-vote.php` to create votes and `vote.php`/`results.php` to view them.
- Run `psalm` for static analysis before committing.
- Ensure HTTPS is enabled in production (votes must be transmitted securely).
- Check the linter config (`linter.yml`) for any linting rules that may affect code quality.
