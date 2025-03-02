function TKLTG(e) {
    const range = document.getElementById('tkltg_range').value;
    const provinceId = document.getElementById('tkltg_province_id').value;
    const button = e;

    document.querySelector('p[for=tkltg_range]').textContent = '';
    let valid = true;

    if (!range) {
        document.querySelector('p[for=tkltg_range]').textContent = 'Hãy nhập biên độ gan!';
        document.getElementById('tkltg_range').focus();
        valid = false;
    } else if (!/^(\d{2}|\d{1}){1}$/.test(range)) {
        document.querySelector('p[for=tkltg_range]').textContent = 'Vui lòng chỉ nhập số!';
        valid = false;
    }

    if (valid) {
        const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/loto-gan');
        const formData = new URLSearchParams();
        formData.append('province', provinceId);
        formData.append('range', range);

        fetch(targetUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        }).then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        }).then(data => {
            button.innerHTML = 'Xem kết quả';
            document.getElementById('tk_result').innerHTML = data;
        }).catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Xem kết quả';
        });

        document.getElementById('tk_result').innerHTML = '';
        button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
    }
}

function TKCKDLT(e) {
    const numbers = document.getElementById('tkckdlt_numbers').value;
    const dateRange = document.getElementById('tkckdlt_date_range').value;
    const provinceId = document.getElementById('tkckdlt_province_id').value;
    const button = e;

    document.querySelector('p[for=tkckdlt_numbers]').textContent = '';
    document.querySelector('p[for=tkckdlt_date_range]').textContent = '';
    let valid = true;

    if (!numbers) {
        document.querySelector('p[for=tkckdlt_numbers]').textContent = 'Hãy nhập dãy số cần thống kê!';
        document.querySelector('p[for=tkckdlt_numbers]').focus();
        valid = false;
    } else if (!/^\d{2}((,|.|:|;|\/|\s|-)\d{2})*$/.test(numbers)) {
        document.querySelector('p[for=tkckdlt_numbers]').textContent = 'Hãy nhập đúng định dạng!';
        valid = false;
    }

    if (!dateRange) {
        document.querySelector('p[for=tkckdlt_date_range]').textContent = 'Hãy chọn khoảng ngày cần xem!';
        valid = false;
    }

    if (valid) {
        const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/chu-ky-dan-loto');
        const formData = new URLSearchParams();
        formData.append('range', dateRange);
        formData.append('numbers', numbers);
        formData.append('province', provinceId);
        formData.append('is_check', document.getElementById('tkckdlt_is_check').checked ? 1 : 0);

        fetch(targetUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        }).then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        }).then(data => {
            button.innerHTML = 'Xem kết quả';
            document.getElementById('tk_result').innerHTML = data;
        }).catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Xem kết quả';
        });

        document.getElementById('tk_result').innerHTML = '';
        button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
    }
}

function TKN(e) {
    const numbers = document.getElementById('tkn_numbers').value;
    const dateRange = document.getElementById('tkn_date_range').value;
    const provinceId = document.getElementById('tkn_province_id').value;
    const button = e;

    document.querySelector('p[for=tkn_date_range]').textContent = '';
    document.querySelector('p[for=tkn_numbers]').textContent = '';
    let valid = true;

    if (!numbers) {
        document.querySelector('p[for=tkn_numbers]').textContent = 'Hãy nhập các số cần thống kê!';
        document.getElementById('tkn_numbers').focus();
        valid = false;
    } else if (!/^\d{2}((,|.|:|;|\/|\s|-)\d{2})*$/.test(numbers)) {
        document.querySelector('p[for=tkn_numbers]').textContent = 'Hãy nhập đúng định dạng!';
        valid = false;
    }

    if (!dateRange) {
        document.querySelector('p[for=tkn_date_range]').textContent = 'Hãy chọn khoảng ngày cần thống kê!';
        valid = false;
    }

    if (valid) {
        const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/ket-qua-xo-so');
        const formData = new URLSearchParams();
        formData.append('numbers', numbers);
        formData.append('province', provinceId);
        formData.append('type', document.querySelector('input[name=tkn_type]:checked').value);
        formData.append('date_range', dateRange);

        fetch(targetUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        }).then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        }).then(data => {
            button.innerHTML = 'Xem kết quả';
            document.getElementById('tk_result').innerHTML = data;
        }).catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Xem kết quả';
        });

        document.getElementById('tk_result').innerHTML = '';
        button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
    }
}

