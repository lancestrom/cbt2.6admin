#!/bin/bash

# ============================================================================
# SETUP BENCHMARKING ENVIRONMENT
# Run this script one time to prepare the benchmarking suite
# ============================================================================

set -e

# Colors
GREEN='\033[0;32m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}=== K6 Benchmarking Setup ===${NC}"
echo ""

# Get script directory
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Make scripts executable
echo "Setting up permissions..."
chmod +x "$SCRIPT_DIR/benchmark.sh"
chmod +x "$SCRIPT_DIR"/*.js 2>/dev/null || true

# Create results directory
mkdir -p "$SCRIPT_DIR/results"
mkdir -p "$SCRIPT_DIR/logs"

echo -e "${GREEN}✅ Permissions set${NC}"
echo ""

# Check k6
if ! command -v k6 &> /dev/null; then
    echo -e "❌ k6 tidak terinstall"
    echo ""
    echo "Install dengan: brew install k6"
    exit 1
fi

K6_VERSION=$(k6 version)
echo -e "${GREEN}✅ k6 installed: $K6_VERSION${NC}"
echo ""

# Test server connectivity
echo "Testing server connectivity..."
if curl -s --connect-timeout 5 "http://localhost/cbt2.6admin/Login/proses_login" > /dev/null 2>&1; then
    echo -e "${GREEN}✅ Server is running${NC}"
else
    echo -e "⚠️  Server not running"
    echo "   Start XAMPP and try again"
fi

echo ""
echo -e "${BLUE}=== Setup Complete ===${NC}"
echo ""/
echo "To run benchmarks:"
echo "  cd $SCRIPT_DIR"
echo "  ./benchmark.sh"
echo ""
echo "Documentation:"
echo "  - README.md (Quick start)"
echo "  - BENCHMARKING_GUIDE.md (Detailed analysis)"
echo "  - CONFIGURATION_GUIDE.md (System optimization)"
echo ""
