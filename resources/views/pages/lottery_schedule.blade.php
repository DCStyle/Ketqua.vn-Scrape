@extends('layouts.app')

@section('content')
    @php
        $settings = \App\Models\FooterSetting::pluck('value', 'key')->all();
    @endphp

    <div class="row p-b-50 layout-margin mt-4">
        <div class="col-md-8 col-lg-9 layout-padding">
            <div class="bg-white br-10 table-shadow m-b-15">
                <table class="w-100 table-normal text-center overflow-hidden btlr-10 btrr-10 txt-change-content">
                    <tbody><tr class="bg-light">
                        <th class="col-1 col-sm-2">Khu vực</th>
                        <th class="col-3">
                            <a class="text-decoration-none color-content" href="/xsmb">Miền Bắc</a>
                        </th>
                        <th class="col-3">
                            <a class="text-decoration-none color-content" href="/xsmt">Miền Trung</a>
                        </th>
                        <th class="col-3">
                            <a class="text-decoration-none color-content" href="/xsmn">Miền Nam</a>
                        </th>
                    </tr>
                    <tr class="fw-medium">
                        <td>Khung giờ</td>
                        <td>18h15 → 18h35</td>
                        <td>17h15 → 17h35</td>
                        <td>16h15 → 16h35</td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Thứ 2</td>
                        <td class="text-start">
                            <a href="/xsmb/kqxs-ha-noi" class="text-decoration-none color-content">Hà Nội</a><br>
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-phu-yen" class="text-decoration-none color-content">Phú Yên</a><br>
                            <a href="/xsmt/kqxs-hue" class="text-decoration-none color-content">Huế</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-ca-mau" class="text-decoration-none color-content">Cà Mau</a><br>
                            <a href="/xsmn/kqxs-dong-thap" class="text-decoration-none color-content">Đồng Tháp</a><br>
                            <a href="/xsmn/kqxs-tphcm" class="text-decoration-none color-content">Hồ Chí Minh</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Thứ 3</td>
                        <td class="text-start">
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                            <a href="/xsmb/kqxs-quang-ninh" class="text-decoration-none color-content">Quảng Ninh</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-dak-lak" class="text-decoration-none color-content">Đắc Lắc</a><br>
                            <a href="/xsmt/kqxs-quang-nam" class="text-decoration-none color-content">Quảng Nam</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-bac-lieu" class="text-decoration-none color-content">Bạc Liêu</a><br>
                            <a href="/xsmn/kqxs-ben-tre" class="text-decoration-none color-content">Bến Tre</a><br>
                            <a href="/xsmn/kqxs-vung-tau" class="text-decoration-none color-content">Vũng Tàu</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Thứ 4</td>
                        <td class="text-start">
                            <a href="/xsmb/kqxs-bac-ninh" class="text-decoration-none color-content">Bắc Ninh</a><br>
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsdt/636" class="text-decoration-none color-content">Điện toán 636</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-da-nang" class="text-decoration-none color-content">Đà Nẵng</a><br>
                            <a href="/xsmt/kqxs-khanh-hoa" class="text-decoration-none color-content">Khánh Hòa</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-can-tho" class="text-decoration-none color-content">Cần Thơ</a><br>
                            <a href="/xsmn/kqxs-dong-nai" class="text-decoration-none color-content">Đồng Nai</a><br>
                            <a href="/xsmn/kqxs-soc-trang" class="text-decoration-none color-content">Sóc Trăng</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Thứ 5</td>
                        <td class="text-start">
                            <a href="/xsmb/kqxs-ha-noi" class="text-decoration-none color-content">Hà Nội</a><br>
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-binh-dinh" class="text-decoration-none color-content">Bình Định</a><br>
                            <a href="/xsmt/kqxs-quang-binh" class="text-decoration-none color-content">Quảng Bình</a><br>
                            <a href="/xsmt/kqxs-quang-tri" class="text-decoration-none color-content">Quảng Trị</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-an-giang" class="text-decoration-none color-content">An Giang</a><br>
                            <a href="/xsmn/kqxs-binh-thuan" class="text-decoration-none color-content">Bình Thuận</a><br>
                            <a href="/xsmn/kqxs-tay-ninh" class="text-decoration-none color-content">Tây Ninh</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Thứ 6</td>
                        <td class="text-start">
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsmb/kqxs-hai-phong" class="text-decoration-none color-content">Hải Phòng</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-gia-lai" class="text-decoration-none color-content">Gia Lai</a><br>
                            <a href="/xsmt/kqxs-ninh-thuan" class="text-decoration-none color-content">Ninh Thuận</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-binh-duong" class="text-decoration-none color-content">Bình Dương</a><br>
                            <a href="/xsmn/kqxs-tra-vinh" class="text-decoration-none color-content">Trà Vinh</a><br>
                            <a href="/xsmn/kqxs-vinh-long" class="text-decoration-none color-content">Vĩnh Long</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Thứ 7</td>
                        <td class="text-start">
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsdt/636" class="text-decoration-none color-content">Điện toán 636</a><br>
                            <a href="/xsmb/kqxs-nam-dinh" class="text-decoration-none color-content">Nam Định</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-da-nang" class="text-decoration-none color-content">Đà Nẵng</a><br>
                            <a href="/xsmt/kqxs-dak-nong" class="text-decoration-none color-content">Đắc Nông</a><br>
                            <a href="/xsmt/kqxs-quang-ngai" class="text-decoration-none color-content">Quảng Ngãi</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-binh-phuoc" class="text-decoration-none color-content">Bình Phước</a><br>
                            <a href="/xsmn/kqxs-hau-giang" class="text-decoration-none color-content">Hậu Giang</a><br>
                            <a href="/xsmn/kqxs-tphcm" class="text-decoration-none color-content">Hồ Chí Minh</a><br>
                            <a href="/xsmn/kqxs-long-an" class="text-decoration-none color-content">Long An</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Chủ nhật</td>
                        <td class="text-start">
                            <a href="/xsdt/123" class="text-decoration-none color-content">Điện toán 123</a><br>
                            <a href="/xsmb/kqxs-thai-binh" class="text-decoration-none color-content">Thái Bình</a><br>
                            <a href="/xsdt/xstt" class="text-decoration-none color-content">Thần tài</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmt/kqxs-khanh-hoa" class="text-decoration-none color-content">Khánh Hòa</a><br>
                            <a href="/xsmt/kqxs-kon-tum" class="text-decoration-none color-content">Kon Tum</a><br>
                            <a href="/xsmt/kqxs-hue" class="text-decoration-none color-content">Huế</a><br>
                        </td>
                        <td class="text-start">
                            <a href="/xsmn/kqxs-da-lat" class="text-decoration-none color-content">Đà Lạt</a><br>
                            <a href="/xsmn/kqxs-kien-giang" class="text-decoration-none color-content">Kiên Giang</a><br>
                            <a href="/xsmn/kqxs-tien-giang" class="text-decoration-none color-content">Tiền Giang</a><br>
                        </td>
                    </tr>
                    </tbody></table>
            </div>
            <div class="bg-white table-shadow br-10 txt-padding m-b-15">
                <section><p>&nbsp;Lịch mở thưởng xổ số 3 miền là thời gian mà các công ty xổ số kiến thiết thực hiện quay thưởng. Việc quay số mở thưởng chính thức được thực hiện theo thứ tự mở thưởng lần lượt của từng giải đã công bố trong thể lệ quay số mở thưởng. Quá trình mở thưởng diễn ra minh bạch có sự giám sát của Hội đồng giám sát xổ số.</p>
                    <p>Lịch mở thưởng ở mỗi miền sẽ khác nhau, cụ thể: </p>
                    <h3>Lịch mở thưởng XSMB:</h3>
                    <ul>
                        <li>Lịch mở thưởng xổ số miền Bắc lúc 18h00 → 18h30 tất cả các ngày trong tuần</li>
                        <li>Lịch mở thưởng kết quả xổ số miền Bắc có tổng cộng 6 đài và mở 27 giải trực tiếp</li>
                        <li>Danh sách các đài và lịch mở thưởng kết quả xổ số miền Bắc là: </li>
                        <li>Đài Hà Nội: Thứ 2, thứ 5.</li>
                        <li>Đài Quảng Ninh: Thứ 3.</li>
                        <li>Đài Bắc Ninh: Thứ 4.</li>
                        <li>Đài Hải Phòng: Thứ 6.</li>
                        <li>Đài Nam Định: Thứ 7.</li>
                        <li>Đài Thái Bình: Chủ Nhật.</li>
                    </ul>
                    <h3>Lịch mở thưởng XSMN:</h3>
                    <ul>
                        <li>Lịch mở thưởng xổ số miền Nam lúc 16h15 → 16h35 tất cả các ngày trong tuần</li>
                        <li>Lịch mở thưởng XSMN có tổng cộng 21 đài mở thưởng. Mỗi ngày tại miền Nam có 3 đến 4 đài quay thưởng và mỗi đài sẽ mở thưởng 1 lần trong tuần, duy chỉ có đài Hồ Chí Minh sẽ được mở thưởng 2 lần mỗi tuần.</li>
                        <li>Danh sách các đài và lịch mở thưởng xổ số miền Nam là:</li>
                        <li>Hồ Chí Minh - Đồng Tháp - Cà Mau: Thứ 2.</li>
                        <li>Bến Tre - Vũng Tàu - Bạc Liêu: Thứ 3.</li>
                        <li>Đồng Nai - Cần Thơ - Sóc Trăng: Thứ 4.</li>
                        <li>Tây Ninh - An Giang - Bình Thuận: Thứ 5.</li>
                        <li>Vĩnh Long - Bình Dương - Trà Vinh: Thứ 6</li>
                        <li>Hồ Chí Minh - Long An - Bình Phước - Hậu Giang: Thứ 7.</li>
                        <li>Tiền Giang - Kiên Giang - Đà Lạt: Chủ Nhật.</li>
                    </ul>
                    <h3>Lịch mở thưởng XSMT:</h3>
                    <ul>
                        <li>Lịch mở thưởng xổ số miền Trung lúc 17h15 → 17h30 tất cả các ngày trong tuần</li>
                        <li>Lịch mở thưởng miền Trung có tổng cộng 14 đài và công bố 18 giải.</li>
                        <li>Danh sách các đài và lịch mở thưởng xổ số miền Trung là: </li>
                        <li>Đài Thừa Thiên Huế - Phú Yên: Thứ 2.</li>
                        <li>Đài Đắk Lắk - Quảng Nam: Thứ 3.</li>
                        <li>Đài Đà Nẵng - Khánh Hòa: Thứ 4.</li>
                        <li>Đài Bình Định - Quảng Trị - Quảng Bình: Thứ 5.</li>
                        <li>Đài Gia Lai - Ninh Thuận: Thứ 6.</li>
                        <li>Đài Đà Nẵng - Quảng Ngãi - Đắk Nông: Thứ 7.</li>
                        <li>Đài Khánh Hòa - Kon Tum: Chủ Nhật.</li>
                    </ul>
                </section>
            </div>
        </div>

        @include('partials.sidebar')
    </div>
@endsection
