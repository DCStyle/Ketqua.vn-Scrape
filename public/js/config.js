/**
 * Global Configuration Settings
 */
const LotteryConfig = {
    // Firebase configuration
    firebase: {
        apiKey: "AIzaSyC6A1OOT1vJY-Gg4rKbIqYY9IT6QFazZuw",
        authDomain: "ketqua.vn",
        databaseURL: "https://ketquavn-7fdef-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "ketquavn-7fdef",
        storageBucket: "ketquavn-7fdef.appspot.com",
        messagingSenderId: "549690883362",
        appId: "1:549690883362:web:d28c780d4c9100b13df97b",
        measurementId: "G-K1M5ZCFJNH"
    },

    // Draw text mappings
    drawTexts: {
        0: "Quay giải nhất",
        1: "Quay giải nhì lần 1",
        2: "Quay giải nhì lần 2",
        3: "Quay giải ba lần 1",
        4: "Quay giải ba lần 2",
        5: "Quay giải ba lần 3",
        6: "Quay giải ba lần 4",
        7: "Quay giải ba lần 5",
        8: "Quay giải ba lần 6",
        9: "Quay giải tư lần 1",
        10: "Quay giải tư lần 2",
        11: "Quay giải tư lần 3",
        12: "Quay giải tư lần 4",
        13: "Quay giải năm lần 1",
        14: "Quay giải năm lần 2",
        15: "Quay giải năm lần 3",
        16: "Quay giải năm lần 4",
        17: "Quay giải năm lần 5",
        18: "Quay giải năm lần 6",
        19: "Quay giải sáu lần 1",
        20: "Quay giải sáu lần 2",
        21: "Quay giải sáu lần 3",
        22: "Quay giải bảy lần 1",
        23: "Quay giải bảy lần 2",
        24: "Quay giải bảy lần 3",
        25: "Quay giải bảy lần 4",
        26: "Quay giải đặc biệt"
    },

    // Sound file mappings
    drawSounds: {
        0: "quay-giai-1",
        1: "quay-giai-2_lan-1",
        2: "quay-giai-2_lan-2",
        3: "quay-giai-3_lan-1",
        4: "quay-giai-3_lan-2",
        5: "quay-giai-3_lan-3",
        6: "quay-giai-3_lan-4",
        7: "quay-giai-3_lan-5",
        8: "quay-giai-3_lan-6",
        9: "quay-giai-4_lan-1",
        10: "quay-giai-4_lan-2",
        11: "quay-giai-4_lan-3",
        12: "quay-giai-4_lan-4",
        13: "quay-giai-5_lan-1",
        14: "quay-giai-5_lan-2",
        15: "quay-giai-5_lan-3",
        16: "quay-giai-5_lan-4",
        17: "quay-giai-5_lan-5",
        18: "quay-giai-5_lan-6",
        19: "quay-giai-6_lan-1",
        20: "quay-giai-6_lan-2",
        21: "quay-giai-6_lan-3",
        22: "quay-giai-7_lan-1",
        23: "quay-giai-7_lan-2",
        24: "quay-giai-7_lan-3",
        25: "quay-giai-7_lan-4",
        26: "quay-giai-db"
    },

    // Browser detection configuration
    userAgents: [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/91.0.4472.124',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0'
    ],

    // Cache settings
    cache: {
        defaultTTL: 300, // 5 minutes in seconds
    }
};

export default LotteryConfig;
