{{-- {{dd($products[0]['image']['src'])}} --}}
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
    <br>
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
                                                <div style="display: inline-block; margin-top: -10px">
                                                    <nav aria-label="Pagination">
                                                        <div class="Polaris-ButtonGroup" data-buttongroup-segmented="false">
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
                                                            <div class="Polaris-ButtonGroup__Item">
                                                                <div aria-live="polite">
                                                                    <span class=""> Results : {{collect($products)->count()}} Out of {{$totalProducts}} </span>
                                                                </div>
                                                            </div>
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
                                                </div>

                                                {{-- <div style="inline-block; float: right; margin-top: -10px;">
                                                    <button class="Polaris-Button Polaris-Button--primary" type="button">
                                                        <span class="Polaris-Button__Content">
                                                            <span class="Polaris-Button__Text">Sync</span>
                                                        </span>
                                                    </button>
                                                    <div id="PolarisPortalsContainer"></div>
                                                </div> --}}

                                                {{-- <div style="inline-block; float: right; margin-top: -10px; margin-right: 20px">
                                                    <button class="Polaris-Button" type="button">
                                                        <span class="Polaris-Button__Content">
                                                            <span class="Polaris-Button__Text"> Add product</span>
                                                        </span>
                                                    </button>
                                                    <div id="PolarisPortalsContainer"></div>
                                                </div> --}}
                                                {{-- search bar --}}
                                                {{-- <div class="Polaris-Connected" style="width: 30%; display: inline-block; float: right; margin-top: -10px; margin-right:20px;">
                                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                        <div class="Polaris-TextField">
                                                            <div class="Polaris-TextField__Prefix" id="PolarisTextField16Prefix">
                                                                <span class="Polaris-Filters__SearchIcon">
                                                                    <span class="Polaris-Icon">
                                                                        <span class="Polaris-VisuallyHidden"></span>
                                                                        <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                            <path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm9.707 4.293-4.82-4.82A5.968 5.968 0 0 0 14 8 6 6 0 0 0 2 8a6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414z"></path>
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <input id="PolarisTextField16" placeholder="Filter products" autocomplete="off" class="Polaris-TextField__Input Polaris-TextField__Input--hasClearButton" aria-labelledby="PolarisTextField16Label PolarisTextField16Prefix" aria-invalid="false" value="">
                                                            <div class="Polaris-TextField__Backdrop"></div>
                                                        </div>
                                                    </div>
                                                </div> --}}
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
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Image</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Product</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Vendor</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Product Type</th>
                                                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($products as $product)
                                                            <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable">
                                                                <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                                                                    @php
                                                                        $image = $product['image']['src'] ?? null;
                                                                    @endphp
                                                                    {{-- <div>
                                                                        <span class="Polaris-Thumbnail Polaris-Thumbnail--sizeSmall">
                                                                            <img src="{{($image) ? $product['image']['src'] : 'https://burst.shopifycdn.com/photos/black-leather-choker-necklace_373x@2x.jpg'}}" alt="Black choker necklace"></span>
                                                                        <div id="PolarisPortalsContainer"></div>
                                                                    </div> --}}

                                                                    <div>
                                                                        <span class="Polaris-Thumbnail Polaris-Thumbnail--sizeLarge">
                                                                            <img src="{{($image) ? $product['image']['src'] : 'https://burst.shopifycdn.com/photos/black-leather-choker-necklace_373x@2x.jpg'}}" alt="Black choker necklace"></span>
                                                                        <div id="PolarisPortalsContainer"></div>
                                                                    </div>
                                                                </th>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                                    {{$product->title}}

                                                                </td>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$product->vendor}}</td>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$product->product_type}}</td>
                                                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                                    @if ($product->status == 'active')
                                                                    <div>
                                                                        <span class="Polaris-Badge Polaris-Badge--statusSuccess">
                                                                            <span class="Polaris-VisuallyHidden">Success </span>{{$product->status}}
                                                                        </span>
                                                                        <div id="PolarisPortalsContainer"></div>
                                                                    </div>
                                                                    @elseif ($product->status == 'archived')
                                                                    <div>
                                                                        <span class="Polaris-Badge Polaris-Badge--statusInfo"><span class="Polaris-VisuallyHidden">Info </span>{{$product->status}}</span>
                                                                        <div id="PolarisPortalsContainer"></div>
                                                                    </div>


                                                                    @elseif ($product->status == 'draft')
                                                                    <div><span class="Polaris-Badge Polaris-Badge--statusWarning">
                                                                        <span class="Polaris-VisuallyHidden">Warning </span>{{$product->status}}</span>
                                                                        <div id="PolarisPortalsContainer"></div>
                                                                    </div>


                                                                    @endif
                                                                </td>

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
            app.dispatch(Redirect.toApp({path: '/product/create'}));
        });

        var syncProduct = Button.create(app, {label: 'Sync Product'});
        syncProduct.subscribe(Button.Action.CLICK, function() {
            // window.location.href = "{{route('product.sync')}}";
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

        // $('#previousURL').on('click', function(event) {

        //     var link = {!! $previous !!};
        //     console.log(link);
        //     // console.log("next");
        //     $.ajax({
        //         url: '{{ route('product.index') }}',
        //         type: "GET",
        //         data : {nextLink : nextLink}

        //         // success:function(response){
        //         //     if (response == 'success')
        //         //     {
        //         //         const toastOptions = {
        //         //             message: 'Start Importing...',
        //         //             duration: 5000,
        //         //         };
        //         //         const toastSuccess = Toast.create(app, toastOptions);
        //         //         toastSuccess.dispatch(Toast.Action.SHOW);
        //         //     }
        //         // },
        //     });

        // });

        // $('#nextURL').on('click', function(event) {
        //     var nextLink = "hello this is next link";
        //     console.log("next");
        //     $.ajax({
        //         url: '{{ route('product.index') }}',
        //         type: "GET",
        //         data : {nextLink : nextLink}

        //         // success:function(response){
        //         //     if (response == 'success')
        //         //     {
        //         //         const toastOptions = {
        //         //             message: 'Start Importing...',
        //         //             duration: 5000,
        //         //         };
        //         //         const toastSuccess = Toast.create(app, toastOptions);
        //         //         toastSuccess.dispatch(Toast.Action.SHOW);
        //         //     }
        //         // },
        //     });
        // });


    </script>
@endpush
@endsection


