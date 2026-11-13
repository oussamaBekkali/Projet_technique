# Project Technical README

## Overview
This repository contains a multi-stage prototype of a software project management / task tracking application. The project was developed progressively across several sessions, moving from a MySQL-backed PHP task manager toward a lighter JSON-based task status manager with a frontend interface.

The main goal is to manage tasks and their statuses (for example: pending, in progress, completed), assign them to developers, and display a simple dashboard for project administration.

## Project concept
The application is built around a task management model inspired by software project workflows:

- Developers are assigned tasks
- Tasks have titles, descriptions, priorities, deadlines, and statuses
- Statuses are grouped as task states such as Pending, In Progress, and Completed
- A simple interface allows adding and listing task statuses

## Repository structure
```text
Projet_technique/
├── session 1/
│   ├── live_oussama_bk/
│   │   ├── index.php
│   │   ├── add_task.php
│   │   ├── db.php
│   └── prototype/
│       ├── code/
│       │   ├── index.php
│       │   ├── add_task.php
│       │   ├── db.php
│       │   └── sql.sql
├── session 2/
│   ├── live coding/
│   │   ├── backend/
│   │   └── frontend/
│   └── prototype/
│       ├── backend/
│       └── frontend/
├── session 3/
│   ├── backend/
│   └── frontend/
└── README.md
```

## Versions and evolution
### Session 1
The first version uses:
- PHP
- MySQL database
- A classic table-based task listing page
- Task creation page for adding tasks and developer assignments

This version is closer to a real database-driven management system.

### Session 2
The second iteration focuses on:
- API-based interaction using PHP
- JSON file storage (`data.json`)
- A frontend written in JavaScript
- A more dynamic UI for fetching and posting task statuses

This version introduces the concept of a lightweight API for status management.

### Session 3
The final version in this repository is the clearest implementation of the project concept:
- `backend/api/api.php` handles requests
- `backend/controller/TaskStatusController.php` processes business logic
- `backend/classes/GestionTs.php` manages the JSON data source
- `backend/classes/TaskStatus.php` defines the model
- `frontend/index.html` and `frontend/app.js` handle the UI

This is the most complete and usable reference version in the repository.

## Technologies used
- PHP 8+
- MySQL / MariaDB (older session)
- JSON file storage (lighter prototypes)
- HTML5
- JavaScript
- CSS / Tailwind CSS (in session 3 frontend)

## Functional features
- Display list of tasks or task statuses
- Add new task status entries
- Save data in JSON or database depending on the version
- Manage task metadata such as:
  - name
  - description
  - priority
  - created date
  - deadline
  - developer assignment

## Local setup
### Option 1: Run the JSON-based prototype (Session 3)
1. Place the project in a local PHP environment such as XAMPP, WAMP, or MAMP.
2. Start Apache in your local server stack.
3. Open the project folder in your browser using a PHP-enabled server.
4. Access the frontend from the `session 3/frontend` folder.

Example:
```bash
php -S localhost:8000
```
Then open:
```text
http://localhost:8000/session%203/frontend/index.html
```

### Option 2: Run the MySQL version (Session 1)
1. Import the SQL schema from `session 1/prototype/code/sql.sql` into MySQL.
2. Configure the database credentials in `db.php`.
3. Start your PHP server and open the PHP pages in the browser.

## Important notes
- This repository is not a single production application; it is a project archive of iterative prototypes.
- The root directory does not contain a single running app entry point.
- The most consistent implementation is under `session 3`.
- Earlier sessions are useful to understand the evolution of the project and the migration from database storage to JSON-based API logic.

## Suggested next steps
- Merge the project into a single clean structure
- Standardize on one backend architecture
- Add validation, editing, and deletion of tasks and statuses
- Add authentication and user roles for an admin panel
- Convert the app into a full modern web application with a database such as MySQL or PostgreSQL

## License
This project does not include a specific license file. Please check with the repository owner before reusing it for commercial or public distribution.
