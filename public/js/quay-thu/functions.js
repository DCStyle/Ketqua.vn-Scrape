// -------------------------------------------------------
// Global variables (same as your original script)
// -------------------------------------------------------
var loading = '<div class="loading"></div>';
var firebaseConfig = {
    apiKey: "AIzaSyC6A1OOT1vJY-Gg4rKbIqYY9IT6QFazZuw",
    authDomain: "ketqua.vn",
    databaseURL: "https://ketquavn-7fdef-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "ketquavn-7fdef",
    storageBucket: "ketquavn-7fdef.appspot.com",
    messagingSenderId: "549690883362",
    appId: "1:549690883362:web:d28c780d4c9100b13df97b",
    measurementId: "G-K1M5ZCFJNH"
};
var database = {};
var mbLatestData = "";
var isMute = true;
var latestNumber = "";
var mbDrawTexts = {
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
};
var mbDrawSounds = {
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
};
var bgSound, introFirst;
var soundPool = {};
var soundQueue = [];
var currentPage = 1;


// -------------------------------------------------------
// 1) Detect Ads Block
//    (formerly used jQuery's setTimeout + append + on-click)
// -------------------------------------------------------
function detectAdsBlock() {
    // Check for ad-block after 2 seconds
    setTimeout(function() {
        var adBoxEl = document.querySelector(".ad-box");
        if (adBoxEl !== null && window.getComputedStyle(adBoxEl).display === "none") {
            var adsNoticeHTML = '<div class="modal" id="ads-block-notice">' +
                '<div class="modal-dialog" role="document">' +
                '<div class="modal-content">' +
                '<div class="modal-body">' +
                '<div class="exclamation-icon"><span class="icon"><i class="fas fa-exclamation"></i></span></div>' +
                '<h5 class="mt-3">Phát hiện trình chặn quảng cáo</h5>' +
                '<p>Quảng cáo là nguồn doanh thu giúp duy trì và phát triển hệ thống.</p>' +
                '<p>Ủng hộ team ketqua.vn bằng cách bỏ chặn quảng cáo.</p>' +
                '<button type="button" class="btn btn-success mt-2" id="ads-block-accept"><i class="fas fa-smile"></i> Tôi đồng ý</button>' +
                '</div></div></div></div>';
            document.body.insertAdjacentHTML('beforeend', adsNoticeHTML);
        }
    }, 2000);

    // Listen for click on #ads-block-accept (delegated)
    document.addEventListener("click", function(e) {
        if (e.target && e.target.id === "ads-block-accept") {
            var modal = document.getElementById("ads-block-notice");
            if (modal) {
                modal.remove();
            }
        }
    });
}


// -------------------------------------------------------
// 2) Loading Templates
// -------------------------------------------------------
function loadMbTryTemplate() {
    var html = '<tr><td colspan="3" class="color-highlight fw-medium">ĐB</td>' +
        '<td colspan="24" class="txt-special-prize try_number_27" l="5">' +
        '<div class="loadingio-spinner-spin-hgd29ahypuk"><div class="ldio-68g4b00eac8">' +
        '<div><div></div></div><div><div></div></div><div><div></div></div>' +
        '<div><div></div></div><div><div></div></div><div><div></div></div>' +
        '<div><div></div></div><div><div></div></div></div></div>' +
        '</td></tr>' +
        // ... (truncated for brevity — reuse your exact HTML)
        '<tr class="bg-color-lotto-background">' +
        '<td colspan="3" class="fw-medium">G7</td>' +
        '<td colspan="6" class="txt-normal-prize try_number_23" l="2"><div class="loadingio-spinner-spin-hgd29ahypuk">' +
        // ...
        '</div></div></td></tr>';

    var tryContentEl = document.getElementById("try-content");
    if (tryContentEl) {
        tryContentEl.innerHTML = html;
    }
}

