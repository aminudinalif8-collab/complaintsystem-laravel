# Responsive Design - Code Examples

## Complete Examples for Common Patterns

### 1. Responsive Card Grid

```html
<!-- Simple responsive grid that adjusts columns based on screen size -->
<div class="cards-grid">
    <div class="card">
        <h3>Card 1</h3>
        <p>Content here</p>
    </div>
    <div class="card">
        <h3>Card 2</h3>
        <p>Content here</p>
    </div>
    <div class="card">
        <h3>Card 3</h3>
        <p>Content here</p>
    </div>
</div>

<!-- Custom CSS Grid -->
<style>
    .custom-grid {
        display: grid;
        gap: var(--spacing-lg);
        grid-template-columns: 1fr; /* Mobile: 1 column */
    }
    
    @media (min-width: 480px) {
        .custom-grid {
            grid-template-columns: repeat(2, 1fr); /* Tablet: 2 columns */
        }
    }
    
    @media (min-width: 768px) {
        .custom-grid {
            grid-template-columns: repeat(3, 1fr); /* Desktop: 3 columns */
        }
    }
</style>
```

### 2. Responsive Form Layout

```html
<!-- Form with responsive rows -->
<form class="form-responsive">
    <!-- Single column form -->
    <div class="form-row">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" required>
        </div>
    </div>
    
    <!-- Two-column form -->
    <div class="form-row">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" class="form-control">
        </div>
    </div>
    
    <!-- Full-width field -->
    <div class="form-row full-width">
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" class="form-control" rows="4"></textarea>
        </div>
    </div>
    
    <!-- Submit button -->
    <button type="submit" class="btn-responsive btn-primary">
        Submit
    </button>
</form>

<style>
    .form-responsive {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-lg);
    }
    
    .form-row {
        display: grid;
        gap: var(--spacing-lg);
        grid-template-columns: 1fr; /* Mobile: 1 column */
    }
    
    @media (min-width: 480px) {
        .form-row {
            grid-template-columns: repeat(2, 1fr); /* 2 columns on larger screens */
        }
    }
    
    @media (min-width: 768px) {
        .form-row {
            grid-template-columns: repeat(3, 1fr); /* 3 columns on desktop */
        }
    }
    
    .form-row.full-width {
        grid-column: 1 / -1;
    }
</style>
```

### 3. Responsive Navigation

```html
<!-- Responsive navigation with hamburger menu -->
<nav class="navbar">
    <div class="nav-brand">MyApp</div>
    <button class="mobile-menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="nav-menu" id="navMenu">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</nav>

<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--spacing-lg);
        background: white;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
    }
    
    .nav-menu {
        display: flex;
        gap: var(--spacing-xl);
        list-style: none;
    }
    
    /* Mobile: Hide menu and show toggle */
    @media (max-width: 767px) {
        .mobile-menu-toggle {
            display: block;
        }
        
        .nav-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            flex-direction: column;
            gap: 0;
            background: white;
            border-bottom: 1px solid #e0e0e0;
            width: 100%;
        }
        
        .nav-menu.open {
            display: flex;
        }
        
        .nav-menu li {
            padding: var(--spacing-lg);
            border-bottom: 1px solid #f0f0f0;
        }
    }
    
    /* Desktop: Show menu */
    @media (min-width: 768px) {
        .nav-menu {
            display: flex;
        }
    }
</style>

<script>
    // Toggle menu on mobile
    document.getElementById('menuToggle').addEventListener('click', function() {
        const menu = document.getElementById('navMenu');
        menu.classList.toggle('open');
    });
</script>
```

### 4. Responsive Table

```html
<!-- Responsive data table -->
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="ID">001</td>
                <td data-label="Name">John Doe</td>
                <td data-label="Status"><span class="badge">Active</span></td>
                <td data-label="Date">2026-06-22</td>
                <td data-label="Action">
                    <button class="btn-sm">Edit</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<style>
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th,
    .data-table td {
        padding: var(--spacing-md);
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .data-table th {
        background: #f5f5f5;
        font-weight: 600;
    }
    
    /* Mobile: Stack table */
    @media (max-width: 767px) {
        .data-table thead {
            display: none;
        }
        
        .data-table,
        .data-table tbody,
        .data-table tr,
        .data-table td {
            display: block;
            width: 100%;
        }
        
        .data-table tr {
            border: 1px solid #e0e0e0;
            margin-bottom: var(--spacing-lg);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .data-table td {
            padding: var(--spacing-md);
            padding-left: 40%;
            position: relative;
        }
        
        .data-table td[data-label]:before {
            content: attr(data-label);
            position: absolute;
            left: var(--spacing-md);
            font-weight: 600;
            color: #666;
            width: 35%;
        }
    }
</style>
```

