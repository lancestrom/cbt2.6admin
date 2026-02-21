# 🚀 K6 BENCHMARKING CODEIGNITER 3 - QUICK START

Panduan lengkap untuk menjalankan benchmark performance test dengan K6 untuk aplikasi CodeIgniter 3 (CBT 2.6 Admin).

---

## 📦 Requirements

```bash
✅ macOS dengan Homebrew
✅ K6 v0.42.0+
✅ XAMPP (Apache + PHP + MySQL)
✅ Terminal/Shell
```

---

## 🔧 Setup (First Time Only)

### 1. Install K6
```bash
# macOS
brew install k6

# Verify
k6 version
```

### 2. Make Script Executable
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/cbt2.6admin/benchmarking

chmod +x benchmark.sh
chmod +x *.js
```

### 3. Verify Setup
```bash
./benchmark.sh

# Akan menampilkan menu jika sudah terinstall dengan benar
```

---

## ▶️ Cara Menjalankan

### Option A: Menggunakan Menu Helper Script (Recommended)
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/cbt2.6admin/benchmarking

./benchmark.sh

# Pilih opsi dari menu:
# 1 = Load Test (1000 users, 6 menit)
# 2 = Spike Test (1000 login serentak, 3 menit)
# 3 = Quick Test (100 users, 1 menit)
# 4 = Endurance Test (500 users, 15 menit)
```

### Option B: Direct K6 Command (Advanced)
```bash
# Load Test
k6 run benchmark-1000-users-load.js

# Spike Test
k6 run benchmark-1000-spike-login.js

# Custom dengan options
k6 run -v --vus 1000 --duration 6m benchmark-1000-users-load.js
```

### Option C: Export Results to JSON
```bash
# Run dengan output JSON untuk analisis lanjut
k6 run --out json=results.json benchmark-1000-users-load.js

# Parse hasil
cat results.json | jq '.data.samples[] | select(.metric == "http_req_duration")' | head -20
```

---

## 📊 Expected Outputs

### Terminal Output (Real-time)
```
    data_received..................: 2.4 MB   6.8 kB/s
    data_sent.......................: 1.2 MB   3.4 kB/s
    http_req_blocked...............: avg=12.34ms min=1.2ms med=5.6ms max=450.23ms p(90)=45.2ms p(95)=120.4ms p(99)=300.5ms
    http_req_connecting............: avg=8.34ms min=0s med=2.3ms max=400.12ms p(90)=35.1ms p(95)=100.3ms p(99)=280.4ms
    http_req_duration..............: avg=892ms min=45ms med=750ms max=5234ms p(90)=1450ms p(95)=1890ms p(99)=2456ms
    http_req_failed................: 2.91%    ↑ 363
    http_req_receiving.............: avg=12.3ms min=1.1ms med=8.5ms max=150.23ms p(90)=34.2ms p(95)=89.3ms p(99)=145.1ms
    http_req_sending...............: avg=3.45ms min=0.2ms med=2.1ms max=89.23ms p(90)=12.3ms p(95)=45.2ms p(99)=78.9ms
    http_req_tls_handshaking.......: avg=0s min=0s med=0s max=0s p(90)=0s p(95)=0s p(99)=0s
    http_req_waiting...............: avg=876ms min=30ms med=715ms max=5100ms p(90)=1400ms p(95)=1850ms p(99)=2400ms
    http_requests..................: 12467 348.142/s
    iteration_duration.............: avg=5234ms min=4123ms med=5145ms max=8923ms p(90)=6200ms p(95)=7100ms p(99)=7890ms
    iterations......................: 4000 111.380/s
    login_duration.................: avg=1123ms min=120ms med=1050ms max=4890ms p(90)=1600ms p(95)=1950ms p(99)=2300ms
    successful_logins..............: 950   26.408/count
    failed_logins..................: 50    1.391/count
    vus............................: 1000  min=0 max=1000
    vus_max........................: 1000
```

### JSON Results File
```json
{
  "type": "Point",
  "metric": "http_req_duration",
  "data": {
    "time": 1234567890,
    "value": 892
  },
  "tags": {
    "expected_response": "200",
    "group": ":: Login Process - 1000 Users",
    "name": "POST http://localhost:8080/cbt2.6admin/Login/proses_login",
    "status": "200"
  }
}
```

