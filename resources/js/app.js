import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

function createNavbarSearch(initialQuery = '') {
    return {
        mobileMenuOpen: false,
        userMenuOpen: false,
        isSearchOpen: false,
        searchQuery: initialQuery || '',

        openSearch() {
            this.isSearchOpen = true;
            this.userMenuOpen = false;
            this.mobileMenuOpen = false;
            this.focusSearch();
        },

        closeSearch() {
            this.isSearchOpen = false;
        },

        toggleSearch() {
            if (this.isSearchOpen) {
                this.closeSearch();
                return;
            }

            this.openSearch();
        },

        focusSearch() {
            this.$nextTick(() => {
                this.$refs.searchInput?.focus({ preventScroll: true });
            });
        },

        handleSearchShortcut(event) {
            if (event.key === 'Escape') {
                this.closeSearch();
                return;
            }

            if (event.key !== '/' || event.ctrlKey || event.metaKey || event.altKey) {
                return;
            }

            const target = event.target;
            const typingTarget = target?.isContentEditable
                || ['INPUT', 'TEXTAREA', 'SELECT'].includes(target?.tagName);

            if (typingTarget) {
                return;
            }

            event.preventDefault();

            if (!this.isSearchOpen) {
                this.openSearch();
                return;
            }

            this.focusSearch();
        },
    };
}

window.navbarSearch = createNavbarSearch;

function createSignupPage(config = {}) {
    return {
        formData: {
            name: config.name || '',
            email: config.email || '',
            password: '',
            password_confirmation: '',
            terms: false,
        },
        selectedRole: config.role || 'student',
        errors: {},
        showPassword: false,
        showConfirmPassword: false,
        loading: false,

        passwordChecks() {
            const value = this.formData.password || '';

            return {
                length: value.length >= 8,
                letter: /[A-Za-z]/.test(value),
                number: /[0-9]/.test(value),
                special: /[^A-Za-z0-9]/.test(value),
            };
        },

        passwordRuleMet(rule) {
            return Boolean(this.passwordChecks()[rule]);
        },

        isValidEmail(value) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        },

        validate() {
            const errors = {};
            const checks = this.passwordChecks();

            if (!['student', 'teacher'].includes(this.selectedRole)) {
                errors.user_type = 'Please choose a profile type.';
            }

            if (!this.formData.name.trim()) {
                errors.name = 'Full name is required.';
            }

            if (!this.formData.email.trim()) {
                errors.email = 'Email is required.';
            } else if (!this.isValidEmail(this.formData.email)) {
                errors.email = 'Please enter a valid email address.';
            }

            if (!this.formData.password) {
                errors.password = 'Password is required.';
            } else if (!(checks.length && checks.letter && checks.number && checks.special)) {
                errors.password = 'Password must match all requirements.';
            }

            if (!this.formData.password_confirmation) {
                errors.password_confirmation = 'Please confirm your password.';
            } else if (this.formData.password_confirmation !== this.formData.password) {
                errors.password_confirmation = 'Passwords do not match.';
            }

            if (!this.formData.terms) {
                errors.terms = 'You must accept the terms and privacy policy.';
            }

            this.errors = errors;

            return Object.keys(errors).length === 0;
        },

        clearError(field) {
            if (this.errors[field]) {
                delete this.errors[field];
                this.errors = { ...this.errors };
            }
        },

        handleSubmit(event) {
            if (!this.validate()) {
                event.preventDefault();
                this.loading = false;
                return;
            }

            this.loading = true;
        },
    };
}

function createLoginPage(config = {}) {
    return {
        email: config.email || '',
        password: '',
        rememberMe: Boolean(config.rememberMe),
        showPassword: false,
        errors: config.hasServerErrors ? { general: 'The email or password is incorrect.' } : {},
        loading: false,

        isValidEmail(value) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        },

        validate() {
            const errors = {};

            if (!this.email.trim()) {
                errors.email = 'Email is required.';
            } else if (!this.isValidEmail(this.email)) {
                errors.email = 'Please enter a valid email address.';
            }

            if (!this.password) {
                errors.password = 'Password is required.';
            }

            this.errors = errors;

            return Object.keys(errors).length === 0;
        },

        clearError(field) {
            if (this.errors[field]) {
                delete this.errors[field];
                this.errors = { ...this.errors };
            }

            if (this.errors.general) {
                delete this.errors.general;
                this.errors = { ...this.errors };
            }
        },

        handleSubmit(event) {
            if (!this.validate()) {
                event.preventDefault();
                this.loading = false;
                return;
            }

            this.loading = true;
        },
    };
}
window.signupPage = createSignupPage;
window.loginPage = createLoginPage;

Alpine.data('navbarSearch', createNavbarSearch);
Alpine.data('signupPage', createSignupPage);
Alpine.data('loginPage', createLoginPage);
Alpine.start();


const userType = document.getElementById('user-type');
const otherFieldContainer = document.getElementById('other-field-container');

