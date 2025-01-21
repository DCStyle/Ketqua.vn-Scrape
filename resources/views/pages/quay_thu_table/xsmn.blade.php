<div class="bg-white br-10 table-shadow m-b-15">
    <div class="result-board" id="try-region-box">
        <table class="table-lotto br-8 overflow-hidden bg-white w-100 text-center">
            <tbody><tr>
                <th colspan="27" id="try-region-first-th" class="padding-10">
                    <h2 class="color-brand text-decoration-none fw-bold txt-title m-b-10 lh-base">
                        Quay thử xổ số <span id="try-province-name">Miền Nam</span> ngày {{ now()->format('d-m-Y') }}
                    </h2>
                    <div class="row form-margin justify-content-center m-b-10">
                        <input type="hidden" id="try-region" value="3">
                        <script type="text/javascript">var provinces='[{"id":12,"name":"An Giang","slug":"an-giang","days":"5","route_name":null,"description":null,"sms_code":"ag","region":3,"display_order":20,"status":1},{"id":9,"name":"B\u1ea1c Li\u00eau","slug":"bac-lieu","days":"3","route_name":null,"description":null,"sms_code":"bl","region":3,"display_order":21,"status":1},{"id":7,"name":"B\u1ebfn Tre","slug":"ben-tre","days":"3","route_name":null,"description":null,"sms_code":"btr","region":3,"display_order":22,"status":1},{"id":1,"name":"B\u00ecnh D\u01b0\u01a1ng","slug":"binh-duong","days":"6","route_name":null,"description":null,"sms_code":"bd","region":3,"display_order":23,"status":1},{"id":18,"name":"B\u00ecnh Ph\u01b0\u1edbc","slug":"binh-phuoc","days":"7","route_name":null,"description":null,"sms_code":"bp","region":3,"display_order":24,"status":1},{"id":10,"name":"B\u00ecnh Thu\u1eadn","slug":"binh-thuan","days":"5","route_name":null,"description":null,"sms_code":"bth","region":3,"display_order":25,"status":1},{"id":15,"name":"C\u00e0 Mau","slug":"ca-mau","days":"2","route_name":null,"description":null,"sms_code":"cm","region":3,"display_order":27,"status":1},{"id":5,"name":"C\u1ea7n Th\u01a1","slug":"can-tho","days":"4","route_name":null,"description":null,"sms_code":"ct","region":3,"display_order":28,"status":1},{"id":20,"name":"\u0110\u00e0 L\u1ea1t","slug":"da-lat","days":"8","route_name":null,"description":null,"sms_code":"dl","region":3,"display_order":29,"status":1},{"id":4,"name":"\u0110\u1ed3ng Nai","slug":"dong-nai","days":"4","route_name":null,"description":null,"sms_code":"dn","region":3,"display_order":30,"status":1},{"id":14,"name":"\u0110\u1ed3ng Th\u00e1p","slug":"dong-thap","days":"2","route_name":null,"description":null,"sms_code":"dt","region":3,"display_order":31,"status":1},{"id":19,"name":"H\u1eadu Giang","slug":"hau-giang","days":"7","route_name":null,"description":null,"sms_code":"hg","region":3,"display_order":33,"status":1},{"id":13,"name":"H\u1ed3 Ch\u00ed Minh","slug":"tphcm","days":"2-7","route_name":null,"description":null,"sms_code":"hcm","region":3,"display_order":34,"status":1},{"id":17,"name":"Ki\u00ean Giang","slug":"kien-giang","days":"8","route_name":null,"description":null,"sms_code":"kg","region":3,"display_order":35,"status":1},{"id":21,"name":"Long An","slug":"long-an","days":"7","route_name":null,"description":null,"sms_code":"la","region":3,"display_order":36,"status":1},{"id":6,"name":"S\u00f3c Tr\u0103ng","slug":"soc-trang","days":"4","route_name":null,"description":null,"sms_code":"st","region":3,"display_order":37,"status":1},{"id":11,"name":"T\u00e2y Ninh","slug":"tay-ninh","days":"5","route_name":null,"description":null,"sms_code":"tn","region":3,"display_order":38,"status":1},{"id":16,"name":"Ti\u1ec1n Giang","slug":"tien-giang","days":"8","route_name":null,"description":null,"sms_code":"tg","region":3,"display_order":39,"status":1},{"id":3,"name":"Tr\u00e0 Vinh","slug":"tra-vinh","days":"6","route_name":null,"description":null,"sms_code":"tv","region":3,"display_order":40,"status":1},{"id":2,"name":"V\u0129nh Long","slug":"vinh-long","days":"6","route_name":null,"description":null,"sms_code":"vl","region":3,"display_order":41,"status":1},{"id":8,"name":"V\u0169ng T\u00e0u","slug":"vung-tau","days":"3","route_name":null,"description":null,"sms_code":"vt","region":3,"display_order":42,"status":1}]';</script>
                        <div class="col-5 col-sm-auto form-padding">
                            <select class="form-select" id="try-diw-select">
                                <option value="2">Thứ 2</option>
                                <option value="3" selected="">Thứ 3</option>
                                <option value="4">Thứ 4</option>
                                <option value="5">Thứ 5</option>
                                <option value="6">Thứ 6</option>
                                <option value="7">Thứ 7</option>
                                <option value="8">Chủ nhật</option>
                            </select>
                        </div>
                        <div class="col-7 col-sm-auto form-padding">
                            <select class="form-select" id="try-province-select">
                                <option value="9">Bạc Liêu</option>
                                <option value="7">Bến Tre</option>
                                <option value="8">Vũng Tàu</option>
                            </select>
                        </div>
                        <div class="col-auto form-padding">
                            <button class="btn text-white bg-btn text-nowrap" id="try-region-start">
                                Bắt đầu quay
                            </button>
                        </div>
                    </div>
                </th>
            </tr>
            </tbody><tbody id="try-region-body">
            <tr class="bg-light">
                <th colspan="3" class="color-sub-brand txt-content fw-medium p-0">
                    Tỉnh
                </th>
                <th colspan="8" class="color-sub-brand txt-content fw-medium">
                    Bạc Liêu
                </th>
                <th colspan="8" class="color-sub-brand txt-content fw-medium">
                    Bến Tre
                </th>
                <th colspan="8" class="color-sub-brand txt-content fw-medium">
                    Vũng Tàu
                </th>
            </tr>
            <tr>
                <td colspan="3" class="fw-medium">G8</td>
                <td colspan="8" class="txt-normal-prize try-g8">
                    <div class="number try_number_9_1">
                        <div class="loadingio-spinner-spin-hgd29ahypuk">
                            <div class="ldio-68g4b00eac8">
                                <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                            </div>
                        </div>
                    </div>
                </td>
                <td colspan="8" class="txt-normal-prize try-g8">
                    <div class="number try_number_7_1">
                        <div class="loadingio-spinner-spin-hgd29ahypuk">
                            <div class="ldio-68g4b00eac8">
                                <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                            </div>
                        </div>
                    </div>
                </td>
                <td colspan="8" class="txt-normal-prize try-g8">
                    <div class="number try_number_8_1">
                        <div class="loadingio-spinner-spin-hgd29ahypuk">
                            <div class="ldio-68g4b00eac8">
                                <div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="bg-color-lotto-background">
                <td colspan="3" class="fw-medium">G7</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_2"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_2"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_2"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="3" class="fw-medium">G6</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_3"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_3"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_3"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_4"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_4"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_4"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_5"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_5"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_5"></div>
                </td>
            </tr>
            <tr class="bg-color-lotto-background">
                <td colspan="3" class="fw-medium">G5</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_6"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_6"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_6"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3" rowspan="7" class="fw-medium">G4</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_7"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_7"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_7"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_8"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_8"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_8"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_9"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_9"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_9"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_10"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_10"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_10"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_11"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_11"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_11"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_12"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_12"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_12"></div>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_13"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_13"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_13"></div>
                </td>
            </tr>
            <tr class="bg-color-lotto-background">
                <td colspan="3" rowspan="2" class="fw-medium">G3</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_14"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_14"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_14"></div>
                </td>
            </tr>
            <tr class="bg-color-lotto-background">
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_15"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_15"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_15"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="fw-medium">G2</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_16"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_16"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_16"></div>
                </td>
            </tr>
            <tr class="bg-color-lotto-background">
                <td colspan="3" class="fw-medium">G1</td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_9_17"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_7_17"></div>
                </td>
                <td colspan="8" class="txt-normal-prize">
                    <div class="number try_number_8_17"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="fw-medium color-highlight">ĐB</td>
                <td colspan="8" class="txt-special-prize">
                    <div class="number try_number_9_18"></div>
                </td>
                <td colspan="8" class="txt-special-prize">
                    <div class="number try_number_7_18"></div>
                </td>
                <td colspan="8" class="txt-special-prize">
                    <div class="number try_number_8_18"></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="p-t-10 p-l-10 p-r-10 p-b-15 text-nowrap d-flex align-items-center justify-content-between bd-bottom-1">
        <div class="txt-sub-content d-flex align-items-center">
            <div class="form-check m-r-10">
                <input class="form-check-input change_view_mode" type="radio" name="sh_kq" id="sh_kq_0" value="0" checked="">
                <label class="form-check-label" for="sh_kq_0">
                    Tất cả
                </label>
            </div>
            <div class="form-check m-r-10">
                <input class="form-check-input change_view_mode" type="radio" name="sh_kq" id="sh_kq_2" value="2">
                <label class="form-check-label" for="sh_kq_2">
                    2 số cuối
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input change_view_mode" type="radio" name="sh_kq" id="sh_kq_3" value="3">
                <label class="form-check-label" for="sh_kq_3">
                    3 số cuối
                </label>
            </div>
        </div>
    </div>
    <table class="table-lotto bblr-1 bbrr-1 overflow-hidden w-100 fw-medium" id="try-region-dd">
        <tbody><tr class="text-center">
            <th colspan="3" class="p-0 fw-medium">Đầu</th>
            <th colspan="8" class="p-0 fw-medium">Bạc Liêu</th>
            <th colspan="8" class="p-0 fw-medium">Bến Tre</th>
            <th colspan="8" class="p-0 fw-medium">Vũng Tàu</th>
        </tr>
        <tr class="bg-color-lotto-background">
            <td colspan="3" class="text-center">0</td>
            <td colspan="8" class="dd-kq dd_9_dau_0"></td>
            <td colspan="8" class="dd-kq dd_7_dau_0"></td>
            <td colspan="8" class="dd-kq dd_8_dau_0"></td>
        </tr>
        <tr class="">
            <td colspan="3" class="text-center">1</td>
            <td colspan="8" class="dd-kq dd_9_dau_1"></td>
            <td colspan="8" class="dd-kq dd_7_dau_1"></td>
            <td colspan="8" class="dd-kq dd_8_dau_1"></td>
        </tr>
        <tr class="bg-color-lotto-background">
            <td colspan="3" class="text-center">2</td>
            <td colspan="8" class="dd-kq dd_9_dau_2"></td>
            <td colspan="8" class="dd-kq dd_7_dau_2"></td>
            <td colspan="8" class="dd-kq dd_8_dau_2"></td>
        </tr>
        <tr class="">
            <td colspan="3" class="text-center">3</td>
            <td colspan="8" class="dd-kq dd_9_dau_3"></td>
            <td colspan="8" class="dd-kq dd_7_dau_3"></td>
            <td colspan="8" class="dd-kq dd_8_dau_3"></td>
        </tr>
        <tr class="bg-color-lotto-background">
            <td colspan="3" class="text-center">4</td>
            <td colspan="8" class="dd-kq dd_9_dau_4"></td>
            <td colspan="8" class="dd-kq dd_7_dau_4"></td>
            <td colspan="8" class="dd-kq dd_8_dau_4"></td>
        </tr>
        <tr class="">
            <td colspan="3" class="text-center">5</td>
            <td colspan="8" class="dd-kq dd_9_dau_5"></td>
            <td colspan="8" class="dd-kq dd_7_dau_5"></td>
            <td colspan="8" class="dd-kq dd_8_dau_5"></td>
        </tr>
        <tr class="bg-color-lotto-background">
            <td colspan="3" class="text-center">6</td>
            <td colspan="8" class="dd-kq dd_9_dau_6"></td>
            <td colspan="8" class="dd-kq dd_7_dau_6"></td>
            <td colspan="8" class="dd-kq dd_8_dau_6"></td>
        </tr>
        <tr class="">
            <td colspan="3" class="text-center">7</td>
            <td colspan="8" class="dd-kq dd_9_dau_7"></td>
            <td colspan="8" class="dd-kq dd_7_dau_7"></td>
            <td colspan="8" class="dd-kq dd_8_dau_7"></td>
        </tr>
        <tr class="bg-color-lotto-background">
            <td colspan="3" class="text-center">8</td>
            <td colspan="8" class="dd-kq dd_9_dau_8"></td>
            <td colspan="8" class="dd-kq dd_7_dau_8"></td>
            <td colspan="8" class="dd-kq dd_8_dau_8"></td>
        </tr>
        <tr class="">
            <td colspan="3" class="text-center">9</td>
            <td colspan="8" class="dd-kq dd_9_dau_9"></td>
            <td colspan="8" class="dd-kq dd_7_dau_9"></td>
            <td colspan="8" class="dd-kq dd_8_dau_9"></td>
        </tr>
        </tbody></table>
    <div class="padding-15 bd-top-1">
        <ul class="suggested-link">
            <li>Xem thêm <a href="/xo-so-mien-nam-hom-qua" title="Kết quả XSMN hôm qua">Kết quả XSMN hôm qua</a></li>
        </ul>
    </div>
</div>
