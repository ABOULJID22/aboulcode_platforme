Phase 1 migration plan for transforming ABOULCODE into ABOULCODE.

This branch `aboulcode/migration-init` contains non-destructive changes:

- Update environment metadata (APP_NAME, MAIL_FROM_NAME)
- Add initial migrations, models and Filament resources scaffolding for: projects, project_categories, services, blog_categories, blog_posts, contacts, testimonials, media, settings, admins
- Add admin login route `/abouadmin` that will point to a private Filament login

Follow the Phase 1 checklist in the main migration plan before destructive deletions.