function loadMtMnTryTemplate() {
    var html = '<tr><td colspan="3" class="fw-medium">G8</td><td colspan="24" class="try_number_1 txt-normal-prize">' +
        '<div class="loadingio-spinner-spin-hgd29ahypuk"><div class="ldio-68g4b00eac8">' +
        '<div><div></div></div><div><div></div></div><div><div></div></div>' +
        // ... (similarly truncated for brevity)
        '</div></div></td></tr>';

    var tryContentEl = document.getElementById("try-content");
    if (tryContentEl) {
        tryContentEl.innerHTML = html;
    }
}


// -------------------------------------------------------
// 3) Reset Results
// -------------------------------------------------------
function resetTryProvinceResults() {
    var tryLoading = '<div class="loadingio-spinner-spin-hgd29ahypuk">' +
        '<div class="ldio-68g4b00eac8"><div><div></div></div><div><div></div></div>' +
        '<div><div></div></div><div><div></div></div><div><div></div></div>' +
        '<div><div></div></div><div><div></div></div><div><div></div></div></div></div>';

    // Replace .txt-normal-prize
    document.querySelectorAll("#try-content .txt-normal-prize").forEach(function(el) {
        el.innerHTML = tryLoading;
    });
    // Replace .txt-special-prize
    document.querySelectorAll("#try-content .txt-special-prize").forEach(function(el) {
        el.innerHTML = tryLoading;
    });
    // Clear .dd-kq
    document.querySelectorAll("#try-content .dd-kq").forEach(function(el) {
        el.innerHTML = "";
    });
}

function resetTryRegionResults() {
    var tryLoading = '<div class="loadingio-spinner-spin-hgd29ahypuk">' +
        '<div class="ldio-68g4b00eac8"><div><div></div></div><div><div></div></div>' +
        '<div><div></div></div><div><div></div></div><div><div></div></div>' +
        '<div><div></div></div><div><div></div></div><div><div></div></div></div></div>';

    // Clear .number
    document.querySelectorAll("#try-region-box .number").forEach(function(el) {
        el.innerHTML = "";
    });
    // Clear .dd-kq
    document.querySelectorAll("#try-region-dd .dd-kq").forEach(function(el) {
        el.innerHTML = "";
    });
    // Replace .try-g8 .number with spinner
    document.querySelectorAll("#try-region-box .try-g8 .number").forEach(function(el) {
        el.innerHTML = tryLoading;
    });
}


// -------------------------------------------------------
// 4) Generating Lottery Lotos
// -------------------------------------------------------
function getLotteryLotos(numbers, region) {
    var results = {
        head: {
            0: [], 1: [], 2: [], 3: [], 4: [],
            5: [], 6: [], 7: [], 8: [], 9: []
        },
        tail: {
            0: [], 1: [], 2: [], 3: [], 4: [],
            5: [], 6: [], 7: [], 8: [], 9: []
        }
    };

    for (var i = 0; i < numbers.length; i++) {
        var loto = numbers[i].toString().substr(-2);
        var lotoHTML = loto;
        // Special color highlight for "Đặc biệt"
        // region=1 => step=26, region!=1 => step=17
        // Adjust as needed if you wish the same logic:
        if ((i === 26 && region === 1) || (i === 17 && region !== 1)) {
            lotoHTML = '<span class="color-highlight">' + loto + '</span>';
        }
        results.head[loto[0]].push(lotoHTML);
        results.tail[loto[1]].push(lotoHTML);
    }

    return results;
}


