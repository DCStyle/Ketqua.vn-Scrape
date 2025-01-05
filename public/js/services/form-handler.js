/**
 * Form Handler Service
 * Manages form validations, submissions and error handling
 */
class FormHandler {
    constructor() {
        this.validationRules = {
            date: {
                pattern: /^\d{2}-\d{2}-\d{4}$/,
                message: 'Date must be in DD-MM-YYYY format'
            },
            number: {
                pattern: /^\d{2}((,|.|:|;|\/|\s|-)\d{2})*$/,
                message: 'Numbers must be in XX-XX-XX format'
            },
            dateRange: {
                pattern: /^\d{2}\/\d{2}\/\d{4}\s*-\s*\d{2}\/\d{2}\/\d{4}$/,
                message: 'Date range must be in DD/MM/YYYY - DD/MM/YYYY format'
            }
        };

        this.setupEventListeners();
    }

    /**
     * Setup form event listeners
     */
    setupEventListeners() {
        // Search form handler
        document.querySelector('#search-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleSearchForm(e.target);
        });

        // Statistics form handler
        document.querySelector('#statistics-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleStatisticsForm(e.target);
        });

        // Dream search form handler
        document.querySelector('#dream-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleDreamForm(e.target);
        });

        // Result book form handler
        document.querySelector('#result-book-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleResultBookForm(e.target);
        });
    }

    /**
     * Handle search form submission
     */
    async handleSearchForm(form) {
        const searchDate = form.querySelector('[name="search_date"]').value;
        const provinceId = form.querySelector('[name="province_id"]').value;
        const searchNumber = form.querySelector('[name="search_number"]').value;

        if (!this.validateField('date', searchDate)) {
            this.showError('search_date', this.validationRules.date.message);
            return;
        }

        const button = form.querySelector('button[type="submit"]');
        this.setLoading(button, true);

        try {
            const response = await window.LotteryApp.api.searchResults({
                search_date: searchDate,
                province_id: provinceId,
                search_number: searchNumber
            });

            if (response.success) {
                this.updateResults(response.data);
            } else {
                this.showError('search_form', response.error);
            }
        } finally {
            this.setLoading(button, false);
        }
    }

    /**
     * Handle statistics form submission
     */
    async handleStatisticsForm(form) {
        const fromDate = form.querySelector('[name="from_date"]').value;
        const toDate = form.querySelector('[name="to_date"]').value;
        const provinceId = form.querySelector('[name="province_id"]').value;

        if (!this.validateField('date', fromDate) || !this.validateField('date', toDate)) {
            this.showError('date_range', 'Invalid date format');
            return;
        }

        const button = form.querySelector('button[type="submit"]');
        this.setLoading(button, true);

        try {
            const response = await window.LotteryApp.api.getStatistics('frequency', {
                from_date: fromDate,
                to_date: toDate,
                province_id: provinceId
            });

            if (response.success) {
                this.updateResults(response.data);
            } else {
                this.showError('statistics_form', response.error);
            }
        } finally {
            this.setLoading(button, false);
        }
    }

    /**
     * Handle dream interpretation form submission
     */
    async handleDreamForm(form) {
        const dreamName = form.querySelector('[name="dream_name"]').value;
        const dreamNumber = form.querySelector('[name="dream_number"]').value;

        if (!dreamName && !dreamNumber) {
            this.showError('dream_form', 'Please enter either a dream description or number');
            return;
        }

        const button = form.querySelector('button[type="submit"]');
        this.setLoading(button, true);

        try {
            const response = await window.LotteryApp.api.getDreamResult({
                dream_name: dreamName,
                dream_number: dreamNumber
            });

            if (response.success) {
                this.updateResults(response.data);
            } else {
                this.showError('dream_form', response.error);
            }
        } finally {
            this.setLoading(button, false);
        }
    }

    /**
     * Handle result book form submission
     */
    async handleResultBookForm(form) {
        const dateRange = form.querySelector('[name="date_range"]').value;
        const provinceId = form.querySelector('[name="province_id"]').value;

        if (!this.validateField('dateRange', dateRange)) {
            this.showError('date_range', this.validationRules.dateRange.message);
            return;
        }

        const button = form.querySelector('button[type="submit"]');
        this.setLoading(button, true);

        try {
            const [fromDate, toDate] = dateRange.split('-').map(d => d.trim());
            const response = await window.LotteryApp.api.getHistory(fromDate, toDate, provinceId);

            if (response.success) {
                this.updateResults(response.data);
            } else {
                this.showError('result_book_form', response.error);
            }
        } finally {
            this.setLoading(button, false);
        }
    }

    /**
     * Validate field against pattern
     */
    validateField(type, value) {
        const rule = this.validationRules[type];
        return rule && rule.pattern.test(value);
    }

    /**
     * Show error message
     */
    showError(fieldName, message) {
        const errorElement = document.querySelector(`p[for="${fieldName}"]`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    /**
     * Clear error message
     */
    clearError(fieldName) {
        const errorElement = document.querySelector(`p[for="${fieldName}"]`);
        if (errorElement) {
            errorElement.textContent = '';
            errorElement.style.display = 'none';
        }
    }

    /**
     * Set loading state on button
     */
    setLoading(button, isLoading) {
        if (!button) return;

        if (isLoading) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
        } else {
            button.disabled = false;
            button.innerHTML = 'Xem kết quả';
        }
    }

    /**
     * Update results container
     */
    updateResults(data) {
        const resultsContainer = document.querySelector('#results');
        if (resultsContainer) {
            resultsContainer.innerHTML = data;
        }
    }
}

const formHandler = new FormHandler();
export default formHandler;
