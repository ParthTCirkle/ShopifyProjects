@extends('layout.master_layout')
@section('title','Plan Index')
@section('content')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Welcome to Plan Index</h2>
                    </div>
                    <div class="Polaris-Card__Section">
                        <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
                        <p>Your plan: {{ $shopDomain ?? Auth::user()->plan_id }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>

    <br>
    <div id="plans">
        <div class="Polaris-Layout">
            @foreach ($plans as $plan)
            <div class="Polaris-Layout__Section Polaris-Layout__Section--oneThird">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <div class="Polaris-Stack Polaris-Stack--alignmentBaseline">
                            <div class="Polaris-Stack__Item Polaris-Stack__Item--fill">
                                <h2 class="Polaris-Heading">{{$plan->name}}</h2>
                            </div>
                            <div class="Polaris-Stack__Item">
                                <div class="Polaris-ButtonGroup">
                                    {{-- @if ($plan->primary)
                                        <div>
                                            <span class="Polaris-Badge Polaris-Badge--statusSuccess Polaris-Badge--progressComplete">
                                                <span class="Polaris-Badge__Pip">
                                                </span>Most Popular
                                            </span>
                                            <div id="PolarisPortalsContainer"></div>
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Polaris-Card__Section">
                        <span class="Polaris-TextStyle--variationSubdued">Plan Price : <b> {{$plan->price}}$ </b></span><br>
                        <span class="Polaris-TextStyle--variationSubdued">Plan Type : <b> {{( $plan->test ) ? ( $plan->id > 1 ) ? "Paid Plan" : "Free Plan" : $plan->test."Paid Plan"}} </b></span><br>
                        {{-- <span class="Polaris-TextStyle--variationSubdued">Plan Discription : <b> {{ $plan->description }} </b></span> --}}
                    </div>
                    <div class="Polaris-Card__Section">
                        <div class="Polaris-Card__SectionHeader">
                            <div>
                                <button class="Polaris-Button Polaris-Button--primary subscribe" type="button" id="{{$plan->id}}">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text">
                                            <a class="btn" href="{{ route('billing', ['plan' => $plan->id, 'shop' => Auth::user()->name]) }}">Upgrade</a>
                                            {{-- Subscribe --}}
                                        </span>
                                    </span>
                                </button>
                                <div id="PolarisPortalsContainer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>
@push('page_script')
    <script>
        // var back = Button.create(app, {label: 'Back'});
        // back.subscribe(Button.Action.CLICK, function() {
        //     app.dispatch(Redirect.toApp({path: '/product/index'}));
        // });

        // const breadcrumb = Button.create(app, { label: 'Product' });
        // breadcrumb.subscribe(Button.Action.CLICK, () => {
        //     app.dispatch(Redirect.toApp({ path: '/product/index' }));
        // });

        var titleBarOptions = {
            title: 'Plans',
            // breadcrumbs: breadcrumb,
            buttons: {
                // primary: back,
                // secondary: [],
            },
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

    </script>
@endpush

@endsection


