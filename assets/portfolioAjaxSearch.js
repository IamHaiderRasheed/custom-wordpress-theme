document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("ajax-search-input");
    if (!input) return;

    input.addEventListener("input", function () {
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
    });
});