if (userType && otherFieldContainer) {
    userType.addEventListener('change', function () {
        if (this.value === 'Autres') {
            otherFieldContainer.classList.remove('hidden');
        } else {
            otherFieldContainer.classList.add('hidden');
        }
    });
}
// Theme is managed centrally inside the DOMContentLoaded handler below.
// Removed duplicate early theme-handling code to avoid conflicts with blade inline scripts.


 
document.addEventListener('DOMContentLoaded', () => {
    // --- Gestion du Menu Mobile ---
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const openIcon = document.getElementById('menu-icon-open');
    const closeIcon = document.getElementById('menu-icon-close');

    if (mobileMenuToggle && mobileMenu && openIcon && closeIcon) {
        mobileMenuToggle.addEventListener('click', () => {
            const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
            mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle des classes pour l'animation
            mobileMenu.classList.toggle('opacity-0');
            mobileMenu.classList.toggle('scale-95');
            mobileMenu.classList.toggle('pointer-events-none');
            
            // Toggle des icônes
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }

    // --- Gestion du Thème (Dark/Light Mode) ---
    const html = document.documentElement;

    // Helpers to update icons on every `.theme-toggle` button
    function refreshThemeIcons(dark) {
        document.querySelectorAll('.theme-toggle').forEach(btn => {
            const light = btn.querySelector('.theme-icon-light');
            const darkIcon = btn.querySelector('.theme-icon-dark');
            if (light) light.classList.toggle('hidden', dark);
            if (darkIcon) darkIcon.classList.toggle('hidden', !dark);
            btn.setAttribute('aria-pressed', dark ? 'true' : 'false');
        });
    }

    // Initialize theme from localStorage or system. Filament may store "system".
    let storedTheme = null;

    try {
        storedTheme = localStorage.getItem('theme');
    } catch (error) {
        storedTheme = null;
    }

    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const prefersDark = storedTheme === 'dark' || ((storedTheme === null || storedTheme === 'system') && systemPrefersDark);


    // Deterministic setter to avoid race conditions
    function setTheme(dark) {
        if (dark) {
            html.classList.add('dark');
            html.dataset.theme = 'dark';
            try {
                localStorage.setItem('theme', 'dark');
            } catch (error) {}
            html.style.colorScheme = 'dark';
        } else {
            html.classList.remove('dark');
            html.dataset.theme = 'light';
            try {
                localStorage.setItem('theme', 'light');
            } catch (error) {}
            html.style.colorScheme = 'light';
        }
        refreshThemeIcons(dark);
    }

    // Initialize theme
    setTheme(prefersDark);

    // Expose a global toggle for compatibility
    window.toggleTheme = function () {
        const willBeDark = !html.classList.contains('dark');
        setTheme(willBeDark);
        return willBeDark;
    };

    // Attach direct handlers to each `.theme-toggle` to avoid delegation edge-cases
    const themeButtons = document.querySelectorAll('.theme-toggle');
    
    themeButtons.forEach((btn, index) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            window.toggleTheme();
        });
    });

    // Reapply theme a few times to resist other scripts that may override it
    let reapplyAttempts = 0;
    const reapplyInterval = setInterval(() => {
        const current = html.classList.contains('dark');
        const desired = html.dataset.theme === 'dark';
        if (current !== desired) {
            html.classList.toggle('dark', desired);
            refreshThemeIcons(desired);
        }
        reapplyAttempts++;
        if (reapplyAttempts >= 8) clearInterval(reapplyInterval);
    }, 150);

    // Also ensure the theme is applied on window load and when tab visibility changes
    window.addEventListener('load', () => {
        const desired = html.dataset.theme === 'dark';
        html.classList.toggle('dark', desired);
        refreshThemeIcons(desired);
    });
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            const desired = html.dataset.theme === 'dark';
            html.classList.toggle('dark', desired);
            refreshThemeIcons(desired);
        }
    });

    // --- User avatar dropdown handling ---
    const userDropdownContainer = document.getElementById('user-dropdown-container');
    if (userDropdownContainer) {
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        if (userMenuButton && userMenu) {
            // Toggle the menu on button click
            userMenuButton.addEventListener('click', (event) => {
                event.stopPropagation();
                userMenu.classList.toggle('hidden');
                const isVisible = !userMenu.classList.contains('hidden');
                userMenuButton.setAttribute('aria-expanded', isVisible ? 'true' : 'false');
            });

            // Close when clicking outside
            document.addEventListener('click', (event) => {
                if (!userDropdownContainer.contains(event.target) && !userMenu.classList.contains('hidden')) {
                    userMenu.classList.add('hidden');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                }
            });

            // Close on ESC
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !userMenu.classList.contains('hidden')) {
                    userMenu.classList.add('hidden');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                }
            });
        }
    }

    // --- Effet de l'en-tête au défilement (Optionnel) ---
    const header = document.getElementById('app-header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('shadow-md');
            } else {
                header.classList.remove('shadow-md');
            }
        });
    }
});
