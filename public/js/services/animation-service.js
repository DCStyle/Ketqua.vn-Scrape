/**
 * Animation Service
 */
class AnimationService {
    constructor() {
        this.animations = new Map();
        this.defaultDuration = 800;
    }

    async animateNumber(element, finalNumber, duration = this.defaultDuration) {
        if (!element) return;

        const start = parseInt(element.textContent) || 0;
        const increment = (finalNumber - start) / (duration / 16);

        return new Promise(resolve => {
            const animation = {
                frame: 0,
                handle: null
            };

            const animate = () => {
                animation.frame++;
                const current = start + (increment * animation.frame);

                if (current >= finalNumber) {
                    element.textContent = finalNumber;
                    this.animations.delete(element);
                    resolve();
                    return;
                }

                element.textContent = Math.floor(current);
                animation.handle = requestAnimationFrame(animate);
            };

            this.animations.set(element, animation);
            animate();
        });
    }

    async animateDrawBall(ballContainer, number, duration = this.defaultDuration) {
        const ballHTML = `
            <div class="raffle-ball raffle-ball-${number}">
                <div class="ball-content">${number}</div>
            </div>
        `;

        ballContainer.innerHTML = ballHTML;
        const ball = ballContainer.querySelector('.raffle-ball');

        ball.style.animation = `dropBall ${duration}ms ease-out`;

        return new Promise(resolve => {
            setTimeout(() => {
                ball.style.animation = 'rotateBall 2s infinite linear';
                resolve();
            }, duration);
        });
    }

    async animateResultRow(row, numbers) {
        const cells = row.querySelectorAll('.number-cell');

        for (let i = 0; i < cells.length; i++) {
            const cell = cells[i];
            if (numbers[i] !== undefined) {
                await this.animateNumber(cell, numbers[i]);
                await this.delay(100);
            }
        }
    }

    animateProgressBar(element, progress) {
        if (!element) return;

        element.style.transition = 'width 0.3s ease-in-out';
        element.style.width = `${progress}%`;
    }

    animatePulse(element, duration = 1000) {
        if (!element) return;

        element.style.animation = `pulse ${duration}ms ease-in-out`;

        return new Promise(resolve => {
            element.addEventListener('animationend', () => {
                element.style.animation = '';
                resolve();
            }, { once: true });
        });
    }

    async animateLoadingSpinner(show = true) {
        const spinner = document.querySelector('.loading-spinner');
        if (!spinner) return;

        if (show) {
            spinner.classList.remove('d-none');
            spinner.style.animation = 'spin 1s linear infinite';
        } else {
            spinner.style.animation = 'fadeOut 0.3s ease-out';
            await this.delay(300);
            spinner.classList.add('d-none');
        }
    }

    stopAllAnimations() {
        this.animations.forEach((animation, element) => {
            if (animation.handle) {
                cancelAnimationFrame(animation.handle);
            }
            this.animations.delete(element);
        });
    }

    delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

const animationService = new AnimationService();
export default animationService;
