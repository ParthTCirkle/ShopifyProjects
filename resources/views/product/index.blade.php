@extends('layout.master_layout')
@section('title','Product Index')
@section('content')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Welcome to Product Index</h2>
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
    <script>
        var createProduct = Button.create(app, {label: 'Create'});
        createProduct.subscribe(Button.Action.CLICK, function() {
            app.dispatch(Redirect.toApp({path: '/product/create'}));
        });

        var syncProduct = Button.create(app, {label: 'Sync Product'});
        syncProduct.subscribe(Button.Action.CLICK, function() {
            app.dispatch(Redirect.toApp({path: '/product/sync'}));
        });

        var titleBarOptions = {
            title: 'Product',
            buttons: {
                primary: syncProduct,
                secondary: [createProduct],
            },
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

    </script>
@endpush
@endsection


