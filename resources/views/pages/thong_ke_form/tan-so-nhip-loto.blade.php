<div class="row form-margin m-b-5">
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày bắt đầu</lable>
        <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" id="tsnlt_from_date" type="text" value="17-12-2024" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
    </div>
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày kết thúc</lable>
        <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" id="tsnlt_to_date" type="text" value="{{ now()->format('d-m-Y') }}" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
    </div>
</div>
<div class="row form-margin m-b-5">
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Cặp số khảo sát</lable>
        <input class="form-control" type="text" value="00" id="tsnlt_number" placeholder="Nhập cặp số khảo sát">
        <p for="tsnlt_number" class="text text-danger mb-0"></p>
    </div>
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn thứ</lable>
        <select class="form-select" id="tsnlt_diw">
            <option selected="" value="0">Tất cả các thứ</option>
            <option value="2">Thứ hai</option>
            <option value="3">Thứ ba</option>
            <option value="4">Thứ tư</option>
            <option value="5">Thứ năm</option>
            <option value="6">Thứ sáu</option>
            <option value="7">Thứ bảy</option>
            <option value="8">Chủ nhật</option>
        </select>
    </div>
</div>
<div class="row form-margin justify-content-end">
    <div class="col-sm-auto form-padding">
        <button id="auto-click-button" class="btn text-white bg-btn w-100 text-nowrap ps-5 pe-5" onclick="TSNLT(this);">Xem kết quả</button>
    </div>
</div>
