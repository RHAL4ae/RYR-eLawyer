"""KYC onboarding module with Emirates ID verification, sanctions screening,
background check, risk scoring, and admin alerting."""
from dataclasses import dataclass
from typing import List


@dataclass
class KYCResult:
    emirates_id_valid: bool
    sanctions_flag: bool
    background_flag: bool
    risk_score: int
    issues: List[str]


def verify_emirates_id(emirates_id: str) -> bool:
    """Mock Emirates ID verification using format check."""
    return emirates_id.isdigit() and len(emirates_id) == 15


def screen_sanctions(name: str, emirates_id: str) -> bool:
    """Mock sanctions screening against open data and MOI API."""
    flagged_ids = {"784197812345678", "784198812345679"}
    return emirates_id in flagged_ids or "sanction" in name.lower()


def background_check(name: str, emirates_id: str) -> bool:
    """Mock police/municipality background check."""
    police_records = {"784197812345678": True}
    municipality_records = {"John Doe": True}
    return police_records.get(emirates_id, False) or municipality_records.get(name, False)


def calculate_risk_score(emirates_id_valid: bool, sanctions_flag: bool, background_flag: bool) -> int:
    score = 0
    if not emirates_id_valid:
        score += 50
    if sanctions_flag:
        score += 40
    if background_flag:
        score += 30
    return min(score, 100)


def send_admin_alert(name: str, result: KYCResult) -> None:
    if result.risk_score >= 70:
        alert_msg = f"ALERT: {name} flagged with risk score {result.risk_score}. Issues: {', '.join(result.issues)}"
        print(alert_msg)


def run_kyc(name: str, emirates_id: str) -> KYCResult:
    emirates_id_valid = verify_emirates_id(emirates_id)
    sanctions_flag = screen_sanctions(name, emirates_id)
    background_flag = background_check(name, emirates_id)

    risk_score = calculate_risk_score(emirates_id_valid, sanctions_flag, background_flag)
    issues = []
    if not emirates_id_valid:
        issues.append("Invalid Emirates ID")
    if sanctions_flag:
        issues.append("Sanctions hit")
    if background_flag:
        issues.append("Background check failed")

    result = KYCResult(
        emirates_id_valid=emirates_id_valid,
        sanctions_flag=sanctions_flag,
        background_flag=background_flag,
        risk_score=risk_score,
        issues=issues,
    )

    send_admin_alert(name, result)
    return result


if __name__ == "__main__":
    import sys

    if len(sys.argv) != 3:
        print("Usage: python onboarding.py <name> <emirates_id>")
        sys.exit(1)

    client_name, client_id = sys.argv[1], sys.argv[2]
    run_kyc(client_name, client_id)