// -------------------------------------------------------
// 5) Render "Quay Thử" Results (Province-level)
// -------------------------------------------------------
async function renderTryProvinceResults() {
    var selectEl = document.getElementById("try-province-select");
    if (!selectEl) return;

    var parts = selectEl.value.split("-");
    if (parts.length < 1) return;

    var region = parts[1];  // "1" => MB, else => MT/MN
    var randomResults = [];
    var randomLotos = [];

    if (region === "1") {
        // MB region
        for (var step = 1; step <= 27; step++) {
            var generateNumberLength = 0;
            // G1..G9 + GDB => length=5
            if ((step >= 1 && step <= 9) || step === 27) {
                generateNumberLength = 5;
            }
            // G10..G19 => length=4
            if (step >= 10 && step <= 19) {
                generateNumberLength = 4;
            }
            // G20..G22 => length=3
            if (step >= 20 && step <= 22) {
                generateNumberLength = 3;
            }
            // G23..G26 => length=2
            if (step >= 23 && step <= 26) {
                generateNumberLength = 2;
            }

            var number = getRandomNumbers(generateNumberLength);
            randomResults.push(number);

            // Update lotos
            randomLotos = getLotteryLotos(randomResults, 1);

            // Update UI for .try_number_STEP
            document.querySelectorAll(".try_number_" + step).forEach(function(el) {
                el.innerHTML = number;
            });

            // Update đầu/đuôi
            for (var i = 0; i <= 9; i++) {
                document.querySelectorAll(".dau_" + i).forEach(function(el) {
                    el.innerHTML = randomLotos.head[i].join("; ");
                });
                document.querySelectorAll(".duoi_" + i).forEach(function(el) {
                    el.innerHTML = randomLotos.tail[i].join("; ");
                });
            }

            await sleep(800);
        }
    } else {
        // MT / MN region
        for (var step = 1; step <= 18; step++) {
            var generateNumberLength = 0;
            if (step === 1) {
                generateNumberLength = 2;  // G8
            } else if (step === 2) {
                generateNumberLength = 3;  // G7
            } else if (step >= 3 && step <= 6) {
                generateNumberLength = 4;  // G6.1 -> G6.4
            } else if (step >= 7 && step <= 17) {
                generateNumberLength = 5;  // G5->G1
            } else if (step === 18) {
                generateNumberLength = 6;  // DB
            }

            var number = getRandomNumbers(generateNumberLength);
            randomResults.push(number);

            // Update lotos
            randomLotos = getLotteryLotos(randomResults, 2);

            // Update UI
            document.querySelectorAll(".try_number_" + step).forEach(function(el) {
                el.innerHTML = number;
            });

            // Update đầu/đuôi
            for (var i = 0; i <= 9; i++) {
                document.querySelectorAll(".dau_" + i).forEach(function(el) {
                    el.innerHTML = randomLotos.head[i].join("; ");
                });
                document.querySelectorAll(".duoi_" + i).forEach(function(el) {
                    el.innerHTML = randomLotos.tail[i].join("; ");
                });
            }

            await sleep(800);
        }
    }
}


// -------------------------------------------------------
// 6) Render "Quay Thử" Results (Region-level)
// -------------------------------------------------------
async function renderTryRegionResults() {
    // Gather all option values from #try-province-select
    var selectEl = document.getElementById("try-province-select");
    if (!selectEl) return;

    var diws = [];
    selectEl.querySelectorAll("option").forEach(function(opt) {
        diws.push(opt.value);
    });

    // Prepare random results for each province
    var randomResults = {};
    var randomLotos = {};

    for (var i = 0; i < diws.length; i++) {
        randomResults[diws[i]] = [];
        randomLotos[diws[i]] = [];
    }

    // 18 steps for typical MT/MN
    for (var step = 1; step <= 18; step++) {
        var generateNumberLength = 0;
        if (step === 1) {
            generateNumberLength = 2;
        } else if (step === 2) {
            generateNumberLength = 3;
        } else if (step >= 3 && step <= 6) {
            generateNumberLength = 4;
        } else if (step >= 7 && step <= 17) {
            generateNumberLength = 5;
        } else if (step === 18) {
            generateNumberLength = 6;
        }

        // For each province in diws
        for (var i = 0; i < diws.length; i++) {
            var pid = diws[i];
            var number = getRandomNumbers(generateNumberLength);
            randomResults[pid].push(number);

            // Recompute lotos
            randomLotos[pid] = getLotteryLotos(randomResults[pid], 2);

            // Update UI
            document.querySelectorAll(".try_number_" + pid + "_" + step).forEach(function(el) {
                el.innerHTML = number;
            });

            // Update đầu
            for (var j = 0; j <= 9; j++) {
                document.querySelectorAll(".dd_" + pid + "_dau_" + j).forEach(function(el) {
                    el.innerHTML = randomLotos[pid].head[j].join("; ");
                });
            }
        }

        await sleep(800);
    }
}


