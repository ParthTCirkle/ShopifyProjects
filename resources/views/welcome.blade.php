@extends('layout.master_layout')
@section('title','Client')
@section('content')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Welcome to dashboard</h2>
                    </div>
                    <div class="Polaris-Card__Section">
                        {{-- <p>View a summary of your online store’s performance.</p> --}}
                        <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>
@push('page_script')
@endpush

@endsection



