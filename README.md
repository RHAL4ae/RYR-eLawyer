# RYReLawyer (المحامي) – AI-Driven Legal SaaS Platform

**RYReLawyer (المحامي)** is a full-featured, multi-tenant SaaS platform for legal practice management in the UAE/MENA region. Built with Laravel 10+, Vue 3, and advanced AI/automation, it enables law firms to streamline case handling, automate document workflows, integrate with government/court APIs, and meet the highest compliance/security standards.

## Features

- Multi-tenant SaaS: Secure, isolated databases for each law firm
- UAE Pass & WebAuthn authentication, 2FA, device management
- Advanced case, client, and court management (CRUD, calendar, e-Filing)
- AI-powered legal drafting, sentiment analysis, outcome prediction
- KYC, AML, and sanctions checks; police and business registry integration
- Digital document handling: OCR, e-Notary, digital signature, blockchain verification
- Finance: DubaiPay, AD Pay, VAT, ERPNext/Odoo integration
- Business intelligence dashboards, custom reporting, legal knowledge graph
- Mobile PWA/iOS/Android, RESTful API & webhooks
- Privacy-by-design, GDPR/UAE/ISO compliance

## Quick Start

1. **Clone this repository:**
   ```sh
   git clone https://github.com/your-org/ryrelawyer.git
   cd ryrelawyer
   ```
2. **Copy `.env.example` to `.env` and configure environment variables.**
3. **Install dependencies:**
   ```sh
   composer install
   npm install
   ```
4. **Start local services (Docker recommended):**
   ```sh

   docker-compose up -d
   ```
5. **Run migrations and seeders:**
   ```sh
   php artisan migrate --seed
   ```
6. **Serve the app:**
   ```sh
   php artisan serve
   ```

### KYC Module Example
Run a mock KYC check:
```bash
python kyc/onboarding.py "John Doe" 784197812345678
```

## Documentation

- [VIPE Master Doc](./docs/RYReLawyer_VIPE_Master_Latest_Enhanced.md)
- [Agent Onboarding & Sprint Guide](./docs/RYReLawyer_Agent_Onboarding_Sprint_Codex.md)

## Contributing

Contributions are welcome! Please read the [contribution guidelines](./CONTRIBUTING.md) before submitting PRs or issues.

## License

See [LICENSE](./LICENSE) for details.

## Maintainers

- Rami Kamel, LegalTech Product Owner
- AI Agent Orchestrator
- LegalTech Engineering Team

---

*Built with ❤️ for UAE/MENA legal innovators.*
