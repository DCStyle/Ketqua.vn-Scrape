@extends('layouts.app')

@section('content')
    <div class="row p-b-50 layout-margin mt-4">
        <div class="col-md-8 col-lg-9 layout-padding">
            <div class="br-10 table-shadow overflow-hidden m-b-15 bg-white focus-box">
                <h2 class="bg-color-brand list-group-title fw-medium fs-6 mb-0 lh-base">
                    <i class="fas fa-book m-r-5"></i>
                    Sổ kết quả
                </h2>
                <div class="padding-10">
                    <div class="row form-margin">
                        <div class="col-sm col-md-6 col-lg-3 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày bắt đầu</lable>
                            <input class="form-control datepicker" name="from_date" type="text" value="{{ $fromDate }}" readonly="readonly" style="position: relative; inset: auto;">
                        </div>
                        <div class="col-sm col-md-6 col-lg-3 form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày kết thúc</lable>
                            <input class="form-control datepicker" name="to_date" type="text" value="{{ $toDate }}" readonly="readonly" style="position: relative; inset: auto;">
                        </div>
                        <div class="col-sm col-md-6 col-lg-3 form-padding">
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
                        <div class="col-sm col-md-6 col-lg-3 form-padding align-self-end">
                            <button id="get-result-book" class="btn text-white bg-btn w-100 text-nowrap line-clamp-1">
                                Xem kết quả
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white br-8 table-shadow overflow-hidden d-flex m-b-15">
                <a class="col weekdays color-content" href="/so-ket-qua-30-ngay">30 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
                <a class="col weekdays color-content" href="/so-ket-qua-60-ngay">60 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
                <a class="col weekdays color-content" href="/so-ket-qua-90-ngay">90 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
                <a class="col weekdays color-content" href="/so-ket-qua-100-ngay">100 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
                <a class="col weekdays color-content" href="/so-ket-qua-200-ngay">200 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
                <a class="col weekdays color-content" href="/so-ket-qua-300-ngay">300 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
                <a class="col weekdays color-content" href="/so-ket-qua-500-ngay">500 <span class="show-on-web">ngày</span><span class="show-on-mobile">N</span></a>
            </div>

            <div id="results"></div>
        </div>

        @include('partials.sidebar')
    </div>
@endsection

@push('scripts')
    <script>
        // Define function globally
        function getResultBook(button) {
            const fromDate = document.querySelector('input[name="from_date"]').value;
            const toDate = document.querySelector('input[name="to_date"]').value;
            const provinceId = document.querySelector('select[name="province_id"]').value;

            if (!fromDate || !toDate || !provinceId) {
                console.error('Missing required fields');
                return;
            }

            const formData = new URLSearchParams();
            formData.append('range', fromDate.replaceAll("-", "/") + " - " + toDate.replaceAll("-", "/"));
            formData.append('province_id', provinceId);

            $.ajax({
                url: 'https://caykeongot.com/proxy/?url=' + btoa('https://xskt.net/so-ket-qua'),
                data: formData.toString(),
                type: "post",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: 'html',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                beforeSend: function() {
                    button.innerHTML = '<i class="fas fa-spinner load"></i> Loading';
                },
                success: function(data) {
                    document.getElementById('results').innerHTML = data;
                    button.innerHTML = "Xem kết quả";
                },
                error: function(xhr, status, error) {
                    console.error('Search error:', error);
                    button.innerHTML = "Xem kết quả";
                    document.getElementById('results').innerHTML = '<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại</div>';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add click event listener
            document.getElementById('get-result-book').addEventListener('click', function() {
                getResultBook(this);
            });

            // Auto click the button
            document.getElementById('get-result-book').click();
        });
    </script>
@endpush
