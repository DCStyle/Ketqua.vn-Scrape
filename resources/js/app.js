import './bootstrap';

function getRandomNumbers(length) {
    return Math.floor(9 * Math.random() * Math.pow(10, length - 1)) + Math.pow(10, length - 1);
}
