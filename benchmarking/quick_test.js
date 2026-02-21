import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  stages: [
    { duration: '30s', target: 100 },
    { duration: '30s', target: 0 },
  ],
  thresholds: {
    'http_req_duration': ['p(95)<2000'],
    'http_req_failed': ['rate<0.1'],
  },
};

export default function () {
  const res = http.get('http://localhost/cbt2.6admin/Login/proses_login');
  check(res, {
    'status is 200': (r) => r.status === 200,
  });
  sleep(1);
}
