@extends('layouts.app')

@section('content')
    <div class="row p-b-50 layout-margin mt-4">
        @include('partials.sidenav')

        <div class="col-md-8 col-lg-6 layout-padding">
            <div class="br-10 table-shadow overflow-hidden m-b-15 bg-white focus-box">
                <h2 class="bg-color-brand list-group-title fw-medium fs-6 mb-0 lh-base">
                    <i class="fas fa-search m-r-5"></i>
                    Dò vé số - Tra cứu kết quả xổ số
                </h2>
                <div class="padding-10">
                    <div class="row form-margin m-b-5">
                        <div class="col-sm-6 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn ngày cần xem</lable>
                            <div class="form-date position-relative">
                                <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" type="text" name="search_date" value="{{ now()->format('d-m-Y') }}" placeholder="Chọn ngày" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 239px;">Pick a date</button></span>
                            </div>
                        </div>
                        <div class="col-sm-6 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn tỉnh</lable>
                            <select class="form-select" name="province_id">
                                <option value="22">Hà Nội</option>
                                <option value="40">Bắc Ninh</option>
                                <option value="44">Thái Bình</option>
                                <option value="41">Hải Phòng</option>
                                <option value="42">Nam Định</option>
                                <option value="43">Quảng Ninh</option>
                                <option value="12">An Giang</option>
                                <option value="9">Bạc Liêu</option>
                                <option value="7">Bến Tre</option>
                                <option value="1">Bình Dương</option>
                                <option value="18">Bình Phước</option>
                                <option value="10">Bình Thuận</option>
                                <option value="15">Cà Mau</option>
                                <option value="5">Cần Thơ</option>
                                <option value="20">Đà Lạt</option>
                                <option value="4">Đồng Nai</option>
                                <option value="14">Đồng Tháp</option>
                                <option value="19">Hậu Giang</option>
                                <option value="13">Hồ Chí Minh</option>
                                <option value="17">Kiên Giang</option>
                                <option value="21">Long An</option>
                                <option value="6">Sóc Trăng</option>
                                <option value="11">Tây Ninh</option>
                                <option value="16">Tiền Giang</option>
                                <option value="3">Trà Vinh</option>
                                <option value="2">Vĩnh Long</option>
                                <option value="8">Vũng Tàu</option>
                                <option value="23">Bình Định</option>
                                <option value="25">Đà Nẵng</option>
                                <option value="24">Đắc Lắc</option>
                                <option value="26">Đắc Nông</option>
                                <option value="27">Gia Lai</option>
                                <option value="28">Khánh Hòa</option>
                                <option value="29">Kon Tum</option>
                                <option value="30">Ninh Thuận</option>
                                <option value="31">Phú Yên</option>
                                <option value="32">Quảng Bình</option>
                                <option value="33">Quảng Ngãi</option>
                                <option value="34">Quảng Nam</option>
                                <option value="35">Quảng Trị</option>
                                <option value="36">Huế</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-margin">
                        <div class="col-sm-6 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Nhập số cần xem</lable>
                            <input class="form-control" type="text" name="search_number" placeholder="Nhập số cần xem...">
                        </div>
                        <div class="col-sm-6 form-padding align-self-end">
                            <button class="btn text-white bg-btn w-100 text-nowrap" type="button" onclick="getSearchResult(this);">
                                Xem kết quả
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="results">
                <div class="bg-white br-10 table-shadow m-b-15">
                    <div class="result-board">
                        <table class="table-lotto br-8 overflow-hidden bg-white w-100 text-center">
                            <tbody>
                            <tr>
                                <th colspan="27">
                                    <a class="color-brand text-decoration-none fw-bold txt-title" href="/">
                                        Kết quả xổ số Hà Nội
                                    </a>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="27">
                                    <div class="result-not-found"><div>
                                            <div class="p-r-5 m-b-5">
                                                <img src="/assets/images/result-not-found.svg" alt="notfound">
                                            </div>
                                            <div class="color-secondary txt-sub-title fw-normal text-center">
                                                Click vào nút "Xem kết quả" để xem kết quả xổ số
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.sidebar')
    </div>
@endsection

@push('scripts')
    <script>
        function getSearchResult(button) {
            const formData = new URLSearchParams();
            formData.append('search_date', $('input[name="search_date"]').val());
            formData.append('province_id', $('select[name="province_id"]').val());
            formData.append('search_number', $('input[name="search_number"]').val() || '');

            $.ajax({
                url: 'https://caykeongot.com/proxy/?url=' + btoa('https://ketqua.vn/do-ve-so'),
                data: formData.toString(),
                type: "post",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: 'html',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                beforeSend: function() {
                    $(button).empty().html('<i class="fas fa-spinner load"></i> Loading');
                },
                success: function(data) {
                    $("#results").empty().html(data);
                    $(button).empty().html("Xem kết quả");
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                    $(button).empty().html("Xem kết quả");
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listeners to search buttons
            document.querySelectorAll('[onclick^="getSearchResult"]').forEach(button => {
                button.removeAttribute('onclick');
                button.addEventListener('click', function() {
                    getSearchResult(this);
                });
            });

            // Initialize click on the button
            getSearchResult(document.querySelector('[onclick^="getSearchResult"]'));
        });
    </script>
@endpush
