/**
 * Firebase Real-time Data Service
 */
import resultsManager from './results-manager.js';

class FirebaseService {
    constructor() {
        this.database = null;
        this.initialized = false;
        this.loadingTemplate = '<div class="loading"></div>';
    }

    /**
     * Initialize Firebase connection
     */
    init() {
        if (this.initialized || !window.firebase) return;

        try {
            this.database = window.firebase.database();
            this.initialized = true;
        } catch (error) {
            console.error('Failed to initialize Firebase:', error);
        }
    }

    /**
     * Start listening for Mien Bac lottery updates
     */
    liveMb() {
        if (!this.initialized) {
            console.error('Firebase not initialized');
            return;
        }

        // Scroll to results table
        window.LotteryApp.utils.scrollToElement('kqxs-box');

        // Listen for real-time updates
        this.database.ref('xsmb').on('value', snapshot => {
            const data = snapshot.val();
            if (!data) return;

            Object.values(data).forEach(kqxs => {
                if (!kqxs) return;

                switch(kqxs.province_id) {
                    case 22: // Main lottery
                        resultsManager.updateKqxsMb(kqxs, false);
                        break;
                    case 37: // Special type 1
                        this.updateKqxsDt123(kqxs);
                        break;
                    case 38: // Special type 2
                        this.updateKqxsDt636(kqxs);
                        break;
                    case 39: // Special type 3
                        this.updateKqxsTt(kqxs);
                        break;
                }
            });
        });
    }

    /**
     * Start listening for Mien Trung lottery updates
     */
    liveMt() {
        if (!this.initialized) return;

        window.LotteryApp.utils.scrollToElement('kqxs-box');

        this.database.ref('xsmt').on('value', snapshot => {
            const data = snapshot.val();
            if (!data) return;

            Object.values(data).forEach(kqxs => {
                this.updateKqxsTn(kqxs);
            });
        });
    }

    /**
     * Start listening for Mien Nam lottery updates
     */
    liveMn() {
        if (!this.initialized) return;

        window.LotteryApp.utils.scrollToElement('kqxs-box');

        this.database.ref('xsmn').on('value', snapshot => {
            const data = snapshot.val();
            if (!data) return;

            Object.values(data).forEach(kqxs => {
                this.updateKqxsTn(kqxs);
            });
        });
    }

    /**
     * Update special lottery type 1
     */
    updateKqxsDt123(kqxs) {
        const data = kqxs.g0.split('-');
        const elements = {
            'dt123_g0': data[0] || '',
            'dt123_g1': data[1] || '',
            'dt123_g2': data[2] || ''
        };

        Object.entries(elements).forEach(([className, value]) => {
            const element = document.querySelector(`.${className}`);
            if (element) {
                element.innerHTML = value || this.loadingTemplate;
            }
        });
    }

    /**
     * Update special lottery type 2
     */
    updateKqxsDt636(kqxs) {
        const data = kqxs.g0.split('-');
        const elements = {
            'dt636_g0': data[0] || '',
            'dt636_g1': data[1] || '',
            'dt636_g2': data[2] || '',
            'dt636_g3': data[3] || '',
            'dt636_g4': data[4] || '',
            'dt636_g5': data[5] || ''
        };

        Object.entries(elements).forEach(([className, value]) => {
            const element = document.querySelector(`.${className}`);
            if (element) {
                element.innerHTML = value || this.loadingTemplate;
            }
        });
    }

    /**
     * Update traditional lottery
     */
    updateKqxsTt(kqxs) {
        const element = document.querySelector('.tt_g0');
        if (element) {
            element.innerHTML = kqxs.g0 || this.loadingTemplate;
        }
    }

    /**
     * Update regional lottery results
     */
    updateKqxsTn(kqxs) {
        const prefix = kqxs.sms_code;
        const g3 = kqxs.g3.split('-');
        const g4 = kqxs.g4.split('-');
        const g6 = kqxs.g6.split('-');

        const elements = {
            [`${prefix}_g8`]: kqxs.g8,
            [`${prefix}_g7`]: kqxs.g7,
            [`${prefix}_g61`]: g6[0],
            [`${prefix}_g62`]: g6[1],
            [`${prefix}_g63`]: g6[2],
            [`${prefix}_g5`]: kqxs.g5,
            [`${prefix}_g41`]: g4[0],
            [`${prefix}_g42`]: g4[1],
            [`${prefix}_g43`]: g4[2],
            [`${prefix}_g44`]: g4[3],
            [`${prefix}_g45`]: g4[4],
            [`${prefix}_g46`]: g4[5],
            [`${prefix}_g47`]: g4[6],
            [`${prefix}_g31`]: g3[0],
            [`${prefix}_g32`]: g3[1],
            [`${prefix}_g2`]: kqxs.g2,
            [`${prefix}_g1`]: kqxs.g1,
        };

        // Special handling for g0
        if (kqxs.g0 === '' && kqxs.g8 !== '') {
            elements[`${prefix}_g0`] = this.loadingTemplate;
        } else {
            elements[`${prefix}_g0`] = kqxs.g0;
        }

        // Update DOM elements
        Object.entries(elements).forEach(([className, value]) => {
            const element = document.querySelector(`.${className}`);
            if (element) {
                element.innerHTML = value || this.loadingTemplate;
            }
        });

        // Update lotos display
        this.updateLotoDisplays(kqxs, prefix);
    }

    /**
     * Update loto number displays
     */
    updateLotoDisplays(kqxs, prefix) {
        try {
            const lotos = JSON.parse(kqxs.lotos);
            const specialPrize = kqxs.g0.slice(-2);

            // Update head numbers
            if (lotos.dau_loto) {
                Object.entries(lotos.dau_loto).forEach(([key, value]) => {
                    const element = document.querySelector(`.${prefix}_dau_${key}`);
                    if (element) {
                        const sortedNumbers = value.sort().join('; ')
                            .replace(specialPrize, `<span class="color-highlight">${specialPrize}</span>`);
                        element.innerHTML = sortedNumbers;
                    }
                });
            }

            // Update tail numbers
            if (lotos.dit_loto) {
                Object.entries(lotos.dit_loto).forEach(([key, value]) => {
                    const element = document.querySelector(`.${prefix}_duoi_${key}`);
                    if (element) {
                        const sortedNumbers = value.sort().join('; ')
                            .replace(specialPrize, `<span class="color-highlight">${specialPrize}</span>`);
                        element.innerHTML = sortedNumbers;
                    }
                });
            }
        } catch (error) {
            console.error('Error updating loto displays:', error);
        }
    }

    /**
     * Start live polling for results (alternative to Firebase)
     */
    startLivePolling() {
        const pollInterval = 5000; // 5 seconds
        const currentTime = new Date();
        const hour = currentTime.getHours();

        if ((hour === 16 || hour === 17 || hour === 18) && !this.pollingInterval) {
            this.pollingInterval = setInterval(() => {
                fetch(`${window.location.origin}/api/v1/live-results`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            data.forEach(kqxs => {
                                if (kqxs.province_id === 22) {
                                    resultsManager.updateKqxsMb(kqxs, false);
                                }
                            });
                        }
                    })
                    .catch(error => console.error('Polling error:', error));
            }, pollInterval);
        }
    }

    /**
     * Stop live polling
     */
    stopLivePolling() {
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
            this.pollingInterval = null;
        }
    }
}

const firebaseService = new FirebaseService();
export default firebaseService;