### 5. Responsive Hero Section

```html
<!-- Hero section with responsive background -->
<section class="hero">
    <div class="hero-content">
        <h1>Welcome to Our Platform</h1>
        <p>Build amazing applications with responsive design</p>
        <button class="btn-responsive btn-primary btn-lg">Get Started</button>
    </div>
</section>

<style>
    .hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: var(--spacing-4xl) var(--spacing-lg);
        text-align: center;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-content {
        max-width: 600px;
        width: 100%;
    }
    
    .hero h1 {
        font-size: var(--font-2xl);
        margin-bottom: var(--spacing-lg);
    }
    
    .hero p {
        font-size: var(--font-lg);
        margin-bottom: var(--spacing-2xl);
        opacity: 0.9;
    }
    
    /* Mobile */
    @media (max-width: 479px) {
        .hero {
            padding: var(--spacing-3xl) var(--spacing-md);
            min-height: 200px;
        }
        
        .hero h1 {
            font-size: var(--font-xl);
        }
        
        .hero p {
            font-size: var(--font-base);
        }
    }
    
    /* Tablet */
    @media (min-width: 480px) and (max-width: 767px) {
        .hero h1 {
            font-size: clamp(1.5rem, 5vw, 2.2rem);
        }
    }
    
    /* Desktop */
    @media (min-width: 768px) {
        .hero {
            min-height: 400px;
        }
        
        .hero h1 {
            font-size: var(--font-4xl);
        }
    }
</style>
```

### 6. Responsive Two-Column Layout

```html
<!-- Two-column layout that stacks on mobile -->
<div class="two-column">
    <aside class="sidebar">
        <h3>Sidebar</h3>
        <ul>
            <li><a href="#item1">Item 1</a></li>
            <li><a href="#item2">Item 2</a></li>
            <li><a href="#item3">Item 3</a></li>
        </ul>
    </aside>
    <main class="content">
        <h2>Main Content</h2>
        <p>Your content here</p>
    </main>
</div>

<style>
    .two-column {
        display: grid;
        gap: var(--spacing-2xl);
        grid-template-columns: 1fr; /* Mobile: stack */
    }
    
    @media (min-width: 768px) {
        .two-column {
            grid-template-columns: 250px 1fr; /* Tablet+: sidebar + content */
        }
    }
    
    .sidebar {
        background: #f5f5f5;
        padding: var(--spacing-lg);
        border-radius: 8px;
    }
    
    .content {
        flex: 1;
    }
</style>
```

### 7. Mobile-First SCSS Example

```scss
// Import variables and mixins
@import 'variables';

.component {
    // Mobile styles first
    padding: var(--spacing-lg);
    font-size: var(--font-sm);
    grid-template-columns: 1fr;
    
    // Tablet
    @include respond-to-sm {
        padding: var(--spacing-2xl);
    }
    
    // Desktop
    @include respond-to-md {
        padding: var(--spacing-3xl);
        grid-template-columns: repeat(2, 1fr);
    }
    
    // Large desktop
    @include respond-to-lg {
        grid-template-columns: repeat(3, 1fr);
    }
}

.nested {
    // Complex responsive logic
    @include respond-below-md {
        display: none;
    }
    
    @include respond-between-sm-md {
        display: block;
        width: 100%;
    }
}
```

### 8. Responsive Image Gallery

```html
<!-- Responsive image gallery -->
<div class="gallery">
    <figure class="gallery-item">
        <img src="image1.jpg" alt="Gallery item 1" loading="lazy">
        <figcaption>Image 1</figcaption>
    </figure>
    <figure class="gallery-item">
        <img src="image2.jpg" alt="Gallery item 2" loading="lazy">
        <figcaption>Image 2</figcaption>
    </figure>
    <figure class="gallery-item">
        <img src="image3.jpg" alt="Gallery item 3" loading="lazy">
        <figcaption>Image 3</figcaption>
    </figure>
</div>

<style>
    .gallery {
        display: grid;
        grid-template-columns: 1fr;
        gap: var(--spacing-lg);
    }
    
    @media (min-width: 480px) {
        .gallery {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (min-width: 768px) {
        .gallery {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    .gallery-item {
        margin: 0;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .gallery-item figcaption {
        padding: var(--spacing-lg);
        text-align: center;
        background: #f5f5f5;
    }
</style>
```

