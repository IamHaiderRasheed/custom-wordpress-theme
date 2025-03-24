document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('portfolio-form');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        formData.append('action', 'submit_portfolio_form'); // WP AJAX action
        formData.append('_ajax_nonce', portfolio_ajax_object.nonce); // localized nonce

        const response = await fetch(portfolio_ajax_object.ajax_url, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        document.getElementById('response-message').innerText = result.data.message;
    });
});
