import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
    vus: 1000,
    duration: '30s',
};

export default function () {

    let payload = {
        username: `siswa${__VU}`,
        password: '123456'
    };

    let res = http.post(
        'http://localhost/cbt2.6admin/login/proses_login',
        payload
    );

    check(res, {
        'login success': (r) => r.status === 200,
        'response < 800ms': (r) => r.timings.duration < 800,
    });

    sleep(1);
}