/**
 * Date Handling Service
 */
class DateHandler {
    constructor() {
        this.locale = 'vi-VN';
        this.dateFormat = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
    }

    formatDate(date, format = 'dd-mm-yyyy') {
        const d = new Date(date);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();

        switch (format) {
            case 'dd-mm-yyyy':
                return `${day}-${month}-${year}`;
            case 'dd/mm/yyyy':
                return `${day}/${month}/${year}`;
            case 'yyyy-mm-dd':
                return `${year}-${month}-${day}`;
            default:
                return d.toLocaleDateString(this.locale);
        }
    }

    parseDateRange(range) {
        const [start, end] = range.split('-').map(d => d.trim());
        return {
            startDate: this.parseDate(start),
            endDate: this.parseDate(end)
        };
    }

    parseDate(dateString) {
        const formats = [
            /^(\d{2})-(\d{2})-(\d{4})$/,
            /^(\d{2})\/(\d{2})\/(\d{4})$/,
            /^(\d{4})-(\d{2})-(\d{2})$/
        ];

        for (const format of formats) {
            const match = dateString.match(format);
            if (match) {
                const [_, first, second, third] = match;
                if (format === formats[2]) {
                    return new Date(first, second - 1, third);
                }
                return new Date(third, second - 1, first);
            }
        }

        throw new Error('Invalid date format');
    }

    getDayOfWeek(date) {
        const days = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
        return days[new Date(date).getDay()];
    }

    getDateRangeArray(startDate, endDate) {
        const dates = [];
        const currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            dates.push(new Date(currentDate));
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return dates;
    }

    isValidDate(dateString) {
        try {
            const date = this.parseDate(dateString);
            return date instanceof Date && !isNaN(date);
        } catch {
            return false;
        }
    }

    addDays(date, days) {
        const result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    subtractDays(date, days) {
        return this.addDays(date, -days);
    }

    getWeekRange(date) {
        const current = new Date(date);
        const first = current.getDate() - current.getDay();
        const last = first + 6;

        return {
            start: new Date(current.setDate(first)),
            end: new Date(current.setDate(last))
        };
    }

    getMonthRange(date) {
        const current = new Date(date);
        return {
            start: new Date(current.getFullYear(), current.getMonth(), 1),
            end: new Date(current.getFullYear(), current.getMonth() + 1, 0)
        };
    }

    compareDates(date1, date2) {
        const d1 = new Date(date1).setHours(0, 0, 0, 0);
        const d2 = new Date(date2).setHours(0, 0, 0, 0);
        return d1 - d2;
    }
}

const dateHandler = new DateHandler();
export default dateHandler;