function TKDDLT(e) {
    const dateRange = document.getElementById('tkddlt_date_range').value;
    const provinceId = document.getElementById('tkddlt_province_id').value;
    const button = e;

    document.querySelector('p[for=tkddlt_date_range]').textContent = '';

    if (!dateRange) {
        document.querySelector('p[for=tkddlt_date_range]').textContent = 'Hãy chọn khoảng ngày cần xem.';
        return false;
    }

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/dau-duoi-loto');
    const formData = new URLSearchParams();
    formData.append('date_range', dateRange);
    formData.append('province', provinceId);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function TKCKDDB(e) {
    const numbers = document.getElementById('tkckddb_numbers').value;
    const dateRange = document.getElementById('tkckddb_date_range').value;
    const provinceId = document.getElementById('tkckddb_province_id').value;
    const button = e;

    document.querySelector('p[for=tkckddb_numbers]').textContent = '';
    document.querySelector('p[for=tkckddb_date_range]').textContent = '';
    let valid = true;

    if (!numbers) {
        document.querySelector('p[for=tkckddb_numbers]').textContent = 'Hãy nhập dãy số cần thống kê!';
        document.getElementById('tkckddb_numbers').focus();
        valid = false;
    } else if (!/^\d{2}((,|.|:|;|\/|\s|-)\d{2})*$/.test(numbers)) {
        document.querySelector('p[for=tkckddb_numbers]').textContent = 'Hãy nhập đúng định dạng!';
        valid = false;
    }

    if (!dateRange) {
        document.querySelector('p[for=tkckddb_date_range]').textContent = 'Hãy chọn khoảng ngày cần xem!';
        valid = false;
    }

    if (valid) {
        const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/chu-ky-dan-dac-biet');
        const formData = new URLSearchParams();
        formData.append('range', dateRange);
        formData.append('numbers', numbers);
        formData.append('province', provinceId);

        fetch(targetUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        }).then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        }).then(data => {
            button.innerHTML = 'Xem kết quả';
            document.getElementById('tk_result').innerHTML = data;
        }).catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Xem kết quả';
        });

        document.getElementById('tk_result').innerHTML = '';
        button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
    }
}

function TKTSLT(e) {
    const dateRange = document.getElementById('tktslt_date_range').value;
    const provinceId = document.getElementById('tktslt_province').value;
    const button = e;

    document.querySelector('p[for=tktslt_date_range]').textContent = '';
    document.querySelector('p[for=check_numbers]').textContent = '';
    let valid = true;

    if (!dateRange) {
        document.querySelector('p[for=tktslt_date_range]').textContent = 'Hãy chọn khoảng ngày muốn xem!';
        valid = false;
    }

    const checkNumbers = Array.from(document.querySelectorAll('#check_numbers span.checked'))
        .map(span => span.textContent);

    if (checkNumbers.length === 0) {
        document.querySelector('p[for=check_numbers]').textContent = 'Hãy chọn ít nhất một số để thống kê!';
        valid = false;
    }

    if (valid) {
        const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/tan-suat-loto');
        const formData = new URLSearchParams();
        formData.append('province', provinceId);
        formData.append('date_range', dateRange);
        formData.append('check_numbers', checkNumbers.join(','));

        fetch(targetUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        }).then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        }).then(data => {
            button.innerHTML = 'Xem kết quả';
            document.getElementById('tk_result').innerHTML = data;
        }).catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Xem kết quả';
        });

        document.getElementById('tk_result').innerHTML = '';
        button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
    }
}

