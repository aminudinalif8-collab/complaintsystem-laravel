# Responsive Design Guide - Complaint Management System

## Overview
This project now includes comprehensive responsive design across all media screen sizes. All pages are optimized for mobile, tablet, and desktop viewing.

## Breakpoints
The system uses the following breakpoints for responsive design:

| Breakpoint | Device Type | Width |
|------------|-------------|-------|
| XS | Extra Small (Mobile) | < 480px |
| SM | Small (Mobile) | 480px - 767px |
| MD | Medium (Tablet) | 768px - 991px |
| LG | Large (Desktop) | 992px - 1199px |
| XL | Extra Large | 1200px+ |

## CSS Variables

### Spacing
```css
--spacing-xs: 4px;
--spacing-sm: 8px;
--spacing-md: 12px;
--spacing-lg: 16px;
--spacing-xl: 20px;
--spacing-2xl: 24px;
--spacing-3xl: 32px;
--spacing-4xl: 40px;
```

### Font Sizes
```css
--font-xs: 0.75rem;
--font-sm: 0.875rem;
--font-base: 1rem;
--font-lg: 1.125rem;
--font-xl: 1.25rem;
--font-2xl: 1.5rem;
--font-3xl: 1.875rem;
--font-4xl: 2.25rem;
```

## SCSS Mixins

Use these mixins in your SCSS files for responsive design:

```scss
// Mobile-first approach (SM and above)
@include respond-to-sm {
    // Styles for 480px and above
}

// Tablet and above
@include respond-to-md {
    // Styles for 768px and above
}

// Desktop and above
@include respond-to-lg {
    // Styles for 992px and above
}

// Large desktop
@include respond-to-xl {
    // Styles for 1200px and above
}

// Extra large desktop
@include respond-to-2xl {
    // Styles for 1400px and above
}

// Below medium breakpoint (mobile only)
@include respond-below-md {
    // Styles for < 768px
}

// Between small and medium
@include respond-between-sm-md {
    // Styles for 480px - 767px
}
```

## Responsive Utility Classes

### Responsive Grid
```html
<!-- Responsive cards grid -->
<div class="cards-grid">
    <div class="card">Card 1</div>
    <div class="card">Card 2</div>
    <div class="card">Card 3</div>
</div>
```

**Grid Behavior:**
- Mobile (< 480px): 1 column
- Tablet (480px-767px): 2 columns
- Small Desktop (768px-991px): 3 columns
- Desktop (992px+): 4 columns

### Responsive Forms
```html
<div class="form-row">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control">
    </div>
</div>

<!-- Full width field -->
<div class="form-row full-width">
    <label>Message</label>
    <textarea class="form-control"></textarea>
</div>
```

**Form Behavior:**
- Mobile: Single column
- Tablet (480px+): 2 columns
- Desktop (768px+): Flexible columns based on content

### Responsive Tables
```html
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            <!-- rows -->
        </tbody>
    </table>
</div>
```

### Responsive Buttons
```html
<button class="btn-responsive">
    Button Text
</button>

<!-- Full width button (mobile) -->
<button class="btn-responsive btn-block">
    Full Width Button
</button>
```

### Responsive Tables
```html
<div class="table-responsive">
    <table class="table">
        <!-- table content -->
    </table>
</div>
```

## Hide/Show Utilities

### By Breakpoint
```html
<!-- Hide on mobile, show on tablet+ -->
<div class="hide-mobile show-md">Desktop content</div>

<!-- Show on mobile, hide on tablet+ -->
<div class="show-mobile hide-md">Mobile content</div>

<!-- Hide on small, show on large -->
<div class="hide-sm show-lg">Large screen only</div>
```

### Print Styles
```html
<!-- Hide when printing -->
<div class="hide-print">Won't print</div>

<!-- Show only when printing -->
<div class="show-print">Print only</div>
```

## Responsive Padding & Margins

### Mobile First (Base styles)
```css
.p-responsive-mobile { padding: 16px; }
.py-responsive-mobile { padding: 16px 0; }
.px-responsive-mobile { padding: 0 16px; }
.m-responsive-mobile { margin: 16px; }
```

### Tablet (480px+)
```css
.p-responsive-tablet { padding: 24px; }
.py-responsive-tablet { padding: 24px 0; }
```

### Desktop (768px+)
```css
.p-responsive-desktop { padding: 40px; }
```

