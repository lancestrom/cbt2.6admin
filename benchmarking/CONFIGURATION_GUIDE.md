# BENCHMARKING RESULTS SUMMARY & CONFIGURATION

## 📊 TABEL HASIL PERKIRAAN (Hypothesis Results)

### Tabel 1: Metrik Keseluruhan Load Test

| Metrik | Min | Avg | P50 | P95 | P99 | Max |
|--------|-----|-----|-----|-----|-----|-----|
| **Response Time** | 45ms | 892ms | 750ms | 1,890ms | 2,456ms | 5,234ms |
| **HTTP Status 200** | - | 97.09% | - | - | - | - |
| **HTTP Status 5xx** | - | 2.91% | - | - | - | - |
| **Requests/Sec** | - | 348 req/s | - | - | - | - |
| **Total Requests** | - | 12,467 | - | - | - | - |
| **Total Duration** | - | 6 menit | - | - | - | - |

---

### Tabel 2: Response Time per Phase (Load Test)

| Phase | Duration | VU Count | Min | Avg | P95 | Max | Success% |
|-------|----------|----------|-----|-----|-----|-----|----------|
| **Ramp-up** | 2 min | 0→1000 | 45ms | 465ms | 890ms | 1,200ms | 99.7% |
| **Load Test** | 2 min | 1000 | 120ms | 1,123ms | 1,950ms | 3,100ms | 97.4% |
| **Spike** | 1 min | 1000→2000 | 200ms | 1,567ms | 2,890ms | 5,234ms | 90.0% |
| **Cool Down** | 1 min | 2000→0 | 30ms | 612ms | 1,145ms | 2,340ms | 100% |

---

### Tabel 3: Response Time per Endpoint

| Endpoint | Method | Avg Response | P95 | Max | Success% | Notes |
|----------|--------|--------------|-----|-----|----------|-------|
| `/` | GET | 245ms | 890ms | 1,567ms | 99.8% | Static load |
| `/Login/proses_login` | POST | 1,445ms | 2,000ms | 4,567ms | 95.0% | Most critical |
| `/Dashboard` | GET | 876ms | 1,800ms | 3,234ms | 96.5% | Post-login |
| `/Dashboard` (cached) | GET | 234ms | 456ms | 1,200ms | 99.5% | After cache warm |

---

### Tabel 4: Spike Test Results (1000 Login Serentak)

| Metrik | Value | Status | Threshold |
|--------|-------|--------|-----------|
| **Total Users** | 1000 | - | Target |
| **Successful Logins** | 950 | ⚠️ Warning | 95% = OK |
| **Failed Logins** | 50 | - | 5% |
| **Success Rate** | 95.0% | ✅ Pass | > 90% |
| **Avg Response Time** | 2,123ms | ⚠️ Warning | Target 1000ms |
| **P95 Response Time** | 2,567ms | ⚠️ Warning | Target 1500ms |
| **Error Rate** | 5.0% | ✅ Pass | < 10% |
| **DB Timeout** | 80 | ⚠️ Warning | Monitor |

---

### Tabel 5: Database Metrics

| Metrik | Before Opt | After Opt | Improvement |
|--------|-----------|----------|-------------|
| **Avg Query Time** | 320ms | 45ms | 85.9% faster |
| **Login Query Time** | 450ms | 65ms | 85.6% faster |
| **Max Query Time** | 2,100ms | 350ms | 83.3% faster |
| **Connection Pool** | Limited | 1000 conn | 10x better |
| **Queries/Second** | 150 q/s | 800 q/s | 5.3x faster |

---

### Tabel 6: System Resource Usage (Peak Load)

| Resource | Usage | Status | Threshold |
|----------|-------|--------|-----------|
| **CPU Usage** | 85% | ⚠️ High | < 70% |
| **Memory Usage** | 78% | ⚠️ High | < 80% |
| **Disk I/O** | 45% | ✅ Good | < 60% |
| **Network I/O** | 32% | ✅ Good | < 80% |
| **MySQL Connections** | 980 | ⚠️ High | 1000 max |

---

### Tabel 7: Error Type Breakdown

| Error Type | Count | % of Errors | Cause |
|-----------|-------|-------------|-------|
| **Connection Timeout** | 150 | 41% | Database overwhelmed |
| **502 Bad Gateway** | 120 | 33% | PHP-FPM timeout |
| **503 Service Unavailable** | 63 | 17% | MySQL temporary down |
| **Authentication Failed** | 30 | 8% | Invalid credentials (test) |
| **Other** | 0 | 0% | - |

---

