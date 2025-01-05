@extends('layouts.app')

@section('content')
    @php
        $settings = \App\Models\FooterSetting::pluck('value', 'key')->all();
    @endphp

    <div class="row p-b-50 layout-margin mt-4">
        <div class="col-md-8 col-lg-9 layout-padding">
            <div class="bg-white table-shadow br-10 txt-padding overflow-hidden m-b-15">
                <h2>Gửi thư cho chúng tôi</h2>
                <p>
                    Mọi thắc mắc, góp ý, liên hệ quảng cáo, liên hệ hợp tác vui lòng điền
                    thông tin bên dưới, chúng tôi sẽ phản hồi theo thông tin bạn cung cấp !
                </p>
                <form action="" method="post">
                    <div class="form-margin">
                        <div class="form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Họ và tên</lable>
                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Họ và tên"> </div>
                        <div class="form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Số điện thoại</lable>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Số điện thoại"> </div>
                        <div class="form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Địa chỉ email</lable>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Địa chỉ email"> </div>
                        <div class="form-padding">
                            <lable class="fw-medium txt-sub-content d-block m-b-5">Nội dung liên hệ</lable>
                            <textarea id="content" name="content" class="form-control" rows="5" style="height:auto" placeholder="Nội dung liên hệ"></textarea> </div>
                        <div class="form-padding d-flex justify-content-end">
                            <button class="btn text-white bg-btn text-nowrap" type="submit">Gửi thư</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 layout-padding">
            <div class="br-10 txt-padding p-b-20 bg-white table-shadow overflow-hidden">
                <h3 class="mb-3">Thông tin liên hệ</h3>
                <p>
                    {{ $settings['site_description'] ?? '' }}
                </p>
                <p>
                    <i class="fas fa-envelope me-2"></i>
                    {{ $settings['email'] ?? '' }}
                </p>
                <p>
                    <i class="fas fa-phone-alt me-2"></i>
                </p>
                <div class="d-flex gap-3 align-items-center">
                    <a rel="noopener nofollow" target="_blank" href="{{ $settings['social_facebook'] ?? '#' }}" title="Facebook">
                        <img width="36" height="36" src="/assets/images/facebook.svg" alt="facebook fanpage">
                    </a>
                    <a rel="noopener nofollow" target="_blank" href="{{ $settings['social_telegram'] ?? '#' }}" title="Telegram">
                        <img width="36" height="36" src="/assets/images/telegram.svg" alt="telegram">
                    </a>
                    <a rel="noopener nofollow" target="_blank" href="{{ $settings['social_zalo'] ?? '#' }}" title="Zalo">
                        <img width="36" height="36" src="/assets/images/zalo.svg" alt="zalo">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