## Media Queries in CSS

### Extra Small (< 480px)
```css
@media (max-width: 479px) {
    /* Mobile styles */
}
```

### Small (480px - 767px)
```css
@media (min-width: 480px) and (max-width: 767px) {
    /* Small tablet styles */
}
```

### Medium (768px - 991px)
```css
@media (min-width: 768px) and (max-width: 991px) {
    /* Tablet styles */
}
```

### Large (992px+)
```css
@media (min-width: 992px) {
    /* Desktop styles */
}
```

## Best Practices

### 1. Mobile-First Approach
Always start with mobile styles, then add breakpoints for larger screens:

```css
.card {
    padding: 12px;
    grid-template-columns: 1fr;
}

@media (min-width: 768px) {
    .card {
        padding: 20px;
        grid-template-columns: repeat(2, 1fr);
    }
}
```

### 2. Use Flexible Units
```css
/* Good */
width: 100%;
max-width: 800px;
padding: var(--spacing-lg);
font-size: clamp(0.875rem, 2.5vw, 1rem);

/* Avoid */
width: 800px;
padding: 20px;
```

### 3. Touch-Friendly Elements
```css
/* Ensure touch targets are at least 44px */
button, a {
    min-height: 44px;
    min-width: 44px;
    padding: 12px 16px;
}
```

### 4. Prevent Horizontal Scrolling
```css
body, html {
    overflow-x: hidden;
}

* {
    max-width: 100%;
}
```

### 5. Font Size on Mobile
Always use at least 16px font size on form inputs to prevent iOS zoom:

```css
input, select, textarea {
    font-size: 16px;
}

@media (min-width: 768px) {
    input, select, textarea {
        font-size: 14px;
    }
}
```

## Accessibility

### Prefers Reduced Motion
All animations are disabled for users who prefer reduced motion:

```css
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}
```

### Dark Mode Support
The system supports dark mode through `prefers-color-scheme`:

```css
@media (prefers-color-scheme: dark) {
    body {
        background: #1a1a1a;
        color: #e0e0e0;
    }
}
```

## Testing Responsive Design

### Using Browser DevTools
1. Open Chrome DevTools (F12 or Ctrl+Shift+I)
2. Click the device toggle (Ctrl+Shift+M)
3. Test at different breakpoints:
   - iPhone SE (375px)
   - iPhone 12 (390px)
   - iPad (768px)
   - iPad Pro (1024px)

### Key Testing Points
- ✅ Navigation on mobile
- ✅ Form inputs are easy to use
- ✅ Tables are readable
- ✅ Images scale properly
- ✅ Text is readable (no tiny fonts)
- ✅ No horizontal scrolling
- ✅ Touch targets are 44px+
- ✅ Orientation changes work

## Common Responsive Patterns

### Sidebar Navigation
The sidebar automatically:
- Hides on mobile (< 768px)
- Collapses to 80px icon bar at 780px
- Shows fully on tablet+ (> 768px)

### Cards Grid
```html
<div class="cards-grid">
    <!-- Cards automatically adjust: 1 → 2 → 3 → 4 columns -->
</div>
```

### Responsive Images
```html
<img src="image.jpg" class="img-responsive" alt="Description">
```

### Flexible Container
```html
<div class="container-responsive">
    <!-- Automatically adjusts padding and max-width -->
</div>
```

## Viewport Meta Tag
All pages include the proper viewport meta tag:

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

This is already configured in `resources/views/layouts/app.blade.php`.

## Browser Support
The responsive design works on:
- Chrome/Chromium 60+
- Firefox 60+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Resources
- [MDN - Responsive Web Design](https://developer.mozilla.org/en-US/docs/Learn/CSS/CSS_layout/Responsive_Design)
- [Bootstrap Responsive Grid](https://getbootstrap.com/docs/5.3/layout/grid/)
- [CSS Media Queries](https://developer.mozilla.org/en-US/docs/Web/CSS/Media_Queries)
- [W3C Mobile Accessibility](https://www.w3.org/WAI/standards-guidelines/wcag/)

## Support
For questions or issues with responsive design, please refer to:
1. Check this guide
2. Review existing implementations in `resources/views/`
3. Inspect the `resources/css/responsive.css` file
4. Check SCSS mixins in `resources/sass/_variables.scss`
