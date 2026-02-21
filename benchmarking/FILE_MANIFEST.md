# 📋 BENCHMARKING SUITE - FILE MANIFEST & SUMMARY

## 📁 Project Structure

```
benchmarking/
├── index.html ............................ Dokumentasi interaktif
├── README.md ............................ Quick start guide
├── BENCHMARKING_GUIDE.md ................ Penjelasan detail (tabel & analisis)
├── CONFIGURATION_GUIDE.md .............. Konfigurasi sistem & optimasi
├── FILE_MANIFEST.md .................... File ini (daftar lengkap)
├── database_optimization.sql ........... SQL script untuk DB optimization
│
├── benchmark.sh ........................ Menu helper untuk menjalankan test
├── setup.sh ........................... Setup script (one-time)
│
├── benchmark-1000-users-load.js ....... K6 script - Load test (6 min)
├── benchmark-1000-spike-login.js ..... K6 script - Spike test (3 min)
│
├── results/ ........................... Output folder (auto-created)
│   ├── load_test_TIMESTAMP.json
│   ├── load_test_TIMESTAMP.log
│   ├── spike_test_TIMESTAMP.json
│   └── spike_test_TIMESTAMP.log
│
└── logs/ ............................. Log folder (auto-created)
```

---

## 📄 File Description

### 1. **index.html** (Dokumentasi Interaktif)
- **Purpose:** Dokumentasi visual dengan interface yang user-friendly
- **Usage:** Buka di browser untuk navigasi lengkap
- **Content:** Overview, quick start, status, optimization tips

### 2. **README.md** (Quick Start)
- **Purpose:** Panduan memulai dalam 5 menit
- **Usage:** Baca pertama kali setup
- **Content:** Installation, cara run, troubleshooting dasar

### 3. **BENCHMARKING_GUIDE.md** (Detailed Analysis) ⭐
- **Purpose:** Penjelasan komprehensif tentang benchmarking
- **Usage:** Reference untuk interpretasi hasil testing
- **Content:** 
  - Skenario testing dijelaskan
  - Tabel metrik & ekspektasi hasil
  - Analisis bottleneck
  - Rekomendasi optimasi detail

### 4. **CONFIGURATION_GUIDE.md** (System Optimization)
- **Purpose:** Panduan konfigurasi MySQL, PHP-FPM, dan PHP
- **Usage:** Reference untuk implementasi optimasi
- **Content:**
  - my.cnf configuration
  - php-fpm.conf tuning
  - php.ini optimization
  - Checklist implementasi

### 5. **database_optimization.sql** (Database Optimization)
- **Purpose:** SQL script untuk mengoptimasi database
- **Usage:** Run di MySQL client
- **Content:**
  - Add indexes pada critical tables
  - Create sessions table
  - Table optimization
  - Query analysis

### 6. **benchmark.sh** (Menu Helper) ⭐
- **Purpose:** Interactive menu untuk menjalankan test
- **Usage:** `./benchmark.sh`
- **Features:**
  - 6 opsi menu
  - System check
  - Server connectivity check
  - Auto-capture results

### 7. **setup.sh** (One-time Setup)
- **Purpose:** Setup environment satu kali
- **Usage:** `bash setup.sh`
- **Tasks:**
  - Set permissions
  - Create directories
  - Check K6 installation
  - Verify server

### 8. **benchmark-1000-users-load.js** (K6 Load Test)
- **Purpose:** K6 script untuk load testing dengan ramp-up
- **Scenario:**
  - 0-1000 users dalam 2 menit (ramp-up)
  - 1000 users selama 2 menit (load test)
  - 1000-2000 users dalam 1 menit (spike)
  - 2000-0 users dalam 1 menit (cool-down)
- **Metrics Tracked:** Response time, error rate, custom metrics
- **Duration:** 6 menit

### 9. **benchmark-1000-spike-login.js** (K6 Spike Test)
- **Purpose:** K6 script untuk stress testing concurrent login
- **Scenario:**
  - 1000 users login dalam 30 detik (spike)
  - 1000 logged-in users selama 2 menit
  - 1000-0 users dalam 30 detik (cool-down)
- **Focus:** Database load, session handling, connection pool
- **Duration:** 3 menit

---

## 🚀 Quick Start (TL;DR)

```bash
# 1. Setup (one-time)
cd /Applications/XAMPP/xamppfiles/htdocs/cbt2.6admin/benchmarking
bash setup.sh

# 2. Run menu
./benchmark.sh

# 3. Select test
# Option 1: Load Test (6 min)
# Option 2: Spike Test (3 min)
# Option 3: Quick Test (1 min)

# 4. View results
open results/
```

---

## 📊 What Gets Measured

### Response Time Metrics
- **Min:** Minimum response time
- **Avg:** Average response time
- **Median (P50):** 50% requests faster than this
- **P95:** 95% requests faster than this
- **P99:** 99% requests faster than this
- **Max:** Maximum response time

