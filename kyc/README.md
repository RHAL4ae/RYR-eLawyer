# KYC Module

This module implements a simplified Know Your Customer (KYC) process used for client onboarding.
It provides mock integrations for:

- **Emirates ID verification** – simple format check.
- **Sanctions screening** – checks sample flagged IDs and names.
- **Background check** – simulates police and municipality queries.
- **Risk scoring** – assigns a score based on the results.
- **Admin alert** – prints an alert when risk score is high.

Run an example check:

```bash
python kyc/onboarding.py "John Doe" 784197812345678
```
