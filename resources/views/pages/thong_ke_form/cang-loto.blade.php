<div class="row form-margin m-b-5">
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Chọn khoảng ngày</lable>
        <input class="form-control daterangepick" id="tc_date_range" name="range" type="text" value="01/01/2017 - {{ now()->format('d/m/Y') }}" placeholder="Chọn khoảng ngày">
        <p class="text text-danger mb-0" for="tc_date_range"></p>
    </div>
    <div class="col-sm-6 form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Nhập càng muốn soi</lable>
        <input class="form-control" id="tc_number" value="333" placeholder="Nhập càng (3 số)">
        <p class="text text-danger mb-0" for="tc_number"></p>
    </div>
</div>
<div class="row form-margin m-b-5">
    <div class="col form-padding">
        <lable class="fw-medium txt-sub-content d-block m-b-5">Kiểu soi</lable>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="kieu_soi" id="kieu_soi1" value="1" checked="">
            <label class="form-check-label fw-medium" for="kieu_soi1">Càng sau</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="kieu_soi" id="kieu_soi2" value="2">
            <label class="form-check-label fw-medium" for="kieu_soi2">Càng dưới</label>
        </div>
    </div>
</div>
<div class="row form-margin m-b-10">
    <div class="col-12 col-sm-auto me-0 me-sm-3 form-padding">
        <input class="form-check-input" type="radio" name="vi_tri" id="vitri1" value="1" checked="">
        <label class="form-check-label" for="vitri1">Theo càng cuối</label>
    </div>
    <div class="col-12 col-sm-auto me-0 me-sm-3 form-padding">
        <input class="form-check-input" type="radio" name="vi_tri" id="vitri2" value="2">
        <label class="form-check-label" for="vitri2">Theo càng giữa</label>
    </div>
    <div class="col-12 col-sm-auto me-0 me-sm-3 form-padding">
        <input class="form-check-input" type="radio" name="vi_tri" id="vitri3" value="3">
        <label class="form-check-label" for="vitri3">Theo càng đầu</label>
    </div>
</div>
<div class="row form-margin justify-content-end">
    <div class="col-sm-auto form-padding">
        <button id="auto-click-button" class="btn text-white bg-btn text-nowrap w-100 ps-5 pe-5" onclick="TC(this);">Xem kết quả</button>
    </div>
</div>