function TC(e) {
    const number = document.getElementById('tc_number').value;
    const button = e;

    document.querySelector('p[for=tc_number]').textContent = '';

    if (!number) {
        document.querySelector('p[for=tc_number]').textContent = 'Nhập càng cần soi.';
        return;
    }

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/cang-loto');
    const formData = new URLSearchParams();
    formData.append('number', number);
    formData.append('date_range', document.getElementById('tc_date_range').value);
    formData.append('kieu_soi', document.querySelector('input[name=kieu_soi]:checked').value);
    formData.append('vi_tri', document.querySelector('input[name=vi_tri]:checked').value);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function TKTT(e) {
    const dateRange = document.getElementById('tktt_date_range').value;
    const provinceId = document.getElementById('tktt_province').value;
    const button = e;

    document.querySelector('p[for=tktt_date_range]').textContent = '';

    if (!dateRange) {
        document.querySelector('p[for=tktt_date_range]').textContent = 'Hãy chọn khoảng ngày cần xem.';
        return false;
    }

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/theo-tong');
    const formData = new URLSearchParams();
    formData.append('sum', document.getElementById('tktt_sum').value);
    formData.append('province_id', provinceId);
    formData.append('date_range', dateRange);
    formData.append('type', document.querySelector('input[name=tktt_type]:checked').value);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function TKQT(e) {
    const type = document.getElementById('tkqt_type').value;
    const provinceId = document.getElementById('tkqt_province_id').value;
    const button = e;

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/quan-trong');
    const formData = new URLSearchParams();
    formData.append('province_id', provinceId);
    formData.append('type', type);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function BDBT(e) {
    const fromDate = document.getElementById('bdbt_from_date').value;
    const toDate = document.getElementById('bdbt_to_date').value;
    const type = document.querySelector('input[name="bdbt_type"]:checked').value;
    const button = e;

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/dac-biet-tuan');
    const formData = new URLSearchParams();
    formData.append('from_date', fromDate);
    formData.append('to_date', toDate);
    formData.append('type', type);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function TKDN(e) {
    const numbers = document.getElementById('tkdn_numbers').value;
    const fromDate = document.getElementById('tkdn_from_date').value;
    const toDate = document.getElementById('tkdn_to_date').value;
    const button = e;

    document.querySelector('p[for=tkck_numbers]').textContent = '';

    if (!numbers) {
        document.querySelector('p[for=tkdn_numbers]').textContent = 'Hãy nhập bộ số cần xem.';
        document.getElementById('tkdn_numbers').focus();
        return false;
    }

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/dai-nhat');
    const formData = new URLSearchParams();
    formData.append('numbers', numbers);
    formData.append('from_date', fromDate);
    formData.append('to_date', toDate);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function TSNLT(e) {
    const number = document.getElementById('tsnlt_number').value;
    const fromDate = document.getElementById('tsnlt_from_date').value;
    const toDate = document.getElementById('tsnlt_to_date').value;
    const button = e;
    let valid = true;

    document.querySelector('p[for=tsnlt_number]').textContent = '';

    if (!number) {
        document.querySelector('p[for=tsnlt_number]').textContent = 'Hãy nhập bộ số cần khảo sát.';
        document.getElementById('tsnlt_number').focus();
        valid = false;
    } else if (!/^(\d{2}|\d{1}){1}$/.test(number)) {
        document.querySelector('p[for=tsnlt_number]').textContent = 'Hãy nhập số có 2 chữ số.';
        document.getElementById('tsnlt_number').focus();
        valid = false;
    }

    if (valid) {
        const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/tan-so-nhip-loto');
        const formData = new URLSearchParams();
        formData.append('number', number);
        formData.append('from_date', fromDate);
        formData.append('to_date', toDate);
        formData.append('diw', document.getElementById('tsnlt_diw').value);

        fetch(targetUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: formData.toString()
        }).then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        }).then(data => {
            button.innerHTML = 'Xem kết quả';
            document.getElementById('tk_result').innerHTML = data;
        }).catch(error => {
            console.error('Error:', error);
            button.innerHTML = 'Xem kết quả';
        });

        document.getElementById('tk_result').innerHTML = '';
        button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
    }
}

function BDBTH(e) {
    const year = document.getElementById('bdbt_year').value;
    const button = e;

    const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/thong-ke/dac-biet-thang');
    const formData = new URLSearchParams();
    formData.append('year', year);

    fetch(targetUrl, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    }).then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    }).then(data => {
        button.innerHTML = 'Xem kết quả';
        document.getElementById('tk_result').innerHTML = data;
    }).catch(error => {
        console.error('Error:', error);
        button.innerHTML = 'Xem kết quả';
    });

    document.getElementById('tk_result').innerHTML = '';
    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
}

function qSelectNumbers(e, type) {
    const spans = document.querySelectorAll('#check_numbers span');

    switch(type) {
        case 'a': // Select all
            spans.forEach(span => span.classList.add('checked'));
            break;

        case 'u': // Unselect all
            spans.forEach(span => span.classList.remove('checked'));
            break;

        case 'c': // Select even numbers
            spans.forEach(span => {
                let text = span.textContent;
                if (isNaN(text)) {
                    text = text.replace('Đuôi', '');
                    if (!isNaN(text) && parseInt(text) % 2 === 0) {
                        span.classList.add('checked');
                    }
                } else if (parseInt(text) % 2 === 0) {
                    span.classList.add('checked');
                }
            });
            break;

        case 'l': // Select odd numbers
            spans.forEach(span => {
                let text = span.textContent;
                if (isNaN(text)) {
                    text = text.replace('Đuôi', '');
                    if (!isNaN(text) && parseInt(text) % 2 !== 0) {
                        span.classList.add('checked');
                    }
                } else if (parseInt(text) % 2 !== 0) {
                    span.classList.add('checked');
                }
            });
            break;

        default:
            if (type.startsWith('h')) { // Select by first digit
                const digit = type.charAt(1);
                spans.forEach(span => {
                    const text = span.textContent;
                    if (!isNaN(text) && text.charAt(0) === digit) {
                        span.classList.add('checked');
                    }
                });
            } else if (type.startsWith('t')) { // Select by second digit
                const digit = type.charAt(1);
                spans.forEach(span => {
                    const text = span.textContent;
                    if (!isNaN(text) && text.charAt(1) === digit) {
                        span.classList.add('checked');
                    }
                });
            }
    }
}
