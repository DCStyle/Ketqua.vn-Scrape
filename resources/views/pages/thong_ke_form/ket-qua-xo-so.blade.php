<div class="row form-margin m-b-5">
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn tỉnh thành</lable>
        <select class="form-select" id="tkn_province_id">
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
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn khoảng ngày</lable>
        <input class="form-control daterangepick" value="01/01/2018 - {{ now()->format('d/m/Y') }}" id="tkn_date_range" placeholder="Chọn khoảng ngày">
        <p class="text text-danger mb-0" for="tkn_date_range"></p>
    </div>
</div>
<div class="row form-margin m-b-5">
    <div class="col form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Các bộ số cần thống kê</lable>
        <textarea class="form-control" rows="3" id="tkn_numbers" placeholder="Điền bộ số bạn muốn xem ngăn cách bằng dấu , hoặc cách (ví dụ: 01,02,03 hoặc 01 02 03)">00 01 02 03 04 05 06 07 08 09</textarea>
        <p class="text text-danger mb-0" for="tkn_numbers"></p>
    </div>
</div>
<div class="row form-margin">
    <div class="col-sm-6 form-padding align-self-center">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="0" name="tkn_type" checked="">
            <label class="form-check-label" for="inlineRadio1">Tất cả giải</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="1" name="tkn_type">
            <label class="form-check-label" for="inlineRadio2">Giải đặc biệt</label>
        </div>
    </div>
    <div class="col-sm-6 form-padding align-self-center">
        <button id="auto-click-button" class="btn text-white bg-btn w-100 text-nowrap line-clamp-1" onclick="TKN(this);">Xem kết quả</button>
    </div>
</div>