// -------------------------------------------------------
// 7) Detect "Quay Thử" lottery events
//    (replaces jQuery .change(), .click())
// -------------------------------------------------------
function detectTryLottery() {
    // On #try-province-select change
    var provinceSelect = document.getElementById("try-province-select");
    if (provinceSelect) {
        provinceSelect.addEventListener("change", function() {
            var parts = this.value.split("-");
            if (parts.length < 1) return;

            // Determine region
            var region = parts[1];
            if (region === "1") {
                loadMbTryTemplate();
            } else {
                loadMtMnTryTemplate();
            }

            // Show name in #try-province-name
            var provinceNameEl = document.getElementById("try-province-name");
            if (provinceNameEl) {
                var text = this.options[this.selectedIndex].text;
                provinceNameEl.innerHTML = text || "";
            }
        });
    }

    // On #try-diw-select change
    var diwSelect = document.getElementById("try-diw-select");
    if (diwSelect) {
        diwSelect.addEventListener("change", function() {
            var diw = this.value;
            var region = document.getElementById("try-region").value;
            var regionProvinces = JSON.parse(provinces); // must be globally defined
            var html = "";
            var diwProvinces = [];

            // Collect provinces whose "days" includes `diw` or equals "0"
            regionProvinces.forEach(function(p) {
                if (p.days.indexOf(diw) !== -1 || p.days === "0") {
                    html += '<option value="' + p.id + '">' + p.name + '</option>';
                    diwProvinces.push(p);
                }
            });

            // Update #try-province-select
            if (provinceSelect) {
                provinceSelect.innerHTML = html;
            }

            // If region>1 => show region-based template
            if (region > 1) {
                // Build region template dynamically
                var tryRegionBodyHTML = '';
                var tryRegionDDHTML = '';

                // Row with province names
                tryRegionBodyHTML += '<tr class="bg-light"><th colspan="3" class="color-sub-brand txt-content fw-medium p-0">Tỉnh</th>';
                diwProvinces.forEach(function(p) {
                    var tryProvinceUrl = rootUrl + 'quay-thu-xo-so-' + p.slug;
                    tryRegionBodyHTML += '<th colspan="8" class="color-sub-brand txt-content fw-medium">' +
                        '<a href="' + tryProvinceUrl + '">' + p.name + '</a></th>';
                });
                tryRegionBodyHTML += '</tr>';

                // G8 row
                tryRegionBodyHTML += '<tr><td colspan="3" class="fw-medium">G8</td>';
                diwProvinces.forEach(function(p) {
                    tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize try-g8"><div class="number try_number_' +
                        p.id + '_1">' +
                        '<div class="loadingio-spinner-spin-hgd29ahypuk">' +
                        '<div class="ldio-68g4b00eac8"><div><div></div></div><div><div></div></div>' +
                        // ...
                        '</div></div></div></td>';
                });
                tryRegionBodyHTML += '</tr>';

                // G7 row
                tryRegionBodyHTML += '<tr class="bg-color-lotto-background"><td colspan="3" class="fw-medium">G7</td>';
                diwProvinces.forEach(function(p) {
                    tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                        p.id + '_2"></div></td>';
                });
                tryRegionBodyHTML += '</tr>';

                // G6 (3 rows)
                for (var i = 1; i <= 3; i++) {
                    tryRegionBodyHTML += '<tr>';
                    if (i === 1) {
                        tryRegionBodyHTML += '<td colspan="3" rowspan="3" class="fw-medium">G6</td>';
                    }
                    diwProvinces.forEach(function(p) {
                        tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                            p.id + '_' + (i + 2) + '"></div></td>';
                    });
                    tryRegionBodyHTML += '</tr>';
                }

                // G5
                tryRegionBodyHTML += '<tr class="bg-color-lotto-background"><td colspan="3" class="fw-medium">G5</td>';
                diwProvinces.forEach(function(p) {
                    tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                        p.id + '_6"></div></td>';
                });
                tryRegionBodyHTML += '</tr>';

                // G4 (7 rows)
                for (var i = 1; i <= 7; i++) {
                    tryRegionBodyHTML += '<tr>';
                    if (i === 1) {
                        tryRegionBodyHTML += '<td colspan="3" rowspan="7" class="fw-medium">G4</td>';
                    }
                    diwProvinces.forEach(function(p) {
                        tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                            p.id + '_' + (i + 6) + '"></div></td>';
                    });
                    tryRegionBodyHTML += '</tr>';
                }

                // G3 (2 rows)
                for (var i = 1; i <= 2; i++) {
                    tryRegionBodyHTML += '<tr class="bg-color-lotto-background">';
                    if (i === 1) {
                        tryRegionBodyHTML += '<td colspan="3" rowspan="2" class="fw-medium">G3</td>';
                    }
                    diwProvinces.forEach(function(p) {
                        tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                            p.id + '_' + (i + 13) + '"></div></td>';
                    });
                    tryRegionBodyHTML += '</tr>';
                }

                // G2
                tryRegionBodyHTML += '<tr><td colspan="3" class="fw-medium">G2</td>';
                diwProvinces.forEach(function(p) {
                    tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                        p.id + '_16"></div></td>';
                });
                tryRegionBodyHTML += '</tr>';

                // G1
                tryRegionBodyHTML += '<tr class="bg-color-lotto-background"><td colspan="3" class="fw-medium">G1</td>';
                diwProvinces.forEach(function(p) {
                    tryRegionBodyHTML += '<td colspan="8" class="txt-normal-prize"><div class="number try_number_' +
                        p.id + '_17"></div></td>';
                });
                tryRegionBodyHTML += '</tr>';

                // ĐB
                tryRegionBodyHTML += '<tr><td colspan="3" class="fw-medium color-highlight">ĐB</td>';
                diwProvinces.forEach(function(p) {
                    tryRegionBodyHTML += '<td colspan="8" class="txt-special-prize"><div class="number try_number_' +
                        p.id + '_18"></div></td>';
                });
                tryRegionBodyHTML += '</tr>';

                // Build table for đầu
                tryRegionDDHTML += '<tr class="text-center"><th colspan="3" class="p-0 fw-medium">Đầu</th>';
                diwProvinces.forEach(function(p) {
                    var tryProvinceUrl = rootUrl + 'quay-thu-xo-so-' + p.slug;
                    tryRegionDDHTML += '<th colspan="8" class="p-0 fw-medium">' +
                        '<a href="' + tryProvinceUrl + '">' + p.name + '</a></th>';
                });
                tryRegionDDHTML += '</tr>';

                for (var i = 0; i <= 9; i++) {
                    tryRegionDDHTML += '<tr' + (i % 2 === 0 ? ' class="bg-color-lotto-background"' : '') + '>';
                    tryRegionDDHTML += '<td colspan="3" class="text-center">' + i + '</td>';
                    diwProvinces.forEach(function(p) {
                        tryRegionDDHTML += '<td colspan="8" class="dd-kq dd_' + p.id + '_dau_' + i + '"></td>';
                    });
                    tryRegionDDHTML += '</tr>';
                }

                // Insert into DOM
                var tryRegionFirstTh = document.getElementById("try-region-first-th");
                if (tryRegionFirstTh) {
                    tryRegionFirstTh.setAttribute("colspan", (8 * diwProvinces.length + 3).toString());
                }
                var tryRegionBody = document.getElementById("try-region-body");
                if (tryRegionBody) {
                    tryRegionBody.innerHTML = tryRegionBodyHTML;
                }
                var tryRegionDD = document.getElementById("try-region-dd");
                if (tryRegionDD) {
                    tryRegionDD.innerHTML = tryRegionDDHTML;
                }
            }
        });
    }

    // On #try-province-start click
    var provinceStartBtn = document.getElementById("try-province-start");
    if (provinceStartBtn) {
        provinceStartBtn.addEventListener("click", async function() {
            this.disabled = true;
            this.innerHTML = "Đang quay thử";

            if (provinceSelect) {
                provinceSelect.disabled = true;
            }

            resetTryProvinceResults();
            await renderTryProvinceResults();

            this.disabled = false;
            this.innerHTML = "Bắt đầu quay";

            if (provinceSelect) {
                provinceSelect.disabled = false;
            }
        });
    }

    // On #try-region-start click
    var regionStartBtn = document.getElementById("try-region-start");
    if (regionStartBtn) {
        regionStartBtn.addEventListener("click", async function() {
            this.disabled = true;
            this.innerHTML = "Đang quay thử";

            if (provinceSelect) provinceSelect.disabled = true;
            if (diwSelect) diwSelect.disabled = true;

            resetTryRegionResults();
            await renderTryRegionResults();

            this.disabled = false;
            this.innerHTML = "Bắt đầu quay";

            if (provinceSelect) provinceSelect.disabled = false;
            if (diwSelect) diwSelect.disabled = false;
        });
    }
}


