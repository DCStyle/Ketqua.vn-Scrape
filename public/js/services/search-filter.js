/**
 * Search and Filter Service
 * Handles search, filtering, and pagination functionality
 */
class SearchFilter {
    constructor() {
        this.currentPage = 1;
        this.itemsPerPage = 10;
        this.setupEventListeners();
    }

    /**
     * Setup event listeners
     */
    setupEventListeners() {
        // Load more results
        document.querySelector('#load-more')?.addEventListener('click', (e) => {
            this.loadMoreResults(e.target);
        });

        // Quick number filters
        document.querySelectorAll('.quick-filter')?.forEach(button => {
            button.addEventListener('click', () => this.applyQuickFilter(button));
        });

        // Province filter change
        document.querySelector('#province-filter')?.addEventListener('change', (e) => {
            this.handleProvinceChange(e.target.value);
        });

        // Date filter change
        document.querySelector('#date-filter')?.addEventListener('change', (e) => {
            this.handleDateChange(e.target.value);
        });
    }

    /**
     * Load more results
     */
    async loadMoreResults(button) {
        const buttonIcon = button.querySelector('i');
        this.currentPage += 1;

        buttonIcon?.classList.add('rolling');

        try {
            const response = await window.LotteryApp.api.fetchApi(window.location.href, {
                method: 'POST',
                body: { page: this.currentPage }
            });

            if (response.success) {
                const loadmoreContent = document.querySelector('#loadmore-content');
                if (loadmoreContent) {
                    loadmoreContent.insertAdjacentHTML('beforeend', response.data);
                }
            }
        } catch (error) {
            console.error('Failed to load more results:', error);
        } finally {
            buttonIcon?.classList.remove('rolling');
        }
    }

    /**
     * Apply quick number filter
     */
    applyQuickFilter(button) {
        const type = button.dataset.type;
        const allNumbers = document.querySelectorAll('#check_numbers span');

        // First, remove all checked classes
        allNumbers.forEach(span => span.classList.remove('checked'));

        // Apply the appropriate filter
        switch(type) {
            case 'all':
                allNumbers.forEach(span => span.classList.add('checked'));
                break;

            case 'none':
                // Already cleared above
                break;

            case 'even':
                allNumbers.forEach(span => {
                    const number = parseInt(span.textContent);
                    if (!isNaN(number) && number % 2 === 0) {
                        span.classList.add('checked');
                    }
                });
                break;

            case 'odd':
                allNumbers.forEach(span => {
                    const number = parseInt(span.textContent);
                    if (!isNaN(number) && number % 2 !== 0) {
                        span.classList.add('checked');
                    }
                });
                break;

            default:
                if (type.startsWith('h')) {
                    // Head number filter
                    const headDigit = type[1];
                    allNumbers.forEach(span => {
                        const number = span.textContent;
                        if (number[0] === headDigit) {
                            span.classList.add('checked');
                        }
                    });
                } else if (type.startsWith('t')) {
                    // Tail number filter
                    const tailDigit = type[1];
                    allNumbers.forEach(span => {
                        const number = span.textContent;
                        if (number[1] === tailDigit) {
                            span.classList.add('checked');
                        }
                    });
                }
        }
    }

    /**
     * Handle province selection change
     */
    async handleProvinceChange(provinceId) {
        if (!provinceId) return;

        const response = await window.LotteryApp.api.fetchApi('/api/v1/province-results', {
            method: 'POST',
            body: { province_id: provinceId }
        });

        if (response.success) {
            this.updateResults(response.data);
        }
    }

    /**
     * Handle date selection change
     */
    async handleDateChange(date) {
        if (!date) return;

        const response = await window.LotteryApp.api.fetchApi('/api/v1/date-results', {
            method: 'POST',
            body: { date }
        });

        if (response.success) {
            this.updateResults(response.data);
        }
    }

    /**
     * Update results display
     */
    updateResults(data) {
        const resultsContainer = document.querySelector('#results');
        if (resultsContainer) {
            resultsContainer.innerHTML = data;
        }

        // Reset pagination
        this.currentPage = 1;

        // Update URL without reload
        const url = new URL(window.location);
        url.searchParams.set('page', '1');
        window.history.pushState({}, '', url);
    }

    /**
     * Filter numbers based on criteria
     */
    filterNumbers(numbers, criteria) {
        return numbers.filter(number => {
            if (criteria.startsWith('head_')) {
                const head = criteria.split('_')[1];
                return number.toString().startsWith(head);
            }
            if (criteria.startsWith('tail_')) {
                const tail = criteria.split('_')[1];
                return number.toString().endsWith(tail);
            }
            if (criteria === 'even') {
                return number % 2 === 0;
            }
            if (criteria === 'odd') {
                return number % 2 !== 0;
            }
            return true;
        });
    }

    /**
     * Search numbers by pattern
     */
    searchNumbers(numbers, pattern) {
        const regex = new RegExp(pattern.split('*').join('.*'));
        return numbers.filter(number => regex.test(number.toString()));
    }
}

const searchFilter = new SearchFilter();
export default searchFilter;
