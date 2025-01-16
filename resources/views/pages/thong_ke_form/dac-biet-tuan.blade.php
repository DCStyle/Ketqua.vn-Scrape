<div class="row form-margin m-b-5">
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày bắt đầu</lable>
        <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" name="bdbt_from_date" id="bdbt_from_date" type="text" value="17-12-2024" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
    </div>
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Ngày kết thúc</lable>
        <span class="Zebra_DatePicker_Icon_Wrapper" style="display: block; position: relative; float: none; inset: auto;"><input class="form-control datepicker" name="bdbt_to_date" id="bdbt_to_date" type="text" value="{{ now()->format('d-m-Y') }}" readonly="readonly" style="position: relative; inset: auto;"><button type="button" class="Zebra_DatePicker_Icon Zebra_DatePicker_Icon_Inside" style="top: 11px; left: 380.5px;">Pick a date</button></span>
    </div>
</div>
<div class="row form-margin m-b-10">
    <div class="col form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Kiểu xem</lable>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="bdbt_type" value="0" type="radio" checked="">
            <label class="form-check-label">Đầy đủ</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="bdbt_type" value="1" type="radio">
            <label class="form-check-label">Hai số cuối</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="bdbt_type" value="2" type="radio">
            <label class="form-check-label">Theo đầu</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="bdbt_type" value="3" type="radio">
            <label class="form-check-label">Theo đuôi</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" name="bdbt_type" value="4" type="radio">
            <label class="form-check-label">Theo tổng</label>
        </div>
    </div>
</div>
<div class="row form-margin justify-content-end">
    <div class="col-sm-auto form-padding">
        <button id="auto-click-button" class="btn text-white bg-btn text-nowrap w-100 ps-5 pe-5" onclick="BDBT(this);">Xem kết quả</button>
    </div>
</div>
