# Authentication Setup

This project uses **Laravel Fortify** for authentication with a UAE Pass single sign-on flow. The official UAE Pass PHP SDK is used to integrate with UAE Pass.

## UAE Pass SSO

- UAE Pass is the primary login method for regular users.
- Administrators can still sign in using email and password as a fallback.
- Environment variables required:

```
UAE_PASS_CLIENT_ID=your-client-id
UAE_PASS_CLIENT_SECRET=your-client-secret
UAE_PASS_REDIRECT_URI=https://example.com/auth/uae-pass/callback
UAE_PASS_CERT_PATH=/path/to/certificate.pem
UAE_PASS_CERT_PASSWORD=your-cert-password
```

## Two-Factor & WebAuthn

- Fortify is configured with WebAuthn to support FIDO2 security keys (YubiKey, Titan, etc.).
- Standard TOTP-based two-factor authentication is enabled as a backup.
- Device and session management allows users to view and revoke active sessions.

For a production deployment, ensure HTTPS is enforced and security keys are registered via the WebAuthn flow.

