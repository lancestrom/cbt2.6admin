# Copilot / AI agent quick instructions for this repo ✅

Purpose
- Short, actionable guidance to get an AI code agent productive quickly in this CodeIgniter app (CBT 2.6).

Quick start (what files to inspect first)
- `index.php` — environment and front controller behavior (ENVIRONMENT affects error reporting).
- `application/config/config.php`, `database.php`, `autoload.php` — primary runtime settings (base_url, sessions, DB, helpers, autoloaded models).
- `application/controllers/` — controllers (entry points and routing logic). Default controller: `Login` (`routes.php`).
- `application/models/` — data access using CI Query Builder (models are named `Model_*`).
- `application/views/` and `application/views/templates` — view templates, header/footer structure.

Big-picture architecture
- CodeIgniter MVC (System files in `/system`), PHP runtime only (no build step).
- Routing: `routes.php` (default controller `Login`). `.htaccess` rewrites to `index.php`.
- DB: MySQL (mysqli). DB connection lives in `application/config/database.php`.
- Sessions use CI file driver (`sess_driver` = 'files') and a custom cookie name `cbt_smk_th_session` in `config.php`.
- Excel import uses Box/Spout in `application/third_party/spout` (controllers require it directly).

Project-specific conventions & patterns
- Models prefixed with `Model_` and autoloaded models listed in `application/config/autoload.php`.
- Controllers are PascalCase classes in `application/controllers` and return views using `$this->load->view('templates/header', $data)` → content view → `templates/footer`.
- Auth: `Login` controller sets session keys `username` and `level`. Many controllers branch behavior by `level` (e.g., `admin`, `adminakl`, etc.).
- Flash messages use `$this->session->set_flashdata('pesan', '<div...>')` (search and reuse this pattern).

Examples (do as agent when modifying code)
- Add a controller: create `application/controllers/MyController.php` with `class MyController extends CI_Controller { public function index(){ $this->load->view('templates/header',$d); $this->load->view('my_view',$d); $this->load->view('templates/footer'); }}`
- DB query in model: use `$this->db->where(...); return $this->db->get('table');` (see `Model_login::cek_login`).
- Import spreadsheets: controllers call `require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';` and use `ReaderEntityFactory`.

Debugging & developer workflow
- Run locally under a PHP/Apache stack (this repo sits under XAMPP htdocs in the workspace).
- Toggle `ENVIRONMENT` in `index.php` (or set `$_SERVER['CI_ENV']`) to `development` to see errors.
- DB debug set by `db_debug` in `database.php` which depends on `ENVIRONMENT !== 'production'`.
- Application logs are in `application/logs/` — `log_threshold` is set in `config.php`.

Important gotchas & constraints
- PHP compatibility: composer.json indicates PHP >=5.3.7. Confirm runtime PHP version before major changes.
- No automated test suite present. There are CI-style composer scripts from CodeIgniter upstream but no local tests in this app.
- Password hashing: legacy `md5()` is used in `Login` and `Model_login` (detectable by searching for `md5`). Be cautious and document any security changes.
- `composer_autoload` is disabled in `config.php` (set to FALSE); third-party libs may be loaded directly from `application/third_party`.

Files and folders you will refer to most
- `index.php`, `application/config/*`, `application/controllers/*`, `application/models/*`, `application/views/*`, `application/third_party/spout/*`, `assets/*`.

When to open a PR vs ask a human
- Small refactors that preserve behavior and include examples in the code/descriptions: go ahead and open PRs.
- Any change to authentication, session storage, or database schema: ask a human reviewer and include migration plan and tests/manual verification steps.

Search tips (useful grep targets)
- `set_flashdata('pesan'` (UI flash pattern)
- `require_once .*spout` (Excel import)
- `Model_` (models)
- `sess_cookie_name` / `cbt_smk_th_session` (session behavior)

If something is unclear, ask for:
- The intended runtime PHP version and deployment target
- Any constraints on upgrading libraries (e.g., replacing `md5` hash)

Thanks — if you'd like, I can: (1) open a small PR that adds this file to the repo, or (2) expand any section with inline examples and code snippets. Which would you prefer? 💡