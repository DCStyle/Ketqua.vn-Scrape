/**
 * API Service for handling all HTTP requests
 */
class ApiService {
    constructor() {
        this.baseUrl = window.location.origin;
        this.endpoints = {
            liveMb: '/api/v1/live-xsmb',
            liveMt: '/api/v1/live-xsmt',
            liveMn: '/api/v1/live-xsmn',
            search: '/api/v1/search',
            statistics: '/api/v1/statistics',
            dream: '/api/v1/dream',
            history: '/api/v1/history'
        };
    }

    /**
     * Generic API call method with error handling
     */
    async fetchApi(endpoint, options = {}) {
        try {
            const url = `${this.baseUrl}${endpoint}${options.query || ''}`;
            const response = await fetch(url, {
                method: options.method || 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...options.headers
                },
                body: options.body ? JSON.stringify(options.body) : null
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            return { success: true, data };

        } catch (error) {
            console.error('API call failed:', error);
            return {
                success: false,
                error: error.message || 'API call failed'
            };
        }
    }

    /**
     * Get live Mien Bac results
     */
    async getLiveMb() {
        const timestamp = new Date().getTime();
        return this.fetchApi(`${this.endpoints.liveMb}?t=${timestamp}`);
    }

    /**
     * Get live Mien Trung results
     */
    async getLiveMt() {
        const timestamp = new Date().getTime();
        return this.fetchApi(`${this.endpoints.liveMt}?t=${timestamp}`);
    }

    /**
     * Get live Mien Nam results
     */
    async getLiveMn() {
        const timestamp = new Date().getTime();
        return this.fetchApi(`${this.endpoints.liveMn}?t=${timestamp}`);
    }

    /**
     * Search lottery results
     */
    async searchResults(params) {
        return this.fetchApi(this.endpoints.search, {
            method: 'POST',
            body: params
        });
    }

    /**
     * Get result history
     */
    async getHistory(fromDate, toDate, provinceId) {
        const query = `?range=${fromDate.replaceAll('-', '/')}-${toDate.replaceAll('-', '/')}&province_id=${provinceId}`;
        return this.fetchApi(this.endpoints.history + query);
    }

    /**
     * Get dream number interpretation
     */
    async getDreamResult(params) {
        return this.fetchApi(this.endpoints.dream, {
            method: 'POST',
            body: params
        });
    }

    /**
     * Get statistics data
     */
    async getStatistics(type, params) {
        return this.fetchApi(`${this.endpoints.statistics}/${type}`, {
            method: 'POST',
            body: params
        });
    }

    /**
     * Handle error responses
     */
    handleError(error) {
        if (error.status === 429) {
            return {
                success: false,
                error: 'Too many requests. Please try again later.',
                retryAfter: error.headers.get('Retry-After')
            };
        }

        return {
            success: false,
            error: error.message || 'An unexpected error occurred'
        };
    }
}

const apiService = new ApiService();
export default apiService;
