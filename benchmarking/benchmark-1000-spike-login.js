/*
 ============================================================================
 STRESS TEST - 1000 SISWA LOGIN SERENTAK (SpikeTest)
 ============================================================================
 Simulasi: 1000 Siswa Login Bersamaan dalam Waktu Singkat
 - Scenario: Semua 1000 user login dalam 30 detik
 - Maintenance: Keep logged in untuk 2 menit
 - Pengukuran: Database load, Session handling, Memory usage
 ============================================================================
*/

import http from 'k6/http';
import { check, group, sleep } from 'k6';
import { Rate, Trend, Counter } from 'k6/metrics';

// ============================================================================
// CUSTOM METRICS
// ============================================================================
const successfulLogins = new Counter('successful_logins');
const failedLogins = new Counter('failed_logins');
const loginResponseTime = new Trend('login_response_time');
const databaseQueryTime = new Trend('db_query_time');
const sessionCreationTime = new Trend('session_creation_time');

// ============================================================================
// KONFIGURASI
// ============================================================================
const BASE_URL = 'http://localhost/cbt2.6admin/Login/proses_login';
const TOTAL_USERS = 1000;
const LOGIN_WINDOW = 30; // Semua harus login dalam 30 detik

// Data 1000 siswa (simulasi)
const generateStudentCredentials = () => {
    const students = [];
    const roles = ['admin', 'adminakl', 'adminotkp', 'admintkj', 'adminpm'];

    for (let i = 1; i <= TOTAL_USERS; i++) {
        const roleIdx = (i - 1) % roles.length;
        students.push({
            id: i,
            username: `${roles[roleIdx]}_${i}`,
            password: 'admin123',
            role: roles[roleIdx],
        });
    }
    return students;
};

const STUDENTS = generateStudentCredentials();

// ============================================================================
// OPTION K6
// ============================================================================
export const options = {
    stages: [
        // Spike: Naikkan semua 1000 users dalam 30 detik
        { duration: '30s', target: 1000, name: 'spike-login' },
        // Maintain: Pertahankan selama 2 menit
        { duration: '2m', target: 1000, name: 'maintain-load' },
        // Cool down: Turunkan dalam 30 detik
        { duration: '30s', target: 0, name: 'cool-down' },
    ],
    thresholds: {
        'http_req_duration': ['p(95)<2500', 'p(99)<4000'],
        'http_req_failed': ['rate<0.15'], // Lebih relaks karena stress test
        'successful_logins': ['value>850'], // Minimal 85% success
        'login_response_time': ['p(95)<2500'],
    },
    vus: TOTAL_USERS,
    iterations: TOTAL_USERS * 3, // Setiap VU melakukan 3 iterasi
    noConnectionReuse: false,
};

// ============================================================================
// VU FUNCTION - MAIN TEST LOGIC
// ============================================================================
export default function () {
    const vuId = __VU; // VU ID dari k6
    const student = STUDENTS[vuId % TOTAL_USERS];

    // ========================================================================
    // 1. LOAD: Halaman Login
    // ========================================================================
    group('1. Load Login Page', function () {
        const res = http.get(`${BASE_URL}/`);
        check(res, {
            'halaman login loaded': (r) => r.status === 200,
            'response time acceptable': (r) => r.timings.duration < 1000,
        });
    });

    // Random delay memastikan tidak semua hit database bersamaan
    sleep(Math.random() * 2);

    // ========================================================================
    // 2. LOGIN: Serentak dengan 1000 users lain
    // ========================================================================
    group('2. Concurrent Login - 1000 Users', function () {
        const payload = {
            username: student.username,
            password: student.password,
        };

        const params = {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Forwarded-For': `192.168.${Math.floor(vuId / 256)}.${vuId % 256}`,
            },
            redirects: 0,
        };

        const startTime = Date.now();
        const res = http.post(`${BASE_URL}/Login/proses_login`, payload, params);
        const responseTime = Date.now() - startTime;

        loginResponseTime.add(responseTime);

        if (res.status === 302 || res.status === 200) {
            successfulLogins.add(1);
        } else {
            failedLogins.add(1);
        }

        check(res, {
            'login berhasil': (r) => r.status === 302 || r.status === 200,
            'status code bukan error': (r) => r.status < 500,
            'response time < 3s': (r) => r.timings.duration < 3000,
            'tidak ada database error': (r) => !r.body.includes('database') && !r.body.includes('error'),
        });
    });

    sleep(2);

    // ========================================================================
    // 3. DASHBOARD: Akses halaman utama setelah login
    // ========================================================================
    group('3. Dashboard Access Post-Login', function () {
        const res = http.get(`${BASE_URL}/Dashboard`);
        check(res, {
            'dashboard bisa diakses': (r) => r.status === 200 || r.status === 302,
            'response time < 2s': (r) => r.timings.duration < 2000,
        });
    });

    // Random idling
    sleep(Math.random() * 3);

    // ========================================================================
    // 4. ACTION: Simulasi aktivitas user (polling, data load)
    // ========================================================================
    group('4. User Activity - Data Load', function () {
        const res = http.get(`${BASE_URL}/Dashboard`);
        check(res, {
            'data loaded': (r) => r.status === 200,
            'performance acceptable': (r) => r.timings.duration < 2500,
        });
    });
}

// ============================================================================
// SETUP
// ============================================================================
export function setup() {
    const currentTime = new Date().toLocaleString('id-ID');
    console.log('\n' + '='.repeat(100));
    console.log('STRESS TEST - 1000 SISWA LOGIN SERENTAK');
    console.log('='.repeat(100));
    console.log(`Start Time: ${currentTime}`);
    console.log(`Total Users: ${TOTAL_USERS}`);
    console.log(`Login Window: ${LOGIN_WINDOW} detik`);
    console.log(`Base URL: ${BASE_URL}`);
    console.log(`Threshold Success Rate: 85%`);
    console.log('='.repeat(100));
}

// ============================================================================
// TEARDOWN
// ============================================================================
export function teardown() {
    const currentTime = new Date().toLocaleString('id-ID');
    console.log('\n' + '='.repeat(100));
    console.log('STRESS TEST SELESAI');
    console.log(`End Time: ${currentTime}`);
    console.log('='.repeat(100) + '\n');
}
