import os
import sys
import pytest

# Ensure the kyc package can be imported when tests are run from different cwd
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), '..', '..')))

from kyc.onboarding import verify_emirates_id, screen_sanctions, background_check, calculate_risk_score


def test_verify_emirates_id_valid():
    assert verify_emirates_id("784197812345678")


def test_verify_emirates_id_invalid():
    assert not verify_emirates_id("123")


def test_sanctions_hit():
    assert screen_sanctions("Sanctioned Person", "784197812345678")


def test_background_check():
    assert background_check("John Doe", "123456789012345")


def test_risk_score():
    score = calculate_risk_score(False, True, True)
    assert score >= 70