---

## 📈 Interpreting Results

### Response Time Interpretation

| Metric | Time | Status | Meaning |
|--------|------|--------|---------|
| P50 | 200-400ms | ✅ Good | 50% requests lebih cepat |
| P95 | 500-1500ms | ✅ Good | 95% requests masih acceptable |
| P99 | 1000-2500ms | ⚠️ Accept | 1% requests mungkin slow |
| Max | >3000ms | ❌ Bad | Ada bottleneck serius |

### Error Rate Interpretation

| Rate | Status | Action |
|------|--------|--------|
| 0-2% | ✅ Excellent | No action needed |
| 2-5% | ⚠️ Acceptable | Monitor and optimize |
| 5-10% | ⚠️ Warning | Investigate bottleneck |
| >10% | ❌ Critical | Server overloaded |

### Success Rate Interpretation

| Rate | Status | Meaning |
|------|--------|---------|
| >99% | ✅ Excellent | System very stable |
| 95-99% | ✅ Good | Minor failures acceptable |
| 90-95% | ⚠️ Warning | Degraded performance |
| <90% | ❌ Critical | System unstable |

---

## 🔍 Analyzing Results

### View Real-time Metrics
```bash
# Detailed summary
k6 run -v benchmark-1000-users-load.js

# Very verbose
k6 run -vv benchmark-1000-users-load.js
```

### Extract Specific Metrics from JSON
```bash
# All response times
cat results.json | jq '.data | select(.metric == "http_req_duration") | .data.value'

# Only failed requests
cat results.json | jq '.data | select(.metric == "http_req_failed") | .data.value'

# Response time percentiles
cat results.json | jq '.data | select(.metric == "http_req_duration") | .data.tags'
```

### Generate Report
```bash
# Create custom report
cat results.json | jq -r \
  '.data[] | select(.metric == "http_req_duration") | "\(.data.value)ms"' \
  > response_times.txt

# Calculate statistics
awk '{sum+=$1; sumsq+=$1*$1; n++} 
END {
  print "Average:", sum/n "ms"
  print "Variance:", sumsq/n - (sum/n)^2
}' response_times.txt
```

---

## ⚙️ Configuration Options

### Modify Test Parameters
Edit file: `benchmark-1000-users-load.js`

```javascript
// Change number of users
stages: [
    { duration: '2m', target: 2000 },  // 2000 users instead of 1000
    { duration: '2m', target: 2000 },
]

// Change test duration
stages: [
    { duration: '5m', target: 1000 },  // 5 menit ramp-up
    { duration: '10m', target: 1000 }, // 10 menit load test
]

// Change thresholds
thresholds: {
    'http_req_duration': ['p(95)<1000'],  // Stricter: < 1s
}
```

### Modify Server URL
Edit di kedua file:
```javascript
const BASE_URL = 'http://localhost:8080/cbt2.6admin';

// Change to:
const BASE_URL = 'http://192.168.1.100:8080/cbt2.6admin';
```

### Modify Credentials
Edit file: `benchmark-1000-spike-login.js`

```javascript
const CREDENTIALS = [
  { username: 'siswa_akl_1', password: 'siswa123' },
  { username: 'siswa_pm_1', password: 'siswa123' },
  // Add more...
];
```

---

## 🐛 Troubleshooting

### Error: "Connection refused"
```
Problem: Server tidak running
Solution:
  1. Check XAMPP Apache: Open /Applications/XAMPP/manager-osx
  2. Start Apache & MySQL
  3. Verify: curl http://localhost:8080/cbt2.6admin
```

### Error: "Too many open files"
```
Problem: System ulimit terlalu rendah
Solution (macOS):
  ulimit -n 65536
  ulimit -m 65536
  launchctl limit maxfiles 200000 200000
```

### Error: "Out of memory"
```
Problem: RAM tidak cukup untuk 1000 VUs
Solution:
  1. Reduce VU count: --vus 500
  2. Increase RAM allocation
  3. Use staging environment
```

### Slow Response Times
```
Problem: Response time > 5 detik
Investigate:
  1. Check database slow query log: tail -100 my_slowquery.log
  2. Monitor CPU: top -o %CPU -n 10
  3. Check connections: mysql> SHOW FULL PROCESSLIST;
  4. Review application logs: tail -100 application/logs/*
```

