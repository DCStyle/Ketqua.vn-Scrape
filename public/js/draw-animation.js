/**
 * Draw Animation Manager
 */
class DrawAnimation {
    constructor() {
        this.currentDrawText = '';
        this.totalBalls = 6;
    }

    /**
     * Hide specific number of balls
     * @param {number} total
     */
    hideDrawBall(total) {
        if (total === 0) return false;

        for (let i = 6 - total; i <= 5; i++) {
            document.querySelector(`#ball_${i}`)?.classList.add('d-none');
        }
    }

    /**
     * Show balls based on loading state
     */
    showDrawBall() {
        const loadingElement = document.querySelector('.loading');
        if (!loadingElement) return;

        const totalLoadingBalls = loadingElement.textContent.length;
        if (totalLoadingBalls === 0) return;

        // Hide all balls first
        document.querySelectorAll('.draw-ball').forEach(ball => {
            ball.classList.add('d-none');
        });

        // Show only required number of balls
        const balls = document.querySelectorAll('.draw-ball');
        for (let i = 0; i < totalLoadingBalls && i < balls.length; i++) {
            balls[i].classList.remove('d-none');
        }
    }

    /**
     * Update the draw ball display
     * @param {string} number
     */
    updateDrawBall(number) {
        const numbers = number.split('');

        numbers.forEach((num, i) => {
            setTimeout(() => {
                const ballHtml = `
                    <div class="raffle-ball raffle-ball-${num} txt-special-prize">
                        <div>${num}</div>
                    </div>
                `;

                const ballElement = document.querySelector(`#ball_${i + 1}`);
                if (ballElement) {
                    ballElement.innerHTML = ballHtml;
                }
            }, (i + 1) * 300);
        });

        // Hide extra balls if needed
        this.hideDrawBall(5 - numbers.length);

        // Reset display after animation
        setTimeout(() => {
            this.clearDrawBall();
            this.showDrawBall();
        }, 6000);
    }

    /**
     * Clear all balls
     */
    clearDrawBall() {
        document.querySelectorAll('.raffle-ball').forEach(ball => {
            ball.remove();
        });
    }

    /**
     * Update the draw text label
     * @param {number} numberIndex
     */
    updateDrawText(numberIndex) {
        const drawLabel = document.querySelector('#draw_label');
        if (drawLabel && window.LotteryApp?.config?.drawTexts) {
            drawLabel.textContent = window.LotteryApp.config.drawTexts[numberIndex] || '';
        }
    }

    /**
     * Reset the draw display
     */
    resetDrawDisplay() {
        this.clearDrawBall();
        this.updateDrawText(0);
        document.querySelectorAll('.draw-ball').forEach(ball => {
            ball.classList.remove('d-none');
        });
    }

    /**
     * Initialize loading animation
     */
    initLoadingAnimation() {
        const loadingInterval = setInterval(() => {
            document.querySelectorAll('.loading').forEach(element => {
                const td = element.closest('td');
                if (!td) return;

                const length = td.getAttribute('l');
                if (!length) return;

                element.textContent = window.LotteryApp.utils.getRandomNumbers(parseInt(length));
            });
        }, 100);

        return loadingInterval;
    }
}

const drawAnimation = new DrawAnimation();
export default drawAnimation;
