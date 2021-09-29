{{-- {{dd($products, $next, $previous)}} --}}
@extends('layout.master_layout')
@section('title','Customer Index')
@section('content')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Welcome to Customer Index</h2>
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
    <br>
    {{-- <br> --}}
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    {{-- <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Online store dashboard</h2>
                    </div> --}}
                    <div class="Polaris-Card__Section">
                        {{-- <p>View a summary of your online store’s performance.</p> --}}
                        <div>
                            <div class="Polaris-Page-Header Polaris-Page-Header--isSingleRow Polaris-Page-Header--mobileView Polaris-Page-Header--noBreadcrumbs Polaris-Page-Header--mediumTitle">
                                <div class="Polaris-Page-Header__Row">
                                    <div class="Polaris-Page-Header__TitleWrapper">
                                        <div>
                                            <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">

                                                <div>
                                                    <nav aria-label="Pagination">
                                                        <div class="Polaris-ButtonGroup" data-buttongroup-segmented="false">
                                                            @if ($previous)
                                                            <div class="Polaris-ButtonGroup__Item">
                                                                <button id="previousURL" onclick=" window.location.href = '{{ route('customer.index', ['link'=>$previous]) }}'" class="Polaris-Button Polaris-Button--outline Polaris-Button--iconOnly" aria-label="Previous" type="button">
                                                                    <span class="Polaris-Button__Content">
                                                                        <span class="Polaris-Button__Icon">
                                                                            <span class="Polaris-Icon">
                                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                                    <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16z"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            @endif
                                                            <div class="Polaris-ButtonGroup__Item">
                                                                <div aria-live="polite">
                                                                    <span class=""> Results : <b> {{collect($customers)->count()}} </b></span>
                                                                </div>
                                                            </div>
                                                            @if ($next)
                                                            <div class="Polaris-ButtonGroup__Item">
                                                                <button id="nextURL" onclick=" window.location.href = '{{ route('customer.index', ['link'=>$next]) }}'" class="Polaris-Button Polaris-Button--outline Polaris-Button--iconOnly" aria-label="Next" type="button">
                                                                    <span class="Polaris-Button__Content">
                                                                        <span class="Polaris-Button__Icon">
                                                                            <span class="Polaris-Icon">
                                                                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                                    <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16z"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </nav>
                                                    <div id="PolarisPortalsContainer"></div>
                                                </div>

                                                {{-- <h1 class="Polaris-Header-Title">Sales by product</h1> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Polaris-Page__Content">
                                <div class="Polaris-Card">


                                    <div class="">
                                        <div class="Polaris-DataTable__Navigation">
                                            <button class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table left one column" type="button" disabled="">
                                                <span class="Polaris-Button__Content">
                                                    <span class="Polaris-Button__Icon">
                                                        <span class="Polaris-Icon">
                                                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16z"></path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </span>
                                            </button>
                                            <button class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column" type="button">
                                                <span class="Polaris-Button__Content">
                                                    <span class="Polaris-Button__Icon">
                                                        <span class="Polaris-Icon">
                                                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16z"></path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="Polaris-DataTable">
                                            <div class="Polaris-DataTable__ScrollContainer">
                                                <table class="Polaris-DataTable__Table">
                                                    <thead>
                                                        <tr>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">First Name</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Last Name</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">E-mail</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Phone</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Tags</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customers as $customer)
                                                            <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable">
                                                                <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{{ $customer->first_name }} </th>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $customer->last_name }} </td>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $customer->email }} </td>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $customer->phone }} </td>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $customer->tags }} </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="PolarisPortalsContainer"></div>
                        </div>



                        {{-- <div>
                            <nav aria-label="Pagination">
                                <div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented" data-buttongroup-segmented="true">
                                    @if ($previous)
                                    <div class="Polaris-ButtonGroup__Item">
                                        <button id="previousURL" onclick=" window.location.href = '{{ route('product.index', ['link'=>$previous]) }}'" class="Polaris-Button Polaris-Button--outline Polaris-Button--iconOnly" aria-label="Previous" type="button">
                                            <span class="Polaris-Button__Content">
                                                <span class="Polaris-Button__Icon">
                                                    <span class="Polaris-Icon">
                                                        <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                            <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16z"></path>
                                                        </svg>
                                                    </span>
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                    @endif

                                    @if ($next)
                                    <div class="Polaris-ButtonGroup__Item">
                                        <button id="nextURL" onclick=" window.location.href = '{{ route('product.index', ['link'=>$next]) }}'" class="Polaris-Button Polaris-Button--outline Polaris-Button--iconOnly" aria-label="Next" type="button">
                                            <span class="Polaris-Button__Content">
                                                <span class="Polaris-Button__Icon">
                                                    <span class="Polaris-Icon">
                                                        <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                            <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16z"></path>
                                                        </svg>
                                                    </span>
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </nav>
                            <div id="PolarisPortalsContainer"></div>
                        </div> --}}

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
            app.dispatch(Redirect.toApp({path: '/'}));
        });

        var syncProduct = Button.create(app, {label: 'Sync Customer'});
        syncProduct.subscribe(Button.Action.CLICK, function() {
            app.dispatch(Redirect.toApp({path: '/customer/sync'}));
        });

        var titleBarOptions = {
            title: 'Customer',
            buttons: {
                primary: syncProduct,
                secondary: [createProduct],
            },
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endpush
@endsection