### High Error Rate
```
Problem: Error rate > 10%
Debug:
  1. Check server connectivity: ping localhost
  2. Verify database: mysql -u root -e "SHOW DATABASES;"
  3. Check auth table: mysql cbt25 -e "SELECT COUNT(*) FROM auth;"
  4. View error log: tail /Applications/XAMPP/xamppfiles/logs/apache_error.log
```

---

## 🎯 Test Scenarios Explanation

### Scenario 1: Load Test (Ramp-Up)
```
├─ Phase 1 (Ramp-up): 0-1000 users dalam 2 menit
│  └─ Mengukur bagaimana server handle traffic increment
│
├─ Phase 2 (Load Test): 1000 users tetap dalam 2 menit
│  └─ Stable performance monitoring
│
├─ Phase 3 (Spike): 1000-2000 users dalam 1 menit
│  └─ Test overload scenario
│
└─ Phase 4 (Cool Down): 2000-0 users dalam 1 menit
   └─ Verify server recovery
```

**Use Case:** Production traffic during school hours

### Scenario 2: Spike Test (Concurrent Login)
```
├─ Phase 1 (Login Spike): 1000 users login dalam 30 detik
│  └─ Worst-case scenario: semua siswa login bersamaan
│
├─ Phase 2 (Maintain): 1000 users tetap dalam 2 menit
│  └─ Session stability check
│
└─ Phase 3 (Cool Down): 1000-0 users dalam 30 detik
   └─ Graceful shutdown
```

**Use Case:** Server capacity planning

---

## 📅 Regular Testing Schedule

```
Weekly
  ├─ Monday: Quick Test (check baseline)
  └─ Friday: Full Load Test (before weekend)

Monthly
  ├─ First Monday: Full Load + Spike + Endurance
  └─ Third Monday: Compare with previous month

Quarterly
  ├─ Stress test at increased load
  └─ Capacity planning review
```

---

## 📞 Support

For issues or questions:
1. Check BENCHMARKING_GUIDE.md (detailed analysis)
2. Check K6 documentation: https://k6.io/docs/
3. Check CodeIgniter docs: https://codeigniter.com/
4. Review application logs in: application/logs/

---

## ✅ Pre-Test Checklist

```
Software
  ☐ K6 installed (k6 version)
  ☐ XAMPP running (Apache & MySQL)
  ☐ PHP 7.2+ (php -v)
  ☐ MySQL 5.7+ (mysql -V)

Network
  ☐ Server accessible (curl http://localhost:8080)
  ☐ No firewall blocking
  ☐ Database connected

Application
  ☐ CBT 2.6 admin running
  ☐ Database seeded with test data
  ☐ Test credentials valid
  ☐ No background jobs running

System
  ☐ Sufficient RAM (8GB+ recommended)
  ☐ Sufficient disk space (5GB+)
  ☐ Network available
  ☐ No other heavy processes
```

---

## 🎓 Example: Full Testing Workflow

```bash
# 1. Open terminal
cd /Applications/XAMPP/xamppfiles/htdocs/cbt2.6admin/benchmarking

# 2. Check system
./benchmark.sh  # Select option 5

# 3. Run quick test first
./benchmark.sh  # Select option 3

# 4. If quick test passes, run full load test
./benchmark.sh  # Select option 1

# 5. Then run spike test
./benchmark.sh  # Select option 2

# 6. View results
./benchmark.sh  # Select option 6

# 7. Compare with previous results
open results/

# 8. Document findings
# Edit BENCHMARKING_RESULTS.md with your findings
```

---

## 📝 Logging Results

After each test, create summary:
```
Test Date: 2026-02-21
Test Type: Load Test (1000 users)
Duration: 6 minutes
Results: 
  - Success Rate: 97.09%
  - P95 Response Time: 1,890ms
  - Error Rate: 2.91%
  - Max Response: 5,234ms

Issues Found:
  - Database connection timeout during spike phase

Recommended Actions:
  - Increase MySQL max_connections
  - Add connection pooling
  - Optimize login query
```

---

**Last Updated:** February 21, 2026
**Version:** 1.0
**Maintainer:** Performance Testing Team

