Clinic Management SaaS - Laravel 13 Migration Package
====================================================
Source: Clinic_Management_SaaS_Full_Product_Database_v1.0.sql
Architecture: shared Laravel application + isolated tenant database per tenant

Directories:
  database/migrations/platform  -> central control-plane DB migrations
  database/migrations/tenant    -> tenant operational DB template migrations

Laravel 13 notes: these are anonymous class migrations with an explicit $connection property. Laravel supports anonymous migrations and schema-builder foreign keys/indexes; run platform migrations against the platform connection and tenant migrations against the dynamically resolved tenant connection.

Important: because the tenant DB is dynamically selected, a TenantDatabaseMigrator service/command should set the tenant connection config before invoking the tenant migration repository. Do not expose tenant credentials to application clients.

This package mirrors the SQL baseline. Before production, run migrations in a disposable environment, compare the resulting schema with the approved ERD/LLD, and add application-specific seeders separately.

Generated table counts: platform=18, tenant=304, total=322.