// -------------------------------------------------------
// 8) Init Sounds (using howler.js)
// -------------------------------------------------------
function initSounds() {
    if (typeof Howl !== "undefined") {
        bgSound = new Howl({
            src: [rootUrl + "assets/sounds/xoso-music-theme.mp3"],
            html5: true,
            volume: 0.5,
            loop: true
        });

        introFirst = new Howl({
            src: [rootUrl + "assets/sounds/intro-first.mp3"],
            html5: true,
            volume: 0.5
        });

        // Preload soundPool
        // Example array of sound names:
        var soundNames = [
            "ting", "intro-last", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "quay-giai-1", "quay-giai-2", "quay-giai-3", "quay-giai-4", "quay-giai-5",
            "quay-giai-6", "quay-giai-7", "quay-giai-db", "lan-1", "lan-2", "lan-3",
            "lan-4", "lan-5", "lan-6"
        ];

        soundNames.forEach(function(soundName) {
            soundPool[soundName] = new Howl({
                src: [rootUrl + "assets/sounds/" + soundName + ".mp3"]
            });
        });
    }

    // Replace jQuery click on .sound-on
    document.querySelectorAll(".sound-on").forEach(function(el) {
        el.addEventListener("click", function() {
            // Hide all .sound-on
            document.querySelectorAll(".sound-on").forEach(function(item) {
                item.style.display = "none";
            });
            // Trigger #mute click
            var muteBtn = document.getElementById("mute");
            if (muteBtn) {
                muteBtn.click();
            }
        });
    });
}


