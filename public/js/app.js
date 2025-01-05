/**
 * Main Application Entry Point
 */

import LotteryConfig from './config.js';
import Utils from './utils.js';
import soundManager from './sound-manager.js';
import drawAnimation from './draw-animation.js';
import resultsManager from './results-manager.js';
import firebaseService from './firebase-service.js';
import apiService from './services/api-service.js';
import dataProcessor from './services/data-processor.js';
import formHandler from './services/form-handler.js';
import searchFilter from './services/search-filter.js';
import dateHandler from './services/date-handler.js';
import statisticsService from './services/statistics.js';
import animationService from './services/animation-service.js';
import exportService from './services/export-service.js';

class LotteryApp {
    constructor() {
        if (window.firebase) {
            firebase.initializeApp({
                apiKey: "AIzaSyC6A1OOT1vJY-Gg4rKbIqYY9IT6QFazZuw",
                authDomain: "ketqua.vn",
                databaseURL: "https://ketquavn-7fdef-default-rtdb.asia-southeast1.firebasedatabase.app",
                projectId: "ketquavn-7fdef",
                storageBucket: "ketquavn-7fdef.appspot.com",
                messagingSenderId: "549690883362",
                appId: "1:549690883362:web:d28c780d4c9100b13df97b",
                measurementId: "G-K1M5ZCFJNH"
            });
        }

        // Core modules
        this.config = LotteryConfig;
        this.utils = Utils;
        this.soundManager = soundManager;
        this.drawAnimation = drawAnimation;
        this.resultsManager = resultsManager;
        this.firebaseService = firebaseService;

        // Service modules
        this.api = apiService;
        this.dataProcessor = dataProcessor;
        this.formHandler = formHandler;
        this.searchFilter = searchFilter;
        this.dateHandler = dateHandler;
        this.statisticsService = statisticsService;
        this.animationService = animationService;
        this.exportService = exportService;
    }

    /**
     * Initialize application
     */
    init() {
        // Initialize Firebase
        this.firebaseService.init();

        // Initialize sound system
        this.soundManager.initSounds();

        // Start loading animation
        this.drawAnimation.initLoadingAnimation();

        // Setup event listeners
        this.setupEventListeners();

        // Auto-start live results based on URL
        this.initLiveResults();
    }

    /**
     * Setup event listeners
     */
    setupEventListeners() {
        document.addEventListener('click', (event) => {
            const target = event.target;

            // Handle view mode changes
            if (target.matches('.change_view_mode')) {
                this.handleViewModeChange(target);
            }

            // Handle replay button
            if (target.matches('#replay')) {
                this.handleReplay(target);
            }
        });
    }

    /**
     * Handle view mode changes
     */
    handleViewModeChange(element) {
        const length = parseInt(element.value);
        const resultBox = element.closest('table');
        if (!resultBox) return;

        const prizeElements = resultBox.querySelectorAll('.txt-special-prize, .txt-normal-prize');

        prizeElements.forEach(td => {
            const number = td.textContent.trim();
            if (length === 0) {
                td.innerHTML = number;
            } else if (number.length > length) {
                const visiblePart = number.slice(-length);
                const hiddenPart = number.slice(0, -length);
                td.innerHTML = `<span class="hidden">${hiddenPart}</span>${visiblePart}`;
            }
        });
    }

    /**
     * Handle replay button click
     */
    handleReplay(button) {
        const dataElement = button.querySelector('.data-kqxs');
        if (!dataElement || !dataElement.textContent) return;

        const kqxs = JSON.parse(dataElement.textContent);
        button.style.display = 'none';

        // Reset display
        document.querySelector('#draw_label').classList.remove('hidden');
        document.querySelector('#draw_label').textContent = 'Quay giải nhất';
        document.querySelectorAll('.txt-special-prize, .txt-normal-prize, .dd-kq')
            .forEach(el => el.innerHTML = '');

        // Start replay
        this.startReplay(kqxs);
    }

    /**
     * Start replay sequence
     */
    async startReplay(kqxs) {
        const resultPool = [];
        for (let i = 0; i <= 26; i++) {
            resultPool.push(this.createReplayData(kqxs, i));
        }

        // Start background music
        this.soundManager.isMute = false;
        if (!this.soundManager.bgSound?.playing()) {
            this.soundManager.bgSound?.play();
        }

        // Play intro
        setTimeout(() => {
            if (!this.soundManager.introFirst?.playing()) {
                this.soundManager.introFirst?.play();
                this.soundManager.introFirst?.once('end', () => {
                    this.resultsManager.updateKqxsMb(resultPool[0], true);
                });
            }
        }, 3000);

        // Play each result
        for (let i = 1; i <= 26; i++) {
            const delay = i === 26 ? 12500 : 12000;
            setTimeout(() => {
                this.resultsManager.updateKqxsMb(resultPool[i], true);
            }, delay * (i + 1));
        }
    }

    /**
     * Create replay data for specific step
     */
    createReplayData(kqxs, index) {
        const result = { ...kqxs };

        if (index === 0) {
            result.g0 = '';
            result.g2 = '';
            result.g3 = '';
            result.g4 = '';
            result.g5 = '';
            result.g6 = '';
            result.g7 = '';
            return result;
        }

        // Handle different prize groups
        this.handlePrizeGroups(result, index);
        return result;
    }

