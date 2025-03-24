document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("ajax-search-input");
    if (!input) return;

    function debounce(func, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, delay);
        };
    }
    
    const performSearch = () => {
        const searchTerm = input.value;
    
        const data = new FormData();
        data.append('action', 'portfolio_ajax_search');
        data.append('search', searchTerm);
    
        fetch(portfolioSearch.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            body: data
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById("ajax-search-results").innerHTML = html;
        });
    };
    
    input.addEventListener("input", debounce(performSearch, 600)); // 300ms delay
    
});
