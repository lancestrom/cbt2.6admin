#!/bin/bash

# ============================================================================
# K6 BENCHMARK RUNNER SCRIPT
# Memudahkan menjalankan test benchmarking CodeIgniter 3
# ============================================================================

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
BASE_URL="http://localhost/cbt2.6admin/Login/proses_login"
RESULTS_DIR="$SCRIPT_DIR/results"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

# ============================================================================
# Functions
# ============================================================================

print_header() {
    echo -e "${BLUE}========================================${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}========================================${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ️ $1${NC}"
}

check_k6() {
    if ! command -v k6 &> /dev/null; then
        print_error "k6 tidak terinstall"
        echo ""
        echo "Install k6 dengan perintah:"
        echo "  brew install k6"
        echo ""
        echo "Atau download dari: https://k6.io/docs/getting-started/installation/"
        exit 1
    fi
    
    K6_VERSION=$(k6 version)
    print_success "k6 terinstall: $K6_VERSION"
}

check_server() {
    print_info "Checking server availability: $BASE_URL"
    
    if ! curl -s --connect-timeout 5 "$BASE_URL" > /dev/null 2>&1; then
        print_error "Server tidak dapat diakses: $BASE_URL"
        print_info "Pastikan XAMPP sudah berjalan dan akses URL di browser"
        exit 1
    fi
    
    print_success "Server siap: $BASE_URL"
}

create_results_dir() {
    if [ ! -d "$RESULTS_DIR" ]; then
        mkdir -p "$RESULTS_DIR"
        print_success "Direktori hasil dibuat: $RESULTS_DIR"
    fi
}

run_load_test() {
    print_header "LOAD TEST - 1000 Concurrent Users (6 Menit)"
    print_info "Test Skenario:"
    print_info "  - Ramp-up: 0-1000 users (2 menit)"
    print_info "  - Load Test: 1000 users (2 menit)"
    print_info "  - Spike: 1000-2000 users (1 menit)"
    print_info "  - Cool Down: 2000-0 users (1 menit)"
    echo ""
    
    RESULTS_FILE="$RESULTS_DIR/load_test_${TIMESTAMP}.json"
    
    print_info "Running test... (Perkiraan 6 menit)"
    echo ""
    
    k6 run \
        --out json="$RESULTS_FILE" \
        "$SCRIPT_DIR/benchmark-1000-users-load.js" 2>&1 | tee "$RESULTS_DIR/load_test_${TIMESTAMP}.log"
    
    if [ ${PIPESTATUS[0]} -eq 0 ]; then
        print_success "Load test selesai!"
        print_info "Results: $RESULTS_FILE"
        print_info "Log: $RESULTS_DIR/load_test_${TIMESTAMP}.log"
    else
        print_error "Load test gagal!"
        exit 1
    fi
}

run_spike_test() {
    print_header "SPIKE TEST - 1000 Siswa Login Serentak (3 Menit)"
    print_info "Test Skenario:"
    print_info "  - Login Spike: 0-1000 users dalam 30 detik"
    print_info "  - Maintain: 1000 users (2 menit)"
    print_info "  - Cool Down: 1000-0 users (30 detik)"
    echo ""
    
    RESULTS_FILE="$RESULTS_DIR/spike_test_${TIMESTAMP}.json"
    
    print_info "Running test... (Perkiraan 3 menit)"
    echo ""
    
    k6 run \
        --out json="$RESULTS_FILE" \
        "$SCRIPT_DIR/benchmark-1000-spike-login.js" 2>&1 | tee "$RESULTS_DIR/spike_test_${TIMESTAMP}.log"
    
    if [ ${PIPESTATUS[0]} -eq 0 ]; then
        print_success "Spike test selesai!"
        print_info "Results: $RESULTS_FILE"
        print_info "Log: $RESULTS_DIR/spike_test_${TIMESTAMP}.log"
    else
        print_error "Spike test gagal!"
        exit 1
    fi
}

