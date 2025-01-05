/**
 * Sound Management System
 */
import { default as LotteryConfig } from './config.js';

class SoundManager {
    constructor() {
        this.isMute = true;
        this.soundPool = {};
        this.soundQueue = [];
        this.bgSound = null;
        this.introFirst = null;
        this.initialized = false;

        // Ensure Howl is available
        if (typeof window.Howl === 'undefined') {
            console.error('Howler.js is required but not loaded!');
            return;
        }
    }

    /**
     * Initialize all sound resources
     */
    initSounds() {
        if (this.initialized || typeof window.Howl === 'undefined') {
            return;
        }

        // Initialize background music
        this.bgSound = new window.Howl({
            src: ['/assets/sounds/xoso-music-theme.mp3'],
            html5: true,
            volume: 0.5,
            loop: true
        });

        // Initialize intro sound
        this.introFirst = new window.Howl({
            src: ['/assets/sounds/intro-first.mp3'],
            html5: true,
            volume: 0.5
        });

        // Initialize all game sounds
        const soundNames = [
            'ting', 'intro-last', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            'quay-giai-1', 'quay-giai-2', 'quay-giai-3', 'quay-giai-4', 'quay-giai-5',
            'quay-giai-6', 'quay-giai-7', 'quay-giai-db',
            'lan-1', 'lan-2', 'lan-3', 'lan-4', 'lan-5', 'lan-6'
        ];

        soundNames.forEach(soundName => {
            this.soundPool[soundName] = new window.Howl({
                src: [`/assets/sounds/${soundName}.mp3`]
            });
        });

        this.initialized = true;
        this.setupEventListeners();
    }

    /**
     * Setup UI event listeners
     */
    setupEventListeners() {
        document.querySelector('.sound-on')?.addEventListener('click', () => {
            document.querySelector('.sound-on')?.classList.add('d-none');
            this.toggleMute();
        });

        document.querySelector('#mute')?.addEventListener('click', () => {
            this.toggleMute();
        });
    }

    /**
     * Toggle mute state
     */
    toggleMute() {
        this.isMute = !this.isMute;

        if (this.isMute) {
            this.bgSound?.mute(true);
            this.introFirst?.pause();
        } else {
            this.bgSound?.mute(false);
            if (!this.bgSound?.playing()) {
                if (!this.introFirst?.playing()) {
                    this.introFirst?.play();
                    setTimeout(() => {
                        if (!this.bgSound?.playing()) {
                            this.bgSound?.play();
                        }
                    }, 3000);
                }
            }
        }

        // Update UI
        const muteButton = document.querySelector('#mute i');
        if (muteButton) {
            if (this.isMute) {
                muteButton.classList.remove('fa-volume-up');
                muteButton.classList.add('fa-volume-mute');
            } else {
                muteButton.classList.remove('fa-volume-mute');
                muteButton.classList.add('fa-volume-up');
            }
        }
    }

    /**
     * Add sound to queue
     */
    addSound(name) {
        this.soundQueue.push(name);
    }

    /**
     * Clear sound queue
     */
    clearSound() {
        this.soundQueue = [];
    }

    /**
     * Play queued sounds
     */
    playSound() {
        if (this.isMute || this.introFirst?.playing()) {
            return;
        }

        this.soundQueue.forEach((soundName, index) => {
            const sound = this.soundPool[soundName];
            if (sound) {
                setTimeout(() => {
                    sound.play();
                }, index * 1000);
            }
        });

        this.clearSound();
    }
}

// Create singleton instance
const soundManager = new SoundManager();
export default soundManager;
