# Agent Memory

## Project Context

This is a Laravel-based Portfolio CMS project.

## Search Box Configuration (Important)

**Commit: `02c8a87` - "Change search box slide direction to right"**

The search box in the navbar slides from the search icon position to the **right side**. This is the correct/working state.

If you want to revert to this state later:
```bash
git reset --hard 02c8a87
git push origin main --force
```

**Files involved:**
- `resources/views/front/partials/navbar.blade.php` - HTML structure with `.search-icon-wrap` wrapper
- `public/assets/css/front.css` - CSS with `transform: translateX(100%)` for right slide
- `resources/views/front/layouts/app.blade.php` - JavaScript for toggle functionality
