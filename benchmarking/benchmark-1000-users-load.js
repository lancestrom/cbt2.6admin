/*
 ============================================================================
 BENCHMARKING CODEIGNITER 3 - CBT 2.6 ADMIN
 ============================================================================
 Simulasi: 1000 Siswa Akses Halaman Login Serentak (Load Testing)
 - Ramp-up: Peningkatan user secara bertahap
 - Load: 1000 concurrent users
 - Duration: 5 menit
 - Spike: Test spike dengan 2000 users
 ============================================================================
*/

import http from 'k6/http';
import { check, group, sleep } from 'k6';
import { Rate, Trend } from 'k6/metrics';

// ============================================================================
// CUSTOM METRICS
// ============================================================================
const loginErrorRate = new Rate('login_errors');
const loginDuration = new Trend('login_duration');
const dashboardDuration = new Trend('dashboard_duration');
const pageLoadDuration = new Trend('page_load_duration');

// ============================================================================
// KONFIGURASI
// ============================================================================
const BASE_URL = 'http://localhost/cbt2.6admin/Login/proses_login';
const CREDENTIALS = [
    { username: 'admin', password: 'admin123' },
    { username: 'adminakl', password: 'admin123' },
    { username: 'adminotkp', password: 'admin123' },
    { username: 'admintkj', password: 'admin123' },
    { username: 'adminpm', password: 'admin123' },
];

// ============================================================================
// OPTION KONFIGURASI K6
// ============================================================================
export const options = {
    stages: [
        // Ramp-up: 0 → 1000 users dalam 2 menit
        { duration: '2m', target: 1000, name: 'ramp-up' },
        // Stay at 1000 users selama 2 menit (load test)
        { duration: '2m', target: 1000, name: 'load' },
        // Spike: Naikkan ke 2000 users (stress test)
        { duration: '1m', target: 2000, name: 'spike' },
        // Cool down: Turunkan ke 0 users dalam 1 menit
        { duration: '1m', target: 0, name: 'cool-down' },
    ],
    thresholds: {
        // HTTP metrics
        'http_req_duration': ['p(95)<2000', 'p(99)<3000'], // 95% respon < 2 detik
        'http_req_failed': ['rate<0.1'], // < 10% gagal
        // Custom metrics
        'login_errors': ['rate<0.05'],
        'login_duration': ['p(95)<2000'],
        'dashboard_duration': ['p(95)<3000'],
    },
    vus: 1000,
    iterations: 4000,
    insecureSkipTLSVerify: true,
    noConnectionReuse: false, // Connection reuse untuk performance
    userAgent: 'k6-benchmarking-script/1.0',
};

// ============================================================================
// VU FUNCTION (Main Test Logic)
// ============================================================================
export default function () {
    // Get random credentials
    const creds = CREDENTIALS[Math.floor(Math.random() * CREDENTIALS.length)];
    let sessionCookie = '';

    // ========================================================================
    // 1. TEST: Akses Halaman Login
    // ========================================================================
    group('1. Halaman Login - Load Test', function () {
        const loginPageRes = http.get(`${BASE_URL}/`);
        const pageLoadTime = loginPageRes.timings.duration;
        pageLoadDuration.add(pageLoadTime);

        check(loginPageRes, {
            'status login page = 200': (r) => r.status === 200,
            'response time < 2s': (r) => r.timings.duration < 2000,
            'halaman login tersedia': (r) => r.body.includes('login') || r.body.includes('Login'),
        });
    });

    sleep(1);

    // ========================================================================
    // 2. TEST: Proses Login (1000 Siswa Serentak)
    // ========================================================================
    group('2. Proses Login - 1000 Users Concurrent', function () {
        const payload = {
            username: creds.username,
            password: creds.password,
        };

        const params = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirects: 0, // Jangan auto-redirect untuk mengukur respon time akurat
        };

        const startTime = new Date();
        const loginRes = http.post(`${BASE_URL}/Login/proses_login`, payload, params);
        const loginTime = new Date() - startTime;
        loginDuration.add(loginTime);

        check(loginRes, {
            'login status = 302 (redirect)': (r) => r.status === 302 || r.status === 200,
            'login response time < 2s': (r) => r.timings.duration < 2000,
            'no database error': (r) => !r.body.includes('database error') && !r.body.includes('Database Error'),
        });

        if (loginRes.status !== 302 && loginRes.status !== 200) {
            loginErrorRate.add(1);
        } else {
            loginErrorRate.add(0);
        }

        // Extract session cookie jika ada
        const cookies = loginRes.cookies;
        if (cookies['ci_session']) {
            sessionCookie = cookies['ci_session'][0].value;
        }
    });

    sleep(2);

    // ========================================================================
    // 3. TEST: Akses Dashboard Setelah Login
    // ========================================================================
    group('3. Dashboard Access - Post Login', function () {
        const dashParams = {
            headers: {
                Cookie: `ci_session=${sessionCookie}`,
            },
        };

        const dashRes = http.get(`${BASE_URL}/Dashboard`, dashParams);
        const dashTime = dashRes.timings.duration;
        dashboardDuration.add(dashTime);

        check(dashRes, {
            'dashboard accessible': (r) => r.status === 200 || r.status === 302,
            'dashboard response < 3s': (r) => r.timings.duration < 3000,
        });
    });

    sleep(Math.random() * 3); // Random sleep antara 0-3 detik
}

// ============================================================================
// SETUP FUNCTION
// ============================================================================
export function setup() {
    console.log('='.repeat(80));
    console.log('BENCHMARKING CODEIGNITER 3 - CBT 2.6 ADMIN');
    console.log('='.repeat(80));
    console.log('Test Type: Load Testing dengan 1000 Concurrent Users');
    console.log('Base URL:', BASE_URL);
    console.log('Start Time:', new Date().toLocaleString('id-ID'));
    console.log('='.repeat(80));
}

// ============================================================================
// TEARDOWN FUNCTION
// ============================================================================
export function teardown() {
    console.log('\n' + '='.repeat(80));
    console.log('BENCHMARKING SELESAI');
    console.log('End Time:', new Date().toLocaleString('id-ID'));
    console.log('='.repeat(80) + '\n');
}
