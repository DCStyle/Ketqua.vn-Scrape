/**
 * Statistics Service
 */
class StatisticsService {
    constructor() {
        this.cache = new Map();
    }

    calculateFrequency(numbers) {
        const frequency = {};
        numbers.forEach(num => {
            frequency[num] = (frequency[num] || 0) + 1;
        });
        return this.sortByFrequency(frequency);
    }

    calculatePairFrequency(numbers) {
        const pairs = {};
        for (let i = 0; i < numbers.length - 1; i++) {
            const pair = `${numbers[i]}-${numbers[i + 1]}`;
            pairs[pair] = (pairs[pair] || 0) + 1;
        }
        return this.sortByFrequency(pairs);
    }

    sortByFrequency(data) {
        return Object.entries(data)
            .sort(([,a], [,b]) => b - a)
            .reduce((r, [k, v]) => ({ ...r, [k]: v }), {});
    }

    calculateTrendAnalysis(numbers, periods) {
        const trends = {};
        periods.forEach(period => {
            const periodNumbers = numbers.slice(-period);
            trends[period] = {
                frequency: this.calculateFrequency(periodNumbers),
                average: this.calculateAverage(periodNumbers),
                median: this.calculateMedian(periodNumbers),
                mode: this.calculateMode(periodNumbers)
            };
        });
        return trends;
    }

    calculateGapAnalysis(numbers) {
        const gaps = {};
        for (let i = 0; i <= 99; i++) {
            const num = i.toString().padStart(2, '0');
            gaps[num] = this.findGaps(numbers, num);
        }
        return gaps;
    }

    findGaps(numbers, target) {
        const positions = [];
        let currentGap = 0;
        let maxGap = 0;

        numbers.forEach((num, index) => {
            if (num === target) {
                positions.push(index);
                maxGap = Math.max(maxGap, currentGap);
                currentGap = 0;
            } else {
                currentGap++;
            }
        });

        return {
            currentGap,
            maxGap,
            positions
        };
    }

    calculateAverage(numbers) {
        const sum = numbers.reduce((a, b) => a + parseInt(b), 0);
        return (sum / numbers.length).toFixed(2);
    }

    calculateMedian(numbers) {
        const sorted = [...numbers].sort((a, b) => a - b);
        const mid = Math.floor(sorted.length / 2);
        return sorted.length % 2 ? sorted[mid] :
            ((parseInt(sorted[mid - 1]) + parseInt(sorted[mid])) / 2).toFixed(2);
    }

    calculateMode(numbers) {
        const frequency = this.calculateFrequency(numbers);
        const maxFreq = Math.max(...Object.values(frequency));
        return Object.entries(frequency)
            .filter(([_, freq]) => freq === maxFreq)
            .map(([num]) => num);
    }

    analyzeHeadTail(numbers) {
        const analysis = {
            head: {},
            tail: {},
            combinations: {}
        };

        numbers.forEach(num => {
            const head = num.toString()[0];
            const tail = num.toString()[1];

            analysis.head[head] = (analysis.head[head] || 0) + 1;
            analysis.tail[tail] = (analysis.tail[tail] || 0) + 1;

            const combo = `${head}-${tail}`;
            analysis.combinations[combo] = (analysis.combinations[combo] || 0) + 1;
        });

        return {
            head: this.sortByFrequency(analysis.head),
            tail: this.sortByFrequency(analysis.tail),
            combinations: this.sortByFrequency(analysis.combinations)
        };
    }

    findPatterns(numbers, patternLength = 2) {
        const patterns = {};

        for (let i = 0; i <= numbers.length - patternLength; i++) {
            const pattern = numbers.slice(i, i + patternLength).join('-');
            patterns[pattern] = (patterns[pattern] || 0) + 1;
        }

        return this.sortByFrequency(patterns);
    }

    predictNextNumbers(numbers, count = 5) {
        const frequency = this.calculateFrequency(numbers);
        const headTail = this.analyzeHeadTail(numbers);
        const patterns = this.findPatterns(numbers);

        return {
            byFrequency: Object.keys(frequency).slice(0, count),
            byHeadTail: this.combineHeadTail(headTail.head, headTail.tail, count),
            byPatterns: Object.keys(patterns).slice(0, count)
        };
    }

    combineHeadTail(heads, tails, count) {
        const combinations = [];
        const sortedHeads = Object.keys(heads);
        const sortedTails = Object.keys(tails);

        for (let i = 0; i < sortedHeads.length && combinations.length < count; i++) {
            for (let j = 0; j < sortedTails.length && combinations.length < count; j++) {
                combinations.push(sortedHeads[i] + sortedTails[j]);
            }
        }

        return combinations;
    }

    getCacheKey(...args) {
        return args.join('-');
    }

    getCachedResult(key) {
        const cached = this.cache.get(key);
        if (cached && Date.now() - cached.timestamp < 300000) { // 5 minutes cache
            return cached.data;
        }
        return null;
    }

    setCacheResult(key, data) {
        this.cache.set(key, {
            data,
            timestamp: Date.now()
        });
    }
}

const statisticsService = new StatisticsService();
export default statisticsService;
