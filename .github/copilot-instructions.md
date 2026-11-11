# Copilot instructions for this repository

## Project layout

This repository is a small full-stack demo split by session. The active app is under `session 3/`:

- `session 3/frontend/index.html`: HTML layout and Tailwind-based UI
- `session 3/frontend/app.js`: client-side logic for loading and creating task statuses
- `session 3/backend/api/api.php`: single API entry point for the app
- `session 3/backend/services/`: TaskStatus API operations
- `session 3/backend/dao/TaskStatusDAO.php`: JSON file access and TaskStatus data mapping
- `session 3/backend/classes/TaskStatus.php`: simple model/object for a task status
- `session 3/backend/data/data.json`: file-based database used by the app

## Build, test, and lint commands

There is no package manager, framework toolchain, CI workflow, or test suite in this repository.

Use PHP syntax validation as the quick verification step for edited backend files:

- `php -l "session 3/backend/classes/TaskStatus.php"`
- `php -l "session 3/backend/services/BaseService.php"`
- `php -l "session 3/backend/services/TaskStatusService.php"`
- `php -l "session 3/backend/dao/TaskStatusDAO.php"`
- `php -l "session 3/backend/api/api.php"`

Run the app locally from the repo root:

- `php -S 127.0.0.1:8000 -t "session 3"`
- Open `http://localhost:8000/frontend/`

Quick API checks:

- `curl http://localhost:8000/backend/api/api.php`
- `curl -X POST http://localhost:8000/backend/api/api.php -H "Content-Type: application/json" -d '{"name":"demo","description":"check"}'`

## High-level architecture

- The frontend is plain JavaScript without a framework or bundler.
- `app.js` calls the PHP API, renders the returned array to the table, and shows toast feedback.
- `api.php` is the only public backend endpoint; it handles `GET` and `POST` and converts exceptions to JSON 500 responses.
- `api.php` delegates GET and POST requests directly to `TaskStatusService`.
- `TaskStatusService` decodes POST JSON, adapts entity results for the API, and delegates persistence to `TaskStatusDAO`.
- `TaskStatusDAO` validates additions and maps records to `TaskStatus` objects while reading/writing `backend/data/data.json`.
- Data is stored as an array of objects shaped like `{ id, name, description }`.

## Key conventions

- Keep the API contract JSON-only and preserve the existing response shape:
  - `GET` returns an array of task objects
  - `POST` expects a JSON body with `name` and `description`
  - success responses commonly include a `message` field
- Use `require_once` for PHP includes and keep relative paths aligned with the current folder structure.
- Preserve the existing frontend DOM ids and naming (`form`, `#section-form`, `#table-ts-body`, etc.) because `app.js` references them directly.
- The app uses a file-based data store, not a database. Any new write path should still update `data.json` in the same format.
- When adding new records, keep `id` values unique; the DAO uses the highest existing ID plus one.
- The UI is intentionally in French (`Enregistrer`, `Annuler`, `Nouvelle taskStatus`) and the app follows that terminology unless a task explicitly requires a different language.

## MCP servers

If this project expands into browser automation or a larger web app, a Playwright MCP server would be a reasonable fit. Otherwise, no project-specific MCP server setup is required.