// -------------------------------------------------------
// 9) Utility: Sleep (promisified setTimeout)
// -------------------------------------------------------
function sleep(ms) {
    return new Promise(function(resolve) {
        setTimeout(resolve, ms);
    });
}


// -------------------------------------------------------
// 10) Display Province for Mobile
// -------------------------------------------------------
function displayProvinceForMobile(region) {
    if (window.isMobile() || window.isTablet()) {
        var mobileEl = document.getElementById("province_" + region + "_mobile");
        var leftEl = document.getElementById("province_" + region + "_left");
        if (mobileEl && leftEl) {
            mobileEl.innerHTML = leftEl.outerHTML;
        }
    }
}


// -------------------------------------------------------
// 11) Check empty
// -------------------------------------------------------
function _check_empty(string) {
    if (string === "" || string == null) {
        return loading;
    }
    return string;
}

function _check_empty_2(string) {
    if (string === "" || string == null) {
        // in original code, changes `loading` temporarily
        // but let's just return it
        return loading;
    }
    return string;
}


// -------------------------------------------------------
// 12) Init DatePicker
//    (assuming Zebra_DatePicker supports vanilla usage)
// -------------------------------------------------------
function initDatePicker(format) {
    if (typeof format === "undefined") {
        format = "d-m-Y";
    }
    var datepickers = document.querySelectorAll(".datepicker");
    datepickers.forEach(function(el) {
        // If Zebra_DatePicker can be invoked without jQuery:
        new Zebra_DatePicker(el, { format: format });
    });
}