    /**
     * Handle different prize groups for replay
     */
    handlePrizeGroups(result, index) {
        if (index > 0 && index < 3) {
            const g2 = result.g2.split('-');
            result.g2 = g2.slice(0, index).join('-');
            this.clearLowerPrizes(result);
        } else if (index >= 3 && index <= 8) {
            const g3 = result.g3.split('-');
            result.g3 = g3.slice(0, index - 2).join('-');
            result.g4 = '';
            result.g5 = '';
            result.g6 = '';
            result.g7 = '';
        } else if (index >= 9 && index <= 12) {
            const g4 = result.g4.split('-');
            result.g4 = g4.slice(0, index - 8).join('-');
            result.g5 = '';
            result.g6 = '';
            result.g7 = '';
        } else if (index >= 13 && index <= 18) {
            const g5 = result.g5.split('-');
            result.g5 = g5.slice(0, index - 12).join('-');
            result.g6 = '';
            result.g7 = '';
        } else if (index > 18 && index <= 21) {
            const g6 = result.g6.split('-');
            result.g6 = g6.slice(0, index - 18).join('-');
            result.g7 = '';
        } else if (index > 21 && index <= 25) {
            const g7 = result.g7.split('-');
            result.g7 = g7.slice(0, index - 21).join('-');
        }
        result.g0 = '';
    }

    /**
     * Clear lower prize groups
     */
    clearLowerPrizes(result) {
        result.g0 = '';
        result.g3 = '';
        result.g4 = '';
        result.g5 = '';
        result.g6 = '';
        result.g7 = '';
    }

    /**
     * Initialize live results based on URL
     */
    initLiveResults() {
        const path = window.location.pathname;

        if (path.includes('xsmb') || path === '/') {
            this.firebaseService.liveMb();
        } else if (path.includes('xsmt')) {
            this.firebaseService.liveMt();
        } else if (path.includes('xsmn')) {
            this.firebaseService.liveMn();
        }

        // Fallback to polling if Firebase is not available
        if (!window.firebase) {
            this.firebaseService.startLivePolling();
        }
    }

    /**
     * Load try template for different regions
     */
    loadTryTemplate(region) {
        const tryContent = document.getElementById('try-content');
        if (!tryContent) return;

        const template = region === 1 ? this.getMbTryTemplate() : this.getMtMnTryTemplate();
        tryContent.innerHTML = template;
    }

    /**
     * Get Mien Bac try template
     */
    getMbTryTemplate() {
        return `<tr>
            <td colspan="3" class="color-highlight fw-medium">ĐB</td>
            <td colspan="24" class="txt-special-prize try_number_27" l="5">
                <div class="loadingio-spinner-spin-hgd29ahypuk">
                    <!-- Loading spinner content -->
                </div>
            </td>
        </tr>
        <!-- ... rest of the template ... -->`;
    }

    /**
     * Get Mien Trung/Nam try template
     */
    getMtMnTryTemplate() {
        return `<tr>
            <td colspan="3" class="fw-medium">G8</td>
            <td colspan="24" class="try_number_1 txt-normal-prize">
                <div class="loadingio-spinner-spin-hgd29ahypuk">
                    <!-- Loading spinner content -->
                </div>
            </td>
        </tr>
        <!-- ... rest of the template ... -->`;
    }

    /**
     * Reset try province results
     */
    resetTryProvinceResults() {
        const tryLoading = `<div class="loadingio-spinner-spin-hgd29ahypuk">
            <!-- Loading spinner content -->
        </div>`;

        document.querySelectorAll('#try-content .txt-normal-prize, #try-content .txt-special-prize')
            .forEach(el => el.innerHTML = tryLoading);

        document.querySelectorAll('#try-content .dd-kq')
            .forEach(el => el.innerHTML = '');
    }

    /**
     * Reset try region results
     */
    resetTryRegionResults() {
        const tryLoading = `<div class="loadingio-spinner-spin-hgd29ahypuk">
            <!-- Loading spinner content -->
        </div>`;

        document.querySelectorAll('#try-region-box .number')
            .forEach(el => el.innerHTML = '');

        document.querySelectorAll('#try-region-dd .dd-kq')
            .forEach(el => el.innerHTML = '');

        document.querySelectorAll('#try-region-box .try-g8 .number')
            .forEach(el => el.innerHTML = tryLoading);
    }

    /**
     * Handle ad block detection
     */
    detectAdsBlock() {
        setTimeout(() => {
            const adBoxEl = document.querySelector('.ad-box');
            if (adBoxEl && window.getComputedStyle(adBoxEl).display === 'none') {
                const notice = `<div class="modal" id="ads-block-notice">
                    <!-- Ad block notice content -->
                </div>`;
                document.body.insertAdjacentHTML('beforeend', notice);
            }
        }, 2000);

        document.addEventListener('click', (event) => {
            if (event.target.id === 'ads-block-accept') {
                document.getElementById('ads-block-notice')?.remove();
            }
        });
    }
}

// Create single instance and export to window
const app = new LotteryApp();
document.addEventListener('DOMContentLoaded', () => app.init());
window.LotteryApp = app;