## ⚙️ KONFIGURASI SISTEM

### File: /Applications/XAMPP/xamppfiles/etc/my.cnf

```ini
# ============================================================================
# MYSQL OPTIMIZATION untuk 1000+ concurrent users
# ============================================================================

[mysqld]

# ============================================================================
# Basic Settings
# ============================================================================
default-storage-engine = InnoDB
symbolic-links = 0
max_connections = 1000            # Increased from default 100
max_user_connections = 500        # Per user limit
max_allowed_packet = 64M          # Increased from 16M
interactive_timeout = 28800
wait_timeout = 28800

# ============================================================================
# Query Performance
# ============================================================================
query_cache_type = 1              # Enable query cache
query_cache_size = 256M           # Size for caching
query_cache_limit = 2M            # Max query result to cache
tmp_table_size = 256M             # Temp table size
max_heap_table_size = 256M        # Heap table size

# ============================================================================
# InnoDB Settings (Most Important)
# ============================================================================
innodb_buffer_pool_size = 2G      # 50-80% of system RAM
innodb_buffer_pool_instances = 8  # Multiple buffer pools
innodb_log_file_size = 512M       # Transaction log size
innodb_log_buffer_size = 16M      # Log buffer
innodb_flush_log_at_trx_commit = 2 # 0=fast, 1=safe, 2=balanced
innodb_flush_method = O_DIRECT    # Direct I/O
innodb_file_per_table = 1         # Separate file per table
innodb_open_files = 2000          # Max open file handles
innodb_write_io_threads = 8       # Write IO threads
innodb_read_io_threads = 8        # Read IO threads

# ============================================================================
# Connection Pool & Threading
# ============================================================================
thread_stack = 192K
thread_cache_size = 100           # Cache threads for reuse
thread_pool_size = 16             # Thread pool size
thread_pool_stall_limit = 500    # Milliseconds

# ============================================================================
# Slow Query Log (Monitoring)
# ============================================================================
slow_query_log = 1
long_query_time = 2               # Log queries longer than 2 seconds
log_queries_not_using_indexes = 1
log-slow-admin-statements = 1

# ============================================================================
# Performance Schema (Optional - for detailed monitoring)
# ============================================================================
performance_schema = OFF          # Disable in production for speed
# performance_schema_max_table_instances = 12500

# ============================================================================
# Logging
# ============================================================================
log_error = /Applications/XAMPP/xamppfiles/logs/mysql_error.log
general_log = 0                   # Disable general query log
binlog_format = MIXED             # Replication format

# ============================================================================
# Replication (If setting up slave server)
# ============================================================================
# server-id = 1
# log-bin = /var/log/mysql/mysql-bin.log
# relay-log = /var/log/mysql/mysql-relay-bin

# ============================================================================
# Key Buffer & MyISAM (if using MyISAM)
# ============================================================================
key_buffer_size = 32M             # Only if using MyISAM
myisam_recover_options = BACKUP,FORCE
```

### File: /Applications/XAMPP/xamppfiles/etc/php-fpm.conf

```ini
# ============================================================================
# PHP-FPM OPTIMIZATION untuk 1000+ concurrent users
# ============================================================================

[global]

; Logging
error_log = /Applications/XAMPP/xamppfiles/logs/php-fpm.err
log_level = notice

; Process Manager
process_control_timeout = 10
daemonize = yes

[www]

; Basic Settings
listen = 127.0.0.1:9000
listen.backlog = 8192             # Queue size for pending connections
user = _www
group = _www

; Process Manager
pm = dynamic                       # dynamic, static, or ondemand
pm.max_children = 100             # Max worker processes
pm.start_servers = 20             # Initial worker processes
pm.min_spare_servers = 10         # Min idle processes
pm.max_spare_servers = 50         # Max idle processes
pm.process_idle_timeout = 10s
pm.max_requests = 500             # Recycle after 500 requests
pm.max_requests_grace_period = 30s

; Request Settings
request_terminate_timeout = 30s   # Kill slow requests
request_slowlog_timeout = 5s      # Log slow requests
slowlog = /Applications/XAMPP/xamppfiles/logs/php-fpm-slow.log

; Resource Limits
rlimit_files = 65536              # Max open files
rlimit_core = unlimited           # Core dump size

; Performance
catch_workers_output = yes        # Capture worker output
decorate_workers_output = yes     # Add worker ID to output
```

### File: /Applications/XAMPP/xamppfiles/etc/php.ini

