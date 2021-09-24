@extends('layout.master_layout')
@section('title','Product Create')
@section('content')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Welcome to Product Create</h2>
                    </div>
                    <div class="Polaris-Card__Section">
                        <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>
@push('page_script')
    <script>
        var back = Button.create(app, {label: 'Back'});
        back.subscribe(Button.Action.CLICK, function() {
            app.dispatch(Redirect.toApp({path: '/product/index'}));
        });

        const breadcrumb = Button.create(app, { label: 'Product' });
        breadcrumb.subscribe(Button.Action.CLICK, () => {
            app.dispatch(Redirect.toApp({ path: '/product/index' }));
        });

        var titleBarOptions = {
            title: 'Product Create',
            breadcrumbs: breadcrumb,
            buttons: {
                primary: back,
                // secondary: [],
            },
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

    </script>
@endpush

@endsection