### 9. Responsive Modal/Dialog

```html
<!-- Modal that adapts to screen size -->
<button class="btn-primary" id="openModal">Open Modal</button>

<div class="modal" id="myModal">
    <div class="modal-content-responsive">
        <button class="modal-close" id="closeModal">&times;</button>
        <h2>Modal Title</h2>
        <p>Modal content goes here</p>
        <button class="btn-primary">Confirm</button>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    
    .modal.show {
        display: flex;
    }
    
    .modal-content-responsive {
        background: white;
        padding: var(--spacing-2xl);
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        position: relative;
    }
    
    .modal-close {
        position: absolute;
        top: 12px;
        right: 12px;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }
    
    /* Mobile */
    @media (max-width: 479px) {
        .modal-content-responsive {
            width: 95%;
            padding: var(--spacing-lg);
            max-height: 90vh;
            overflow-y: auto;
        }
    }
    
    /* Tablet+ */
    @media (min-width: 768px) {
        .modal-content-responsive {
            width: 500px;
        }
    }
</style>

<script>
    const modal = document.getElementById('myModal');
    const openBtn = document.getElementById('openModal');
    const closeBtn = document.getElementById('closeModal');
    
    openBtn.addEventListener('click', () => modal.classList.add('show'));
    closeBtn.addEventListener('click', () => modal.classList.remove('show'));
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('show');
    });
</script>
```

### 10. Responsive Footer

```html
<!-- Responsive footer with multiple columns -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h4>About</h4>
            <ul>
                <li><a href="#about">About Us</a></li>
                <li><a href="#team">Our Team</a></li>
                <li><a href="#careers">Careers</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Products</h4>
            <ul>
                <li><a href="#product1">Product 1</a></li>
                <li><a href="#product2">Product 2</a></li>
                <li><a href="#pricing">Pricing</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Legal</h4>
            <ul>
                <li><a href="#privacy">Privacy</a></li>
                <li><a href="#terms">Terms</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Company Name. All rights reserved.</p>
    </div>
</footer>

<style>
    .footer {
        background: #2a2a2a;
        color: white;
        padding: var(--spacing-3xl) var(--spacing-lg);
    }
    
    .footer-content {
        display: grid;
        gap: var(--spacing-2xl);
        grid-template-columns: 1fr; /* Mobile */
        max-width: 1200px;
        margin: 0 auto var(--spacing-3xl);
    }
    
    @media (min-width: 480px) {
        .footer-content {
            grid-template-columns: repeat(2, 1fr); /* 2 columns */
        }
    }
    
    @media (min-width: 768px) {
        .footer-content {
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
        }
    }
    
    .footer-section h4 {
        margin-bottom: var(--spacing-lg);
    }
    
    .footer-section ul {
        list-style: none;
    }
    
    .footer-section li {
        margin-bottom: var(--spacing-md);
    }
    
    .footer-section a {
        color: #ccc;
        text-decoration: none;
    }
    
    .footer-section a:hover {
        color: white;
    }
    
    .footer-bottom {
        text-align: center;
        border-top: 1px solid #555;
        padding-top: var(--spacing-lg);
    }
</style>
```

## Key Principles

1. **Mobile First**: Always start with mobile styles
2. **Progressive Enhancement**: Add features as screen grows
3. **Use CSS Variables**: Ensures consistency
4. **Use Flexbox/Grid**: For modern, flexible layouts
5. **Avoid Fixed Widths**: Use percentages or flexible units
6. **Test Thoroughly**: Test at all breakpoints
7. **Touch Friendly**: Ensure 44px minimum tap targets
8. **Accessible**: Include proper semantic HTML and ARIA labels

## Testing Tips

- Use Chrome DevTools (F12) → Toggle Device Toolbar (Ctrl+Shift+M)
- Test at common breakpoints: 375px, 480px, 768px, 992px, 1200px
- Test both portrait and landscape
- Test with actual devices when possible
- Check touch interactions on mobile
- Verify no horizontal scrolling on mobile
