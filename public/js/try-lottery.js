/**
 * Try Lottery Manager
 */
class TryLotteryManager {
    constructor() {
        this.setupEventListeners();
    }

    /**
     * Setup event listeners for try lottery functionality
     */
    setupEventListeners() {
        // Province select change handler
        document.querySelector('#try-province-select')?.addEventListener('change', (e) => {
            const region = document.querySelector('#try-region')?.value;
            if (parseInt(region) > 1) return;

            const [provinceId, regionType] = e.target.value.split('-');
            if (!provinceId || !regionType) return;

            // Load appropriate template
            window.LotteryApp.loadTryTemplate(regionType === '1' ? 1 : 2);

            // Update province name display
            const provinceName = e.target.selectedOptions[0]?.text || '';
            document.querySelector('#try-province-name').textContent = provinceName;
        });

        // DIW select change handler
        document.querySelector('#try-diw-select')?.addEventListener('change', (e) => {
            this.handleDiwChange(e.target);
        });

        // Try buttons handlers
        document.querySelector('#try-province-start')?.addEventListener('click', async (e) => {
            await this.handleProvinceTry(e.target);
        });

        document.querySelector('#try-region-start')?.addEventListener('click', async (e) => {
            await this.handleRegionTry(e.target);
        });
    }

    /**
     * Handle DIW (day in week) selection change
     */
    handleDiwChange(select) {
        const diw = select.value;
        const region = document.querySelector('#try-region')?.value;
        const provinces = JSON.parse(window.provinces || '[]');

        // Update province select options
        const provinceSelect = document.querySelector('#try-province-select');
        if (!provinceSelect) return;

        let html = '';
        const diwProvinces = [];

        provinces.forEach(p => {
            if (p.days.includes(diw) || p.days === '0') {
                html += `<option value="${p.id}">${p.name}</option>`;
                diwProvinces.push(p);
            }
        });

        provinceSelect.innerHTML = html;

        // Update region display if needed
        if (region > 1) {
            this.updateRegionDisplay(diwProvinces);
        }
    }

    /**
     * Update region display
     */
    updateRegionDisplay(provinces) {
        // Generate header row
        let bodyHtml = '<tr class="bg-light"><th colspan="3" class="color-sub-brand txt-content fw-medium p-0">Tỉnh</th>';
        provinces.forEach(p => {
            const tryProvinceUrl = `${window.rootUrl}quay-thu-xo-so-${p.slug}`;
            bodyHtml += `<th colspan="8" class="color-sub-brand txt-content fw-medium">
                <a href="${tryProvinceUrl}">${p.name}</a>
            </th>`;
        });
        bodyHtml += '</tr>';

        // Generate prize rows
        for (let i = 1; i <= 18; i++) {
            bodyHtml += this.generatePrizeRow(i, provinces);
        }

        // Update display
        document.querySelector('#try-region-first-th')
            ?.setAttribute('colspan', 8 * provinces.length + 3);

        document.querySelector('#try-region-body').innerHTML = bodyHtml;

        // Generate lottery result rows
        this.generateLotteryResultRows(provinces);
    }

    /**
     * Generate prize row HTML
     */
    generatePrizeRow(index, provinces) {
        let html = '<tr>';
        // Add prize label
        if (index === 1) {
            html += '<td colspan="3" class="fw-medium">G8</td>';
        }
        // ... Add other prize rows based on index

        // Add province cells
        provinces.forEach(p => {
            html += `<td colspan="8" class="txt-normal-prize">
                <div class="number try_number_${p.id}_${index}"></div>
            </td>`;
        });

        html += '</tr>';
        return html;
    }

    /**
     * Generate lottery result rows
     */
    generateLotteryResultRows(provinces) {
        let html = '<tr class="text-center"><th colspan="3" class="p-0 fw-medium">Đầu</th>';

        provinces.forEach(p => {
            const tryProvinceUrl = `${window.rootUrl}quay-thu-xo-so-${p.slug}`;
            html += `<th colspan="8" class="p-0 fw-medium">
                <a href="${tryProvinceUrl}">${p.name}</a>
            </th>`;
        });
        html += '</tr>';

        // Generate rows for each number (0-9)
        for (let i = 0; i <= 9; i++) {
            html += `<tr class="${i % 2 === 0 ? 'bg-color-lotto-background' : ''}">
                <td colspan="3" class="text-center">${i}</td>`;

            provinces.forEach(p => {
                html += `<td colspan="8" class="dd-kq dd_${p.id}_dau_${i}"></td>`;
            });

            html += '</tr>';
        }

        document.querySelector('#try-region-dd').innerHTML = html;
    }

    /**
     * Handle province try button click
     */
    async handleProvinceTry(button) {
        button.disabled = true;
        button.textContent = 'Đang quay thử';

        const provinceSelect = document.querySelector('#try-province-select');
        provinceSelect.disabled = true;

        window.LotteryApp.resetTryProvinceResults();
        await this.renderTryProvinceResults();

        button.disabled = false;
        button.textContent = 'Bắt đầu quay';
        provinceSelect.disabled = false;
    }

    /**
     * Handle region try button click
     */
    async handleRegionTry(button) {
        button.disabled = true;
        button.textContent = 'Đang quay thử';

        const controls = [
            '#try-province-select',
            '#try-diw-select'
        ].forEach(selector => {
            document.querySelector(selector)?.setAttribute('disabled', 'true');
        });

        window.LotteryApp.resetTryRegionResults();
        await this.renderTryRegionResults();

        button.disabled = false;
        button.textContent = 'Bắt đầu quay';

        controls.forEach(selector => {
            document.querySelector(selector)?.removeAttribute('disabled');
        });
    }

    /**
     * Render try province results
     */
    async renderTryProvinceResults() {
        const provinceValue = document.querySelector('#try-province-select')?.value;
        if (!provinceValue) return;

        const [_, region] = provinceValue.split('-');
        if (region === '1') {
            await this.renderMbTryResults();
        } else {
            await this.renderMtMnTryResults();
        }
    }

    /**
     * Render try region results
     */
    async renderTryRegionResults() {
        const provinceOptions = document.querySelectorAll('#try-province-select option');
        const provinces = Array.from(provinceOptions).map(option => option.value);

        const results = {};
        const lotos = {};

        provinces.forEach(province => {
            results[province] = [];
            lotos[province] = [];
        });

        // Render results for each step
        for (let step = 1; step <= 18; step++) {
            await this.renderRegionStep(step, provinces, results, lotos);
        }
    }

    // ... Additional helper methods for rendering different result types
}

// Create and export instance
const tryLotteryManager = new TryLotteryManager();
export default tryLotteryManager;