run_quick_test() {
    print_header "QUICK TEST - 100 Users (1 Menit)"
    print_info "Test ringan untuk verifikasi"
    echo ""
    
    cat > "$SCRIPT_DIR/quick_test.js" << 'EOF'
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
EOF

    k6 run "$SCRIPT_DIR/quick_test.js"
    rm "$SCRIPT_DIR/quick_test.js"
}

run_endurance_test() {
    print_header "ENDURANCE TEST - 500 Users (15 Menit)"
    print_info "Test ketahanan jangka panjang"
    print_warning "Test ini akan berjalan lama (15 menit)"
    echo ""
    
    read -p "Lanjutkan? (y/n) " -n 1 -r
    echo
    
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        RESULTS_FILE="$RESULTS_DIR/endurance_test_${TIMESTAMP}.json"
        
        print_info "Running test... (Perkiraan 15 menit)"
        echo ""
        
        k6 run \
            --stage 5m:500 \
            --stage 5m:500 \
            --stage 5m:500 \
            --out json="$RESULTS_FILE" \
            "$SCRIPT_DIR/benchmark-1000-users-load.js" 2>&1 | tee "$RESULTS_DIR/endurance_test_${TIMESTAMP}.log"
        
        print_success "Endurance test selesai!"
    else
        print_info "Test dibatalkan"
    fi
}

open_results_folder() {
    if [ -d "$RESULTS_DIR" ] && [ "$(ls -A $RESULTS_DIR)" ]; then
        print_info "Opening results folder..."
        open "$RESULTS_DIR"
    else
        print_warning "Folder hasil kosong atau tidak ada"
    fi
}

system_info() {
    print_header "INFORMASI SISTEM"
    
    echo "System Information:"
    echo "  OS: $(uname -s)"
    echo "  CPU: $(sysctl -n hw.ncpu) cores"
    echo "  Memory: $(sysctl -n hw.memsize | awk '{print $1 / 1024 / 1024 / 1024 " GB"}')"
    echo ""
    
    print_info "K6 Version:"
    k6 version
    echo ""
    
    print_info "Server Status:"
    if curl -s --connect-timeout 5 "$BASE_URL" > /dev/null 2>&1; then
        print_success "Server OK: $BASE_URL"
    else
        print_error "Server DOWN: $BASE_URL"
    fi
    echo ""
    
    print_info "Database Status:"
    mysql -u root -e "SELECT 1" > /dev/null 2>&1 && print_success "MySQL OK" || print_error "MySQL DOWN"
    echo ""
    
    print_info "Available Results:"
    if [ -d "$RESULTS_DIR" ] && [ "$(ls -A $RESULTS_DIR)" ]; then
        ls -lh "$RESULTS_DIR"
    else
        echo "  No results yet"
    fi
}

show_menu() {
    echo ""
    print_header "K6 BENCHMARK MENU"
    echo ""
    echo "  1) Load Test (1000 Users, 6 menit)"
    echo "  2) Spike Test (1000 Login Serentak, 3 menit)"
    echo "  3) Quick Test (100 Users, 1 menit)"
    echo "  4) Endurance Test (500 Users, 15 menit)"
    echo "  5) System Info"
    echo "  6) Open Results Folder"
    echo "  0) Exit"
    echo ""
    read -p "Pilih opsi (0-6): " choice
}

# ============================================================================
# Main Script
# ============================================================================

main() {
    print_header "K6 BENCHMARK RUNNER untuk CodeIgniter 3"
    
    # Check prerequisites
    check_k6
    check_server
    create_results_dir
    
    echo ""
    
    # Main loop
    while true; do
        show_menu
        
        case $choice in
            1)
                run_load_test
                ;;
            2)
                run_spike_test
                ;;
            3)
                run_quick_test
                ;;
            4)
                run_endurance_test
                ;;
            5)
                system_info
                ;;
            6)
                open_results_folder
                ;;
            0)
                print_info "Exiting..."
                exit 0
                ;;
            *)
                print_error "Pilihan tidak valid"
                ;;
        esac
    done
}

# Run main if script is executed
if [ "${BASH_SOURCE[0]}" == "${0}" ]; then
    main "$@"
fi
