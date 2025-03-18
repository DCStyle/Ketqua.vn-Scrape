@extends('layouts.app')

@section('content')
    <div class="row p-b-50 layout-margin mt-4">
        <div class="container-fluid py-4">
            <div class="row g-4">
                <!-- Northern Region -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 border-0 rounded-3">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <h5 class="mb-0">
                                    <a href="/ket-qua-xo-so-mien-bac-xsmb.rss" class="text-white text-decoration-none d-flex align-items-center">
                                        Kết quả xổ số miền Bắc
                                        <i class="fas fa-rss ms-2 small"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 ps-0">
                                    <a href="/bac-ninh-bn.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                        <i class="fas fa-chevron-circle-right text-primary me-2"></i>
                                        <span>Kết quả xổ số Bắc Ninh</span>

                                    </a>
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <a href="/hai-phong-hp.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                        <i class="fas fa-chevron-circle-right text-primary me-2"></i>
                                        <span>Kết quả xổ số Hải Phòng</span>

                                    </a>
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <a href="/nam-dinh-nd.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                        <i class="fas fa-chevron-circle-right text-primary me-2"></i>
                                        <span>Kết quả xổ số Nam Định</span>

                                    </a>
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <a href="/quang-ninh-qn.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                        <i class="fas fa-chevron-circle-right text-primary me-2"></i>
                                        <span>Kết quả xổ số Quảng Ninh</span>

                                    </a>
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <a href="/thai-binh-tb.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                        <i class="fas fa-chevron-circle-right text-primary me-2"></i>
                                        <span>Kết quả xổ số Thái Bình</span>

                                    </a>
                                </li>
                                <li class="list-group-item border-0 ps-0">
                                    <a href="/ha-noi-td.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                        <i class="fas fa-chevron-circle-right text-primary me-2"></i>
                                        <span>Kết quả xổ số Hà Nội</span>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Southern Region -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 border-0 rounded-3">
                        <div class="card-header bg-success text-white">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <h5 class="mb-0">
                                    <a href="/ket-qua-xo-so-mien-nam-xsmn.rss" class="text-white text-decoration-none d-flex align-items-center">
                                        Kết quả xổ số miền Nam
                                        <i class="fas fa-rss ms-2 small"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/an-giang-ag.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số An Giang</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/binh-duong-bd.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Bình Dương</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/bac-lieu-bl.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Bạc Liêu</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/binh-phuoc-bp.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Bình Phước</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/binh-thuan-bth.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Bình Thuận</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/ben-tre-btr.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Bến Tre</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/ca-mau-cm.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Cà Mau</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/can-tho-ct.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Cần Thơ</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/da-lat-dl.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Đà Lạt</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/dong-nai-dn.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Đồng Nai</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/dong-thap-dt.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Đồng Tháp</span>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/tp.hcm-hcm.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số TP.HCM</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/hau-giang-hg.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Hậu Giang</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/kien-giang-kg.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Kiên Giang</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/long-an-la.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Long An</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/soc-trang-st.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Sóc Trăng</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/tien-giang-tg.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Tiền Giang</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/tay-ninh-tn.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Tây Ninh</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/tra-vinh-tv.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Trà Vinh</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/vinh-long-vl.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Vĩnh Long</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/vung-tau-vt.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-success me-2"></i>
                                                <span>Xổ số Vũng Tàu</span>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Central Region and Statistics -->
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 border-0 rounded-3">
                        <div class="card-header bg-info text-white">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <h5 class="mb-0">
                                    <a href="/ket-qua-xo-so-mien-trung-xsmt.rss" class="text-white text-decoration-none d-flex align-items-center">
                                        Kết quả xổ số miền Trung
                                        <i class="fas fa-rss ms-2 small"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/binh-dinh-bdi.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Bình Định</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/dak-lak-dlk.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Đắk Lắk</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/da-nang-dna.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Đà Nẵng</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/dak-nong-dno.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Đắk Nông</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/gia-lai-gl.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Gia Lai</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/khanh-hoa-kh.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Khánh Hòa</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/kon-tum-kt.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Kon Tum</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/ninh-thuan-nt.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Ninh Thuận</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/phu-yen-py.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Phú Yên</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/quang-binh-qb.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Quảng Bình</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/quang-nam-qna.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Quảng Nam</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/quang-ngai-qng.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Quảng Ngãi</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/quang-tri-qt.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Quảng Trị</span>

                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 ps-0">
                                            <a href="/hue-tth.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                                <i class="fas fa-chevron-circle-right text-info me-2"></i>
                                                <span>Xổ số Huế</span>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-header bg-warning">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-bar-chart-fill me-2 text-dark"></i>
                                <h5 class="mb-0">
                                    <a href="/thong-ke-kqxs-2011.rss" class="text-dark text-decoration-none d-flex align-items-center">
                                        Tin tức
                                        <i class="fas fa-rss ms-2 small"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a href="/tin-tuc.rss" class="text-decoration-none d-flex align-items-center py-1 link-hover">
                                    <span><i class="fas fa-newspaper me-2"></i> Tin tức</span>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .link-hover:hover {
            color: #0d6efd;
            transform: translateX(3px);
            transition: all 0.2s ease;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .list-group-item a {
            color: #333;
            font-weight: 400;
        }

        .list-group-item a:hover {
            font-weight: 500;
        }

        .card-header {
            border-bottom: none;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
    </style>
@endpush