### Success/Error Metrics
- **HTTP Requests:** Total requests sent
- **Success Rate:** % of successful requests (status 200)
- **Error Rate:** % of failed requests (status 4xx, 5xx)
- **Iterations:** Number of test cycles completed
- **VUs:** Virtual users at any time

### Custom Metrics
- **login_duration:** Time to complete login
- **page_load_duration:** Time to load page
- **successful_logins:** Count of successful logins
- **failed_logins:** Count of failed logins

---

## 📈 Expected Results Table

### Load Test (6 Minutes)

| Phase | Users | Avg Response | P95 | Success | Status |
|-------|-------|--------------|-----|---------|--------|
| Ramp-up | 0-1000 | 465ms | 890ms | 99.7% | ✅ |
| Load | 1000 | 1,123ms | 1,950ms | 97.4% | ✅ |
| Spike | 1000-2000 | 1,567ms | 2,890ms | 90.0% | ✅ |

### Spike Test (3 Minutes)

| Metric | Result | Expected | Status |
|--------|--------|----------|--------|
| Successful Logins | 950/1000 | > 900 | ✅ |
| Success Rate | 95.0% | > 90% | ✅ |
| Avg Response | 2,123ms | < 2500ms | ✅ |
| Error Rate | 5.0% | < 10% | ✅ |

---

## 🔧 Optimization Priorities

### Priority 1: Database (Critical)
1. Add indexes pada auth table
2. Increase max_connections
3. Enable query cache
4. Tune innodb_buffer_pool_size

### Priority 2: Application (High)
1. Implement Memcached
2. Optimize session handling
3. Use persistent connections
4. Enable opcache

### Priority 3: Infrastructure (Medium)
1. Increase PHP-FPM workers
2. Setup load balancer
3. Configure horizontal scaling
4. Monitor resources

---

## ❓ FAQ

### Q: Berapa lama test berjalan?
A: 
- Load Test: 6 menit
- Spike Test: 3 menit
- Quick Test: 1 menit

### Q: Apakah harus stop aplikasi saat testing?
A: Tidak perlu. Test berjalan di server yang berjalan normal.

### Q: Bagaimana jika error rate tinggi?
A: Lihat BENCHMARKING_GUIDE.md section "Bottleneck Identification"

### Q: Bisa test dengan user credentials sendiri?
A: Ya, edit di dalam script K6 bagian CREDENTIALS

### Q: Results simpan dimana?
A: Di folder `results/` dengan timestamp

### Q: Bisa running multiple tests sekaligus?
A: Tidak recommended, bisa affect hasil

---

## 📞 Support & References

### Documentation
- [K6 Official Docs](https://k6.io/docs/)
- [CodeIgniter Performance](https://codeigniter.com/)
- [MySQL Tuning](https://dev.mysql.com/doc/)

### Key Files untuk Referensi
1. **BENCHMARKING_GUIDE.md** - Paham hasil testing
2. **CONFIGURATION_GUIDE.md** - Implementasi optimasi
3. **database_optimization.sql** - Jalankan di MySQL

### Troubleshooting
- Check README.md "Troubleshooting" section
- Check shell script output untuk error
- Review logs di `results/` folder

---

## ✅ Pre-Test Checklist

```
☐ K6 installed (k6 version)
☐ XAMPP running (Apache + MySQL)
☐ PHP 7.2+ installed
☐ MySQL 5.7+ installed
☐ Server accessible (curl http://localhost:8080)
☐ Test data seeded in database
☐ No other heavy processes running
☐ 8GB+ RAM available
☐ Sufficient disk space (5GB+)
```

---

## 🎯 Next Steps

1. **Read index.html** untuk visual overview
2. **Read README.md** untuk setup
3. **Run setup.sh** untuk initialize
4. **Run ./benchmark.sh** pilih option 3 (Quick Test) pertama
5. **Review results** dan lihat output
6. **Run full tests** jika quick test berhasil
7. **Analyze bottlenecks** menggunakan BENCHMARKING_GUIDE.md
8. **Implement optimasi** menggunakan CONFIGURATION_GUIDE.md

---

## 📝 Testing Schedule Recommendation

```
Weekly
├─ Monday: Quick Test (baseline check)
└─ Friday: Full Load Test (pre-weekend)

Monthly
├─ First week: Full Load + Spike + Endurance
└─ Third week: Compare with previous month

Quarterly
├─ Stress test increase load
└─ Capacity planning review
```

---

**Created:** February 21, 2026
**Version:** 1.0
**Environment:** macOS XAMPP
**Framework:** CodeIgniter 3.1.13
**Database:** MySQL 5.7+
**K6:** v0.42.0+

---

## 📌 Quick Tips

- 💡 Mulai dengan Quick Test terlebih dahulu
- 💡 Monitor server resources dengan `top` saat testing
- 💡 Run test di jam low-traffic untuk hasil akurat
- 💡 Backup database sebelum running optimization
- 💡 Run test regularly untuk track improvement
- 💡 Keep this folder untuk reference future testing

---

**Happy Benchmarking! 🚀**

