import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    // Initialize datepicker
    let format = "d-m-Y";
    $(".datepicker").Zebra_DatePicker({
        format: format
    });

    // Add click event listeners to search buttons
    document.querySelectorAll('[onclick^="getSearchResult"]').forEach(button => {
        button.removeAttribute('onclick');
        button.addEventListener('click', function() {
            getSearchResult(this);
        });
    });
});

function getRandomNumbers(length) {
    return Math.floor(9 * Math.random() * Math.pow(10, length - 1)) + Math.pow(10, length - 1);
}