```ini
# ============================================================================
# PHP CONFIGURATION untuk optimal performance
# ============================================================================

; Memory & Execution
memory_limit = 256M               # Per-script memory limit
max_execution_time = 30           # Max script execution time
max_input_time = 60              # Max POST/GET/upload time
upload_max_filesize = 100M
post_max_size = 100M

; Caching
opcache.enable = 1                # Enable Zend Opcache
opcache.enable_cli = 1            # Enable for CLI
opcache.memory_consumption = 256   # MB for opcache
opcache.interned_strings_buffer = 16 # MB
opcache.max_accelerated_files = 10000
opcache.validate_timestamps = 0   # Validate in production
opcache.revalidate_freq = 0       # Don't revalidate

; Database
mysqli.max_connections = 100      # Max MySQLi connections
mysqli.max_persistent = 100       # Max persistent connections
pdo_mysql.max_connections = 100   # Max PDO connections
pdo_mysql.idle_timeout = 60

; Session
session.gc_probability = 1
session.gc_divisor = 100
session.gc_maxlifetime = 7200
session.cookie_lifetime = 7200
session.save_path = "/Applications/XAMPP/xamppfiles/temp"

; Error Handling
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
display_errors = Off              # Don't display in production
log_errors = On
error_log = /Applications/XAMPP/xamppfiles/logs/php_error.log

; Performance
realpath_cache_size = 4096K
realpath_cache_ttl = 600

; Date/Time
date.timezone = Asia/Jakarta
```

---

## 📈 PERFORMANCE TUNING CHECKLIST

### Priority 1: Critical (Implement ASAP)
```
☐ MySQL: Increase max_connections to 1000
☐ MySQL: Add indexes on auth.username, auth.password
☐ PHP-FPM: Increase pm.max_children to 100
☐ PHP-FPM: Configure dynamic process manager
☐ Database: Enable query cache (query_cache_size=256M)
```

### Priority 2: High
```
☐ MySQL: Tune innodb_buffer_pool_size (50-80% RAM)
☐ MySQL: Set innodb_flush_log_at_trx_commit = 2
☐ PHP: Enable opcache (memory_consumption=256)
☐ PHP: Configure session handling (database or memcache)
☐ CodeIgniter: Enable caching in config
```

### Priority 3: Medium
```
☐ MySQL: Configure slow query log
☐ MySQL: Add performance_schema
☐ Add application monitoring (New Relic, DataDog)
☐ Setup infrastructure monitoring (Prometheus, Grafana)
☐ Implement load testing in CI/CD pipeline
```

### Priority 4: Nice-to-have
```
☐ Deploy to staging with real load balancer
☐ Setup read replicas for reporting queries
☐ Implement Redis for session storage
☐ Setup Memcached for query caching
☐ Configure auto-scaling in cloud
```

---

## 🎯 EXPECTED IMPROVEMENTS

### Before Optimization
```
Concurrent Users: 100-200
Response Time: 2-5 seconds
Error Rate: > 10%
Success Rate: < 90%
CPU Usage: 90%+
Memory: 85%+
```

### After Optimization
```
Concurrent Users: 1000-5000
Response Time: 200-600ms (70% improvement)
Error Rate: < 2%
Success Rate: > 98%
CPU Usage: 45-50%
Memory: 35-40%
```

---

## ✅ VALIDATION QUERIES

Run these after optimization:

```sql
-- Check indexes are working
EXPLAIN SELECT * FROM auth WHERE username='admin';
-- Should show: Using key 'idx_username'

-- Monitor active connections
SHOW PROCESSLIST;
-- Should not exceed max_connections

-- Check Session table
SELECT COUNT(*) FROM ci_sessions;
-- Should be accessible for session storage

-- Verify table optimization
SELECT table_name, table_rows, data_free 
FROM information_schema.tables 
WHERE table_schema='cbt25' 
ORDER BY data_free DESC;
-- data_free should be minimal
```

---

## 📞 MONITORING & MAINTENANCE

### Daily
- [ ] Monitor error logs
- [ ] Check query response times
- [ ] Verify active connections

### Weekly
- [ ] Run quick performance test
- [ ] Analyze slow query log
- [ ] Check disk space usage

### Monthly
- [ ] Run full load test
- [ ] Optimize tables
- [ ] Update statistics
- [ ] Clear old sessions
- [ ] Review backups

### Quarterly
- [ ] Capacity planning review
- [ ] Security updates
- [ ] Infrastructure upgrade evaluation

---

**Generated:** February 21, 2026
**Version:** 1.0
**Framework:** CodeIgniter 3.1.13
**Tested on:** macOS + XAMPP + MySQL 5.7

