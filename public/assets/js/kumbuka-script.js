// Toggle light and dark themes
function toggleThemeMenu() {
    let themeOption = document.querySelectorAll('[data-bs-theme-value]');

    if (!themeOption) return;

    const themeToggle = document.getElementById('theme-menu');
    const rootElement = document.documentElement;

    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const piked = systemPrefersDark ? 'dark' : 'light';
    const currentTheme = savedTheme || (systemPrefersDark ?? 'light');
    rootElement.setAttribute('data-bs-theme', currentTheme);

    themeOption.forEach(option => {
        option.addEventListener('click', () => {
            const theme = option.getAttribute('data-bs-theme-value');
            // Update the DOM attribute
            rootElement.setAttribute('data-bs-theme', theme);
            // Save the selection to LocalStorage
            localStorage.setItem('theme', theme);
        });
    });

}




// Disable Submit button after click
// Just for a UX feature and prevent multiple requests being sent.
const kmForms = document.querySelectorAll('[data-km="form"]');

if (kmForms !== null) {
    kmForms.forEach(element => {

        element.addEventListener('submit', (event) => {
            const form = event.target;
            const kmSubmitBtn = form.querySelector('[data-km="submit"]');
            const btnText = kmSubmitBtn.innerHTML;

            // Disable the button to prevent further clicks
            kmSubmitBtn.disabled = true;

            // Change the button text
            kmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...`;

            setTimeout(() => {
                // Reset state if needed
                kmSubmitBtn.disabled = false;
                kmSubmitBtn.innerHTML = btnText;
            }, 4000);
        });
    });
}

/**
 * THIS FEATURE IS FOR NEW NOTES PAGE!!!!!!!
 * 
 * Change a URL query value using the URLSearchParams interface 
 * along with the history.pushState() and history.replaceState() methods.
 * 
 */
function updateUrlQueryParam(key, value) {
    // 1. Create a URL object based on the current window location
    const url = new URL(window.location.href);

    // 2. Access the searchParams property, which is a URLSearchParams object
    const searchParams = url.searchParams;

    // 3. Set the new value for the specified key
    // This method overwrites an existing parameter or adds a new one
    searchParams.set(key, value);

    // 4. Update the browser's history and URL without reloading the page
    // The first two arguments of replaceState are 'state' (can be null) and 'title' (ignored by modern browsers, can be empty string)
    // The third argument is the new URL
    window.history.replaceState(null, '', url.toString());
}


