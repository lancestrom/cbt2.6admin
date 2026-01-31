# Copilot instructions for cbt2.6admin 🔧

Summary
- This repository is a CodeIgniter (3.x style) MVC application for a CBT (computer-based-test) admin panel.
- Goal for an AI agent: make safe, minimal, and idiomatic changes that fit the existing CodeIgniter patterns and local-development setup.

Quick setup (developer workflow) ✅
1. Start Apache + MySQL (this project is commonly run on XAMPP). On macOS: `sudo /Applications/XAMPP/xamppfiles/xampp start` or use the XAMPP control panel.
2. Create the database and import the schema: `mysql -u root -p cbt25 < Databases/cbt25.sql` (default DB in `application/config/database.php` uses user `root` with empty password).
3. Visit the app in your browser: `http://localhost/cbt2.6admin/` (default controller: `Login`).
4. If you need visible stack traces, set `ENVIRONMENT` in `index.php` to `development`.

Architecture & important files 🧭
- MVC split: `application/controllers/`, `application/models/`, `application/views/`.
- CI core lives in `system/` (do not modify unless necessary).
- Autoloaded (see `application/config/autoload.php`): `database`, `session`, helpers `url`, `form`, and models: `Model_keamanan`, `Model_jurusan`, `Model_kelas`, `Model_siswa`, `Model_mapel`, `Model_ujian`, `Model_ruang`, `Model_token`.
- DB config: `application/config/database.php` — change hostname/credentials here for production.
- Sessions: cookie name `cbt_smk_th_session` (in `application/config/config.php`). If sessions behave oddly, set `sess_save_path` to a writable absolute path.
- Uploads: files go under `upload/` (e.g., `upload/excel/`, `upload/soal_gambar/`).

Project-specific conventions ⚙️
- Controller class names start with capital letter (e.g., `Login`, `Dashboard`). Default route is in `application/config/routes.php` (`Login`).
- Models are named `Model_*` and usually return query objects; controllers use `->num_rows()` and `->result()` directly (e.g., `Model_login->cek_login(...)`).
- Views use `tampilan_*.php` naming and are often passed `$isi` arrays with `title` and other data.
- Authentication: `Model_keamanan->getKeamanan()` is used to check session and redirect to login; `Login->proses_login()` stores `username` and `level` in session and redirects to role-based dashboards (`Dashboard`, `Dashboard_akl`, etc.).
- Passwords: current code uses `md5()` (in `application/controllers/Login.php`) — treat as existing behavior (note: insecure but observable requirement).

Common tasks & how to do them (examples) 🛠️
- Add a page: create controller `application/controllers/MyPage.php`, view `application/views/Master/tampilan_mypage.php`, and protect with `Model_keamanan->getKeamanan()` in the controller constructor.
- Use a model: either autoload it in `autoload.php` or load in controller: `$this->load->model('Model_example'); $data = $this->Model_example->getSomething();`
- Debugging DB issues: ensure `application/config/database.php` credentials match local DB and import `Databases/cbt25.sql`.
- File uploads/Excel: `third_party/spout/` is present for spreadsheet handling — look for code in controllers that reference it.

Testing / tooling notes
- There are no project-specific automated tests present. `composer.json` references phpunit support for the framework but not app tests.
- PHP compatibility: `composer.json` lists `php >= 5.3.7`. Use a modern PHP (7.x or 8.x) locally but verify basic compatibility.

Safety and restrictions 🚨
- Do not modify CodeIgniter core files under `system/` unless absolutely required. Prefer app-level overrides or extending classes with `MY_` prefix (`application/core/` or `application/libraries/`).
- Preserve existing DB schema and column names; many controllers and models assume specific column names (e.g., `username`, `level`).
- Follow existing session and auth flows; adding new auth behavior should be done conservatively and documented.

Where to look when something is unclear 🔎
- Authentication and redirects: `application/controllers/Login.php`
- Security gate: `application/models/Model_keamanan.php`
- Autoloaded resources & app-wide configuration: `application/config/autoload.php` and `application/config/config.php`
- DB config & initial data: `application/config/database.php` and `Databases/cbt25.sql`
- View templates: `application/views/templates/` and `application/views/Master/`

If you need additional precision
- Ask for sample controller/view pairs to mirror. If a task involves changing auth or DB schema, request a short description and a small test dataset to validate against.

---
Please review these notes and tell me any unclear or missing areas (example: preferred code style, deployment steps, or specific pages you want documented). I'm happy to iterate. ✨
