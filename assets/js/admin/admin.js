document.getElementById("monthSelector").addEventListener("change", function() {
    const selectedMonth = this.value;
    const currentYear = getParameterByName('year') || '2023'; // Si l'année n'est pas dans l'URL, cela prendra '2023' comme valeur par défaut
    window.location.href = window.location.pathname + "?year=" + currentYear + "&month=" + selectedMonth;
});

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}