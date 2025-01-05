/**
 * Data Processing Service for lottery calculations
 */
class DataProcessor {
    constructor() {
        this.loadingTemplate = '<div class="loading"></div>';
    }

    /**
     * Process lottery numbers and generate statistics
     */
    processLotteryData(data) {
        const stats = {
            frequency: {},
            pairs: {},
            firstDigit: {},
            lastDigit: {},
            sum: 0,
            count: 0
        };

        // Process each number
        data.forEach(number => {
            // Skip invalid numbers
            if (!number || typeof number !== 'string') return;

            // Clean the number
            const cleanNumber = number.trim();
            if (cleanNumber.length !== 2) return;

            // Update statistics
            this.updateFrequency(stats.frequency, cleanNumber);
            this.updatePairs(stats.pairs, cleanNumber);
            this.updateDigitStats(stats.firstDigit, cleanNumber[0]);
            this.updateDigitStats(stats.lastDigit, cleanNumber[1]);

            stats.sum += parseInt(cleanNumber);
            stats.count++;
        });

        return this.calculateFinalStats(stats);
    }

    /**
     * Update frequency statistics
     */
    updateFrequency(frequency, number) {
        frequency[number] = (frequency[number] || 0) + 1;
    }

    /**
     * Update pair statistics
     */
    updatePairs(pairs, number) {
        for (let i = 0; i < 100; i++) {
            const pair = i.toString().padStart(2, '0');
            if (number === pair) {
                pairs[pair] = (pairs[pair] || 0) + 1;
            }
        }
    }

    /**
     * Update digit statistics
     */
    updateDigitStats(stats, digit) {
        stats[digit] = (stats[digit] || 0) + 1;
    }

    /**
     * Calculate final statistics
     */
    calculateFinalStats(stats) {
        return {
            frequency: this.sortByFrequency(stats.frequency),
            pairs: this.sortByFrequency(stats.pairs),
            firstDigit: this.sortByFrequency(stats.firstDigit),
            lastDigit: this.sortByFrequency(stats.lastDigit),
            average: stats.count > 0 ? (stats.sum / stats.count).toFixed(2) : 0
        };
    }

    /**
     * Sort statistics by frequency
     */
    sortByFrequency(data) {
        return Object.entries(data)
            .sort(([,a], [,b]) => b - a)
            .reduce((r, [k, v]) => ({ ...r, [k]: v }), {});
    }

    /**
     * Process special prize data
     */
    processSpecialPrize(data) {
        if (!data || !data.g0) return null;

        const specialPrize = data.g0;
        return {
            number: specialPrize,
            firstTwo: specialPrize.substring(0, 2),
            lastTwo: specialPrize.substring(specialPrize.length - 2),
            sum: specialPrize.split('').reduce((a, b) => a + parseInt(b), 0)
        };
    }

    /**
     * Generate loto numbers from results
     */
    generateLotoNumbers(results, region = 1) {
        const lotoNumbers = [];
        const processNumber = (num) => {
            if (!num || typeof num !== 'string') return;
            const lastTwo = num.slice(-2);
            if (lastTwo.length === 2) {
                lotoNumbers.push(lastTwo);
            }
        };

        // Process each prize
        Object.values(results).forEach(prize => {
            if (typeof prize === 'string') {
                processNumber(prize);
            } else if (Array.isArray(prize)) {
                prize.forEach(processNumber);
            }
        });

        return lotoNumbers;
    }

    /**
     * Process result trend data
     */
    processTrendData(data, days = 7) {
        const trends = {
            numbers: {},
            days: [],
            max: 0
        };

        // Process each day's data
        data.forEach(dayData => {
            const date = new Date(dayData.date);
            trends.days.push(date.toLocaleDateString('vi-VN'));

            dayData.numbers.forEach(num => {
                if (!trends.numbers[num]) {
                    trends.numbers[num] = new Array(days).fill(0);
                }
                const dayIndex = trends.days.length - 1;
                trends.numbers[num][dayIndex] = 1;
            });
        });

        // Calculate frequencies
        Object.keys(trends.numbers).forEach(num => {
            const sum = trends.numbers[num].reduce((a, b) => a + b, 0);
            trends.max = Math.max(trends.max, sum);
        });

        return trends;
    }

    /**
     * Check for bridging in number sequence
     */
    checkBridging(numbers, bridgeLength = 3) {
        const bridges = [];
        let currentBridge = [numbers[0]];

        for (let i = 1; i < numbers.length; i++) {
            const current = parseInt(numbers[i]);
            const previous = parseInt(numbers[i - 1]);

            if (Math.abs(current - previous) === 1) {
                currentBridge.push(numbers[i]);
            } else {
                if (currentBridge.length >= bridgeLength) {
                    bridges.push([...currentBridge]);
                }
                currentBridge = [numbers[i]];
            }
        }

        // Check last bridge
        if (currentBridge.length >= bridgeLength) {
            bridges.push(currentBridge);
        }

        return bridges;
    }

    /**
     * Format number with padding
     */
    formatNumber(number, length) {
        return number.toString().padStart(length, '0');
    }

    /**
     * Check if number is empty and return loading template if needed
     */
    checkEmpty(value, loadingTemplate = this.loadingTemplate) {
        return value === '' || value == null ? loadingTemplate : value;
    }

    /**
     * Process and validate lottery numbers
     */
    validateLotteryNumber(number) {
        // Remove non-numeric characters
        const cleanNumber = number.replace(/\D/g, '');

        // Check length
        if (cleanNumber.length !== 6) {
            return {
                valid: false,
                error: 'Number must be 6 digits'
            };
        }

        // Check if all digits are numbers
        if (!/^\d+$/.test(cleanNumber)) {
            return {
                valid: false,
                error: 'Number must contain only digits'
            };
        }

        return {
            valid: true,
            number: cleanNumber
        };
    }
}

const dataProcessor = new DataProcessor();
export default dataProcessor;
