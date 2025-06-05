#!/bin/bash

# Auto CI/CD Monitor Script
# This script performs periodic code integrity checks, runs tests, logs results,
# and attempts basic auto-healing.
# It should be triggered every 10 minutes via cron or a CI runner.

REPO_ROOT="$(cd "$(dirname "$0")/.." && pwd)"
LOG_DIR="$REPO_ROOT/logs"
mkdir -p "$LOG_DIR"
TIMESTAMP=$(date +"%Y%m%d-%H%M%S")
LOG_FILE="$LOG_DIR/ci_monitor_$TIMESTAMP.log"

exec > >(tee -a "$LOG_FILE") 2>&1

cd "$REPO_ROOT" || exit 1

function scan_code() {
  echo "[INFO] Scanning code for syntax and linting issues..."
  # PHP lint
  find . -type f -name '*.php' -print0 | xargs -0 -r -n1 php -l
  # JavaScript lint (if ESLint config exists)
  if [ -f package.json ]; then
    npx eslint . || true
  fi
}

function run_tests() {
  echo "[INFO] Running tests..."
  if [ -f artisan ]; then
    php artisan test --parallel || return 1
    if [ -d tests/Browser ]; then
      php artisan dusk || return 1
    fi
  fi
  if [ -f package.json ]; then
    npx jest || return 1
  fi
  return 0
}

function auto_heal() {
  echo "[WARN] Test failures detected. Attempting auto-heal (placeholder)..."
  # Placeholder for auto-healing logic. This could invoke Codex with improved
  # prompts or restore previous working state.
  # For now, we simply exit with failure status.
  return 1
}

scan_code

RETRY_COUNT=0
MAX_RETRIES=3
until run_tests; do
  RETRY_COUNT=$((RETRY_COUNT+1))
  if [ "$RETRY_COUNT" -ge "$MAX_RETRIES" ]; then
    echo "[ERROR] Tests failing after $RETRY_COUNT attempts. Escalating to team."
    exit 1
  fi
  auto_heal || break
  echo "[INFO] Retrying tests ($RETRY_COUNT/$MAX_RETRIES)..."
  sleep 5
done

echo "[INFO] CI/CD monitoring complete."

