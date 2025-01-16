@extends('layouts.app')

@section('content')
    <div class="row p-b-50 layout-margin mt-4">
        <div class="col-md-8 col-lg-9 layout-padding">
            <div class="br-10 table-shadow overflow-hidden m-b-15 bg-white focus-box">
                <h2 class="bg-color-brand list-group-title fw-medium fs-6 mb-0 lh-base">
                    Thống kê loto gan
                </h2>

                @if($type === 'tan-suat-loto')
                    @include('pages.thong_ke_form.tan-suat-loto-highlight')
                @endif

                <div class="padding-10">
                    @include('pages.thong_ke_form.' . $type)
                </div>
            </div>

            <div id="tk_result"></div>
        </div>

        @include('partials.sidebar')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/thong-ke/thong-ke.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('auto-click-button').click();
        });
    </script>
@endpush
