@extends('layouts.app')

@section('content')
    <div class="row p-b-50 layout-margin mt-4">
        <div class="col-md-8 col-lg-9 layout-padding">
            <div class="br-10 table-shadow overflow-hidden m-b-15 bg-white focus-box">
                <h2 class="bg-color-brand list-group-title fw-medium fs-6 mb-0 lh-base">
                    Soi cầu {{ $typeName }}
                </h2>
                <div class="padding-10">
                    <div class="row form-margin m-b-5">
                        <div class="col-sm-6 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Biên ngày cầu chạy</lable>
                            <div class="form-date position-relative">
                                <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" id="sc_end_date" type="text" value="{{ now()->format('d-m-Y') }}" placeholder="Chọn ngày" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
                            </div>
                        </div>
                        <div class="col-sm-6 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Số ngày cầu chạy</lable>
                            <div class="position-relative form-soicau">
                                <input class="form-control text-center" id="sc_date_range" type="text" value="3" placeholder="Số ngày cầu chạy">
                                <button class="btn position-absolute plus bd-1" onclick="incrementDateRange('#sc_date_range')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn position-absolute minus bd-1" onclick="decrementDateRange('#sc_date_range')">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="date-soicau position-absolute">ngày</div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-margin">
                        @if($isTriangle)
                            <div class="col-sm-6 form-padding">
                                <lable class="fw-medium txt-sub-content d-block m-b-5">Xem theo giải</lable>
                                <select id="sc_giai" class="form-control">
                                    <option value="00">G00 - Giải đặc biệt</option>
                                    <option value="11">G11 - Giải nhất</option>
                                    <option value="21">G21 - Giải nhì thứ 1</option>
                                    <option value="22">G22 - Giải nhì thứ 2</option>
                                    <option value="31">G31 - Giải ba thứ 1</option>
                                    <option value="32">G32 - Giải ba thứ 2</option>
                                    <option value="33">G33 - Giải ba thứ 3</option>
                                    <option value="34">G34 - Giải ba thứ 4</option>
                                    <option value="35">G35 - Giải ba thứ 5</option>
                                    <option value="36">G36 - Giải ba thứ 6</option>
                                    <option value="41">G41 - Giải tư thứ 1</option>
                                    <option value="42">G42 - Giải tư thứ 2</option>
                                    <option value="43">G43 - Giải tư thứ 3</option>
                                    <option value="44">G44 - Giải tư thứ 4</option>
                                    <option value="51">G51 - Giải năm thứ 1</option>
                                    <option value="52">G52 - Giải năm thứ 2</option>
                                    <option value="53">G53 - Giải năm thứ 3</option>
                                    <option value="54">G54 - Giải năm thứ 4</option>
                                    <option value="55">G55 - Giải năm thứ 5</option>
                                    <option value="56">G56 - Giải năm thứ 6</option>
                                    <option value="61">G61 - Giải sáu thứ 1</option>
                                    <option value="62">G62 - Giải sáu thứ 2</option>
                                    <option value="63">G63 - Giải sáu thứ 3</option>
                                    <option value="71">G71 - Giải bẩy thứ 1</option>
                                    <option value="72">G72 - Giải bẩy thứ 2</option>
                                    <option value="73">G73 - Giải bẩy thứ 3</option>
                                    <option value="74">G74 - Giải bẩy thứ 4</option>
                                </select>
                            </div>
                        @else
                            <div class="col-sm-6 form-padding">
                                <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn tỉnh</lable>
                                <select class="form-select" name="search-province" id="sc_province">
                                    <optgroup label="Miền Bắc">
                                        <option value="22">- Hà Nội</option>
                                        <option value="40">- Bắc Ninh</option>
                                        <option value="44">- Thái Bình</option>
                                        <option value="41">- Hải Phòng</option>
                                        <option value="42">- Nam Định</option>
                                        <option value="43">- Quảng Ninh</option>
                                    </optgroup>
                                    <optgroup label="Miền Trung">
                                        <option value="23">- Bình Định</option>
                                        <option value="25">- Đà Nẵng</option>
                                        <option value="24">- Đắc Lắc</option>
                                        <option value="26">- Đắc Nông</option>
                                        <option value="27">- Gia Lai</option>
                                        <option value="28">- Khánh Hòa</option>
                                        <option value="29">- Kon Tum</option>
                                        <option value="30">- Ninh Thuận</option>
                                        <option value="31">- Phú Yên</option>
                                        <option value="32">- Quảng Bình</option>
                                        <option value="33">- Quảng Ngãi</option>
                                        <option value="34">- Quảng Nam</option>
                                        <option value="35">- Quảng Trị</option>
                                        <option value="36">- Huế</option>
                                    </optgroup>
                                    <optgroup label="Miền Nam">
                                        <option value="12">- An Giang</option>
                                        <option value="9">- Bạc Liêu</option>
                                        <option value="7">- Bến Tre</option>
                                        <option value="1">- Bình Dương</option>
                                        <option value="18">- Bình Phước</option>
                                        <option value="10">- Bình Thuận</option>
                                        <option value="15">- Cà Mau</option>
                                        <option value="5">- Cần Thơ</option>
                                        <option value="20">- Đà Lạt</option>
                                        <option value="4">- Đồng Nai</option>
                                        <option value="14">- Đồng Tháp</option>
                                        <option value="19">- Hậu Giang</option>
                                        <option value="13">- Hồ Chí Minh</option>
                                        <option value="17">- Kiên Giang</option>
                                        <option value="21">- Long An</option>
                                        <option value="6">- Sóc Trăng</option>
                                        <option value="11">- Tây Ninh</option>
                                        <option value="16">- Tiền Giang</option>
                                        <option value="3">- Trà Vinh</option>
                                        <option value="2">- Vĩnh Long</option>
                                        <option value="8">- Vũng Tàu</option>
                                    </optgroup>
                                </select>
                            </div>
                        @endif

                        @if($isByWeekDays)
                            <div class="col-sm-6 form-padding">
                                <lable class="fw-medium txt-sub-content d-block m-b-5">Thứ trong tuần</lable>
                                <select id="sc_diw" class="form-select">
                                    <option value="0">Thứ 2</option>
                                    <option value="1">Thứ 3</option>
                                    <option value="2">Thứ 4</option>
                                    <option value="3">Thứ 5</option>
                                    <option value="4">Thứ 6</option>
                                    <option value="5">Thứ 7</option>
                                    <option value="6">Chủ nhật</option>
                                </select>
                            </div>
                        @endif
                    </div>

                    <div class="row form-margin justify-content-end">
                        @if($isSpecial)
                            <div class="col-sm-6 form-padding align-self-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sc_check">
                                    <label class="form-check-label">
                                        Gần giải đặc biệt hơn
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="col-sm-6 form-padding align-self-end">
                            @isset($getSoiCauFunction)
                                <button
                                    id="auto-click-button"
                                    class="btn text-white bg-btn w-100 text-nowrap"
                                    onclick="{{ $getSoiCauFunction }}">
                                    Xem kết quả
                                </button>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>

            <div id="sc_result"></div>
        </div>

        @include('partials.sidebar')
    </div>
