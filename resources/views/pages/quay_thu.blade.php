@extends('layouts.app')

@section('content')
    <div class="row p-b-50 layout-margin mt-4">
        @include('partials.sidenav')

        <div class="col-md-8 col-lg-6 layout-padding">
            <table class="w-100 xs-day table-lotto br-10 bg-white table-shadow overflow-hidden text-center m-b-15">
                <tbody><tr>
                    <th class="p-0 fw-normal">
                        <a class="{{ $type == 'xsmb' ? 'selected' : '' }} txt-change-content p-1" href="/quay-thu-xsmb" title="Quay thử XSMB">Quay thử XSMB</a>
                    </th>
                    <th class="p-0 fw-normal">
                        <a class="{{ $type == 'xsmt' ? 'selected' : '' }} txt-change-content p-1" href="/quay-thu-xsmt" title="Quay thử XSMT">Quay thử XSMT</a>
                    </th>
                    <th class="p-0 fw-normal">
                        <a class="{{ $type == 'xsmn' ? 'selected' : '' }} txt-change-content p-1" href="/quay-thu-xsmn" title="Quay thử XSMN">Quay thử XSMN</a>
                    </th>
                </tr></tbody>
            </table>

            @include('pages.quay_thu_table.' . $type)

            <div class="bg-white table-shadow br-10 txt-padding m-b-15">
                <p>Truy cập nay website {{ setting('site_name') }} để tham gia <strong>quay thử {{ $typeName }}</strong> và lấy ngay cặp số may mắn tham tham gia dự thưởng.
                    {{ setting('site_name') }} cung cấp tính năng quay thử {{ $typeName }} điện tử, chính xác. Quy trình quay thử {{ $typeName }} được thiết lập hoàn toàn tương tự với quy trình quay thưởng thực tế, mang đến cho người tham gia trải nghiệm như ở một phiên quay thưởng chính thức. </p>
                <p>Bạn đọc hãy tham gia quay thử {{ $typeName }} ngay để có thêm gợi ý về các cặp số may mắn có xác suất trúng thưởng cao để tham gia dự thưởng trong phiên quay thưởng trong ngày. Kết quả quay thử {{ $typeName }} chỉ mang tính chất tham khảo!</p>
                <h3>Hướng dẫn xem quay thử {{ $typeName }}:</h3>
                <ul>
                    <li>Bước 1: Truy cập vào website <a href="">{{ setting('site_name') }}</a>
                    </li>
                    <li>Bước 2: Nhấn con trỏ chuột vào danh mục Quay thử hiển thị trên thanh Menu.</li>
                    <li>Bước 3: Sau khi danh mục <a href="/quay-thu-{{ $type }}">Quay thử {{ $typeName }}</a> hiện ra, nhấn con trỏ chuột vào danh mục này. </li>
                    <li>Bước 3: Nhấn vào nút QUAY THỬ hiển thị trên màn hình để bắt đầu tham gia quay thử.</li>
                    <li>Bước 4: Quá trình quay thử {{ $typeName }} sẽ được diễn ra trong vòng 30s – 45s, theo đúng trình tự của một buổi mở thưởng chính thức.</li>
                    <li>Bước 5: Chọn chế độ xem theo dạng 2 số hoặc 3 số cuối theo nhu cầu để tham khảo các cặp lô tô.</li>
                </ul>
            </div>

        </div>

        @include('partials.sidebar')
    </div>

    @push('scripts')
        <script src="{{ asset('js/quay-thu/functions.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 1) detect ads block
                detectAdsBlock();

                // 2) set up event listeners for "quay thử"
                detectTryLottery();

                // 3) set up datepickers
                initDatePicker();

                // 4) etc...
                initSounds();
                detectMuteButtonClick();
                detectChangeViewMode();
                displayLoading();
            });
        </script>
    @endpush
@endsection
