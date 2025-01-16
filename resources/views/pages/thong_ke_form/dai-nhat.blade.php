<div class="row form-margin m-b-5">
    <div class="col-sm col-md-6 col-lg-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày bắt đầu</lable>
        <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" id="tkdn_from_date" type="text" value="17-12-2024" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
    </div>
    <div class="col-sm col-md-6 col-lg-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày kết thúc</lable>
        <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" id="tkdn_to_date" type="text" value="{{ now()->format('d-m-Y') }}" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
    </div>
</div>
<div class="row form-margin m-b-5">
    <div class="col form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Các bộ số cần thống kê</lable>
        <textarea class="form-control" rows="3" id="tkdn_numbers" placeholder="Điền bộ số bạn muốn xem ngăn cách bằng dấu , hoặc cách (ví dụ: 01,02,03 hoặc 01 02 03)">00 01 02 03 04 05 06 07 08 09</textarea>
        <p class="text text-danger mb-0" for="tkdn_numbers"></p>
    </div>
</div>
<div class="row form-margin justify-content-end">
    <div class="col-sm-auto form-padding">
        <button id="auto-click-button" class="btn text-white bg-btn w-100 text-nowrap ps-5 pe-5" onclick="TKDN(this);">Xem kết quả</button>
    </div>
</div>