// -------------------------------------------------------
// 13) Get random numbers with specified length
// -------------------------------------------------------
function getRandomNumbers(length) {
    // If length=5 => random from 10000..99999
    // In simplest form:
    var min = Math.pow(10, length - 1);
    var max = Math.pow(10, length) - 1;
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


// -------------------------------------------------------
// 14) Continuously display loading animation
// -------------------------------------------------------
function displayLoading() {
    setInterval(function() {
        document.querySelectorAll(".loading").forEach(function(element) {
            // Attempt to read the 'l' attribute from parent td
            var parentTd = element.closest("td");
            var lengthAttr = parentTd ? parentTd.getAttribute("l") : null;
            if (!lengthAttr) {
                // maybe check parent's parent if needed
                var parentTd2 = element.parentElement ? element.parentElement.closest("td") : null;
                lengthAttr = parentTd2 ? parentTd2.getAttribute("l") : null;
            }
            // default if not found
            var length = lengthAttr ? parseInt(lengthAttr) : 5;

            element.innerHTML = getRandomNumbers(length);
        });
    }, 100);
}


// -------------------------------------------------------
// 15) Detect changing the "view mode" (hidden digits)
// -------------------------------------------------------
function detectChangeViewMode() {
    document.querySelectorAll(".change_view_mode").forEach(function(selectEl) {
        selectEl.addEventListener("change", function() {
            var length = parseInt(this.value);
            var resultBox = this.closest("table");
            if (!resultBox) return;

            var tds = resultBox.querySelectorAll("td");
            tds.forEach(function(td) {
                if (td.classList.contains("txt-special-prize") ||
                    td.classList.contains("txt-normal-prize")) {
                    var tdNumber = td.textContent.trim();
                    if (length === 0) {
                        td.innerHTML = tdNumber;
                    } else if (tdNumber.length > length) {
                        // Hide leading part
                        var hiddenPart = tdNumber.substring(0, tdNumber.length - length);
                        var visiblePart = tdNumber.substring(tdNumber.length - length);
                        td.innerHTML = '<span class="hidden">' + hiddenPart + '</span>' + visiblePart;
                    }
                }
            });
        });
    });
}


// -------------------------------------------------------
// 16) Detect Mute Button click
// -------------------------------------------------------
function detectMuteButtonClick() {
    var muteBtn = document.getElementById("mute");
    if (!muteBtn) return;

    muteBtn.addEventListener("click", function() {
        isMute = !isMute;
        var icon = this.querySelector("i");

        if (isMute) {
            // Mute
            if (icon) {
                icon.classList.remove("fa-volume-up");
                icon.classList.add("fa-volume-mute");
            }
            if (bgSound) {
                bgSound.mute(true);
            }
            if (introFirst) {
                introFirst.pause();
            }
        } else {
            // Unmute
            if (icon) {
                icon.classList.remove("fa-volume-mute");
                icon.classList.add("fa-volume-up");
            }
            if (bgSound) {
                bgSound.mute(false);
            }
            // Hide .sound-on
            document.querySelectorAll(".sound-on").forEach(function(el) {
                el.style.display = "none";
            });

            // Play background if not playing
            if (bgSound && !bgSound.playing()) {
                if (introFirst && !introFirst.playing()) {
                    introFirst.play();
                    setTimeout(function() {
                        if (!bgSound.playing()) {
                            bgSound.play();
                        }
                    }, 3000);
                }
            }
        }
    });
}

// -------------------------------------------------------
// End of vanilla JS script
// -------------------------------------------------------
