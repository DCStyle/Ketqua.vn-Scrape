/**
 * Lottery Results Manager
 */
import drawAnimation from './draw-animation.js';

class ResultsManager {
    constructor() {
        this.mbLatestData = '';
        this.currentPage = 1;
        this.loadingTemplate = '<div class="loading"></div>';
    }

    /**
     * Process lottery numbers and generate loto results
     */
    getLotteryLotos(numbers, region) {
        const results = {
            head: {0:[],1:[],2:[],3:[],4:[],5:[],6:[],7:[],8:[],9:[]},
            tail: {0:[],1:[],2:[],3:[],4:[],5:[],6:[],7:[],8:[],9:[]}
        };

        numbers.forEach((number, i) => {
            const loto = number.toString().slice(-2);
            let lotoHTML = loto;

            // Special formatting for certain prizes
            if ((i === 26 && region === 1) || (i === 17 && region !== 1)) {
                lotoHTML = `<span class="color-highlight">${loto}</span>`;
            }

            results.head[loto[0]].push(lotoHTML);
            results.tail[loto[1]].push(lotoHTML);
        });

        return results;
    }

    /**
     * Update Mien Bac lottery results
     */
    async updateKqxsMb(kqxs, forceUpdate = false) {
        // Generate unique string from result data
        const kqxsDataString = kqxs.g0 + kqxs.g1 + kqxs.g2 + kqxs.g3 +
            kqxs.g4 + kqxs.g5 + kqxs.g6 + kqxs.g7;

        // Skip update if data hasn't changed
        if (kqxsDataString === this.mbLatestData && !forceUpdate) {
            return false;
        }

        this.mbLatestData = kqxsDataString;

        // Process prize data
        const smsCode = kqxs.sms_code;
        const numbers = {
            [`${smsCode}_g1`]: this._checkEmpty(kqxs.g1),
            [`${smsCode}_g21`]: this._checkEmpty(kqxs.g2.split('-')[0]),
            [`${smsCode}_g22`]: this._checkEmpty(kqxs.g2.split('-')[1]),
            [`${smsCode}_g31`]: this._checkEmpty(kqxs.g3.split('-')[0]),
            [`${smsCode}_g32`]: this._checkEmpty(kqxs.g3.split('-')[1]),
            [`${smsCode}_g33`]: this._checkEmpty(kqxs.g3.split('-')[2]),
            [`${smsCode}_g34`]: this._checkEmpty(kqxs.g3.split('-')[3]),
            [`${smsCode}_g35`]: this._checkEmpty(kqxs.g3.split('-')[4]),
            [`${smsCode}_g36`]: this._checkEmpty(kqxs.g3.split('-')[5]),
            [`${smsCode}_g41`]: this._checkEmpty(kqxs.g4.split('-')[0]),
            [`${smsCode}_g42`]: this._checkEmpty(kqxs.g4.split('-')[1]),
            [`${smsCode}_g43`]: this._checkEmpty(kqxs.g4.split('-')[2]),
            [`${smsCode}_g44`]: this._checkEmpty(kqxs.g4.split('-')[3]),
            [`${smsCode}_g51`]: this._checkEmpty(kqxs.g5.split('-')[0]),
            [`${smsCode}_g52`]: this._checkEmpty(kqxs.g5.split('-')[1]),
            [`${smsCode}_g53`]: this._checkEmpty(kqxs.g5.split('-')[2]),
            [`${smsCode}_g54`]: this._checkEmpty(kqxs.g5.split('-')[3]),
            [`${smsCode}_g55`]: this._checkEmpty(kqxs.g5.split('-')[4]),
            [`${smsCode}_g56`]: this._checkEmpty(kqxs.g5.split('-')[5]),
            [`${smsCode}_g61`]: this._checkEmpty(kqxs.g6.split('-')[0]),
            [`${smsCode}_g62`]: this._checkEmpty(kqxs.g6.split('-')[1]),
            [`${smsCode}_g63`]: this._checkEmpty(kqxs.g6.split('-')[2]),
            [`${smsCode}_g71`]: this._checkEmpty(kqxs.g7.split('-')[0]),
            [`${smsCode}_g72`]: this._checkEmpty(kqxs.g7.split('-')[1]),
            [`${smsCode}_g73`]: this._checkEmpty(kqxs.g7.split('-')[2]),
            [`${smsCode}_g74`]: this._checkEmpty(kqxs.g7.split('-')[3]),
        };

        // Special handling for g0 (special prize)
        if (kqxs.g0 === '' && kqxs.g7.split('-')[3] !== undefined) {
            numbers[`${smsCode}_g0`] = this.loadingTemplate;
        } else {
            numbers[`${smsCode}_g0`] = kqxs.g0;
        }

        await this._updateNumbersAndLotos(kqxs, numbers);
    }

    /**
     * Update numbers and lotos display
     */
    async _updateNumbersAndLotos(kqxs, numbers) {
        // Clear previous sound queue
        window.LotteryApp.soundManager.clearSound();
        window.LotteryApp.soundManager.addSound('ting');

        let latestNumber = '';
        let latestIndex = 0;
        let index = 1;

        // Update number displays
        for (const [key, number] of Object.entries(numbers)) {
            if (number === null) continue;

            const element = document.querySelector(`.${key}`);
            if (element) {
                element.innerHTML = number;
                if (number !== this.loadingTemplate && number !== '') {
                    latestNumber = number;
                    latestIndex = index;
                }
            }
            index++;
        }

        // Add number sounds
        latestNumber.split('').forEach(num => {
            window.LotteryApp.soundManager.addSound(num);
        });

        // Update animations
        drawAnimation.updateDrawBall(latestNumber);
        drawAnimation.updateDrawText(latestIndex);

        // Handle special sounds
        const nextSound = window.LotteryApp.config.drawSounds[latestIndex];
        if (nextSound) {
            if (!nextSound.includes('_')) {
                window.LotteryApp.soundManager.addSound(nextSound);
            } else {
                nextSound.split('_').forEach(soundItem => {
                    window.LotteryApp.soundManager.addSound(soundItem);
                });
            }
        }

        // Handle end of draw sounds
        if (kqxs.g0 !== '') {
            window.LotteryApp.soundManager.addSound('intro-last');
            window.LotteryApp.soundManager.bgSound?.stop();
        } else if (kqxs.g7.length === 11) {
            window.LotteryApp.soundManager.addSound('intro-last');
        }

        // Update loto displays
        this._updateLotoDisplays(kqxs);

        // Play sounds
        window.LotteryApp.soundManager.playSound();
    }

    /**
     * Update loto number displays
     */
    _updateLotoDisplays(kqxs) {
        const lotos = JSON.parse(kqxs.lotos);
        const prefix = kqxs.sms_code;
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
    }

    /**
     * Check for empty value and return loading template if needed
     */
    _checkEmpty(value) {
        return value === '' || value == null ? this.loadingTemplate : value;
    }
}

const resultsManager = new ResultsManager();
export default resultsManager;
