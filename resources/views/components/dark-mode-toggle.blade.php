<button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
    :class="{ 'dark': darkMode }"
    class="relative inline-flex items-center justify-center w-10 h-10 rounded-lg transition-colors duration-200 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
    :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'">
    <svg v-if="!darkMode" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
    </svg>
    <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l-2.12-2.12a4 4 0 00 5.656 5.656l2.12-2.12a7 7 0 11-5.656-5.656zM9 16.5a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" clip-rule="evenodd"/>
    </svg>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = localStorage.getItem('darkMode') === 'true' ||
                   window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (isDark) {
        document.documentElement.classList.add('dark');
    }
});
</script>