@endsection

@push('scripts')
    <script>
        function getSoiCauLoto(e, type) {
            const range = document.getElementById('sc_date_range').value;
            const endDate = document.getElementById('sc_end_date').value;
            const province = document.getElementById('sc_province').value;
            const diwElement = document.getElementById('sc_diw');
            const diw = diwElement ? diwElement.value : '';
            const button = e;

            let baseUrl = 'https://xskt.net/';
            let path = '';

            switch (type) {
                case 1: path = 'soi-cau/loto'; break;
                case 2: path = 'soi-cau/an-hai-nhay'; break;
                case 3: path = 'soi-cau/bach-thu'; break;
                case 4: path = 'soi-cau/loai-loto'; break;
                case 5: path = 'soi-cau/loai-loto-bach-thu'; break;
                case 6: path = 'soi-cau/loto-theo-thu'; break;
                case 7: path = 'soi-cau/loto-bach-thu-theo-thu'; break;
                default: path = 'soi-cau/loto';
            }

            let valid = true;

            if (!endDate) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Hãy chọn biên ngày cầu chạy.';
                alert('Hãy chọn biên ngày cầu chạy.');
                valid = false;
            } else if (!/^\d{2}-\d{2}-\d{4}$/.test(endDate)) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Biên ngày không đúng định dạng.';
                alert('Biên ngày không đúng định dạng.');
                valid = false;
            }

            if (!range) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy.';
                alert('Hãy nhập số ngày cầu chạy.');
                valid = false;
            } else if (isNaN(range)) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy là số.';
                alert('Hãy nhập số ngày cầu chạy là số.');
                valid = false;
            }

            if (valid) {
                const encodedUrl = btoa(baseUrl + path);
                const proxyUrl = `https://caykeongot.com/proxy/?url=${encodedUrl}`;

                const formData = new URLSearchParams();
                formData.append('date_range', range);
                formData.append('end_date', endDate);
                formData.append('province', province);
                formData.append('diw', diw);

                fetch(proxyUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData.toString()
                }).then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                }).then(data => {
                    button.innerHTML = 'Xem kết quả';
                    document.getElementById('sc_result').innerHTML = data;
                }).catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = 'Xem kết quả';
                });

                const resultDiv = document.getElementById('sc_result');
                resultDiv.innerHTML = '';
                button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
            }
        }

        function getSoiCauDB(e) {
            const range = document.getElementById('sc_date_range').value;
            const endDate = document.getElementById('sc_end_date').value;
            const province = document.getElementById('sc_province').value;
            const isCheck = document.getElementById('sc_check').checked ? 1 : 0;
            const button = e;

            let valid = true;

            if (!endDate) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Hãy chọn biên ngày cầu chạy.';
                alert('Hãy chọn biên ngày cầu chạy.');
                valid = false;
            } else if (!/^\d{2}-\d{2}-\d{4}$/.test(endDate)) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Biên ngày không đúng định dạng.';
                alert('Biên ngày không đúng định dạng.');
                valid = false;
            }

            if (!range) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy.';
                alert('Hãy nhập số ngày cầu chạy.');
                valid = false;
            } else if (isNaN(range)) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy là số.';
                alert('Hãy nhập số ngày cầu chạy là số.');
                valid = false;
            }

            if (valid) {
                const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://xskt.net/soi-cau/giai-dac-biet');
                const formData = new URLSearchParams();
                formData.append('date_range', range);
                formData.append('end_date', endDate);
                formData.append('province', province);
                formData.append('is_check', isCheck);

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
                    document.getElementById('sc_result').innerHTML = data;
                }).catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = 'Xem kết quả';
                });

                const resultDiv = document.getElementById('sc_result');
                resultDiv.innerHTML = '';
                button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
            }
        }

        function getSoiCauDBT(e) {
            const range = document.getElementById('sc_date_range').value;
            const endDate = document.getElementById('sc_end_date').value;
            const province = document.getElementById('sc_province').value;
            const isCheck = document.getElementById('sc_check').checked ? 1 : 0;
            const diw = document.getElementById('sc_diw').value;
            const button = e;

            let valid = true;

            if (!endDate) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Hãy chọn biên ngày cầu chạy.';
                alert('Hãy chọn biên ngày cầu chạy.');
                valid = false;
            } else if (!/^\d{2}-\d{2}-\d{4}$/.test(endDate)) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Biên ngày không đúng định dạng.';
                alert('Biên ngày không đúng định dạng.');
                valid = false;
            }

            if (!range) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy.';
                alert('Hãy nhập số ngày cầu chạy.');
                valid = false;
            } else if (isNaN(range)) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy là số.';
                alert('Hãy nhập số ngày cầu chạy là số.');
                valid = false;
            }

            if (valid) {
                const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://xskt.net/soi-cau/giai-dac-biet-theo-thu');
                const formData = new URLSearchParams();
                formData.append('province', province);
                formData.append('date_range', range);
                formData.append('end_date', endDate);
                formData.append('diw', diw);
                formData.append('is_check', isCheck);

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
                    document.getElementById('sc_result').innerHTML = data;
                }).catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = 'Xem kết quả';
                });

                const resultDiv = document.getElementById('sc_result');
                resultDiv.innerHTML = '';
                button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
            }
        }

        function getCauTamGiac(e) {
            const endDate = document.getElementById('sc_end_date').value;
            const dateRange = document.getElementById('sc_date_range').value;
            const giai = document.getElementById('sc_giai').value;
            const button = e;
            const endDateRegex = /^\d{2}-\d{2}-\d{4}$/;

            let valid = true;

            if (!endDate) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Hãy chọn biên ngày cầu chạy.';
                valid = false;
            } else if (!endDateRegex.test(endDate)) {
                document.querySelector('p[for=sc_end_date]').textContent = 'Biên ngày cầu chạy không đúng định dạng.';
                valid = false;
            }

            if (!dateRange) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Hãy nhập số ngày cầu chạy.';
                valid = false;
            } else if (isNaN(dateRange)) {
                document.querySelector('p[for=sc_date_range]').textContent = 'Số ngày cầu chạy phải là số.';
                valid = false;
            }

            if (valid) {
                const targetUrl = 'https://caykeongot.com/proxy/?url=' + btoa('https://xskt.net/soi-cau/tam-giac');
                const formData = new URLSearchParams();
                formData.append('end_date', endDate);
                formData.append('date_range', dateRange);
                formData.append('giai', giai);

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
                    document.getElementById('sc_result').innerHTML = data;
                }).catch(error => {
                    console.error('Error:', error);
                    button.innerHTML = 'Xem kết quả';
                });

                const resultDiv = document.getElementById('sc_result');
                resultDiv.innerHTML = '';
                button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
            }

            return false;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('auto-click-button').click();
        });
    </script>
@endpush
