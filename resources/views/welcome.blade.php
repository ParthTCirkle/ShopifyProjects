@section('title','Home')
@include('layouts.header')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <div>
                            <p class="Polaris-DisplayText Polaris-DisplayText--sizeMedium">
                                @if ($charge)
                                    {{$charge['name']}}, is your activated plan.
                                @else
                                    Please, subscribe any plan first.
                                @endif
                            </p>
                            <div id="PolarisPortalsContainer"></div>
                        </div>
                        <br>
                    </div>
                    <div class="Polaris-Card__Section">
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>

@push('page_script')

@endpush

@include('layouts.footer')

