@section('title','Product List')
@include('layouts.header')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <div>
                            <p class="Polaris-DisplayText Polaris-DisplayText--sizeMedium">Welcome to Product Page.</p>
                            <div id="PolarisPortalsContainer"></div>
                        </div>
                        <hr>
                    </div>
                    <div class="Polaris-Card__Section">
                        <div id="upgrade_plan_link_div" style="display: none">
                            <div>
                                <p class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">You exceed your limit of creating products as per your plan</p>
                                <div id="PolarisPortalsContainer"></div>
                            </div>
                            <br>
                            <div>
                                <div>Please Upgrade Your Plan...
                                    <button class="Polaris-Button Polaris-Button--plain Polaris-Button--monochrome" id="upgrade" type="button">
                                        <span class="Polaris-Button__Content">
                                            <span class="Polaris-Button__Text">click me to upgrade</span>
                                        </span>
                                    </button>
                                </div>
                                <div id="PolarisPortalsContainer"></div>
                            </div>
                        </div>

                        <div id="add_product_btn_div">
                            <button class="Polaris-Button Polaris-Button--primary" type="button" id="add_product">
                                <span class="Polaris-Button__Content">
                                    <span class="Polaris-Button__Text">New Product</span>
                                </span>
                            </button>
                            <div id="PolarisPortalsContainer"></div>
                        </div>
                        <br>
                        <div>
                            <button class="Polaris-Button" type="button" id="import_product">
                                <span class="Polaris-Button__Content">
                                    <span class="Polaris-Button__Text">Sync Products</span>
                                </span>
                            </button>
                            <div id="PolarisPortalsContainer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>

    <div>
        <div class="Polaris-Page-Header Polaris-Page-Header--isSingleRow Polaris-Page-Header--mobileView Polaris-Page-Header--noBreadcrumbs Polaris-Page-Header--mediumTitle">
            <div class="Polaris-Page-Header__Row">
                <div class="Polaris-Page-Header__TitleWrapper">
                    <div>
                        <div class="Polaris-Header-Title__TitleAndSubtitleWrapper"></div>
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
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col"><b> # </b></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col"><b> Product Title </b></th>
                                        {{-- <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><b> Description </b></th> --}}
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><b> Vendor </b></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><b> Type </b></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><b> Action </b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index=0;
                                    @endphp
                                    @foreach ($products as $product)
                                    @php
                                        $index++;
                                    @endphp
                                    <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable">
                                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row"><b> {{ $index }} </b></th>
                                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{{ $product->title }}</th>
                                        {{-- <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $product->description }}</td> --}}
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $product->vendor }}</td>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{ $product->type }}</td>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="height: 28px; width: 27px;" class="edit" data-id="{{ $product->id }}" >
                                                <path d="M13.877 3.123l3.001 3.002.5-.5a2.123 2.123 0 10-3.002-3.002l-.5.5zM15.5 7.5l-3.002-3.002-9.524 9.525L2 17.999l3.976-.974L15.5 7.5z" fill="#5C5F62"/>
                                            </svg>
                                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="height: 30px; width: 30px;" class="delete" data-id="{{ $product->id }}" >
                                                <path d="M8 3.994C8 2.893 8.895 2 10 2s2 .893 2 1.994h4c.552 0 1 .446 1 .997 0 .55-.448.997-1 .997H4c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zM5 14.508V8h2v6.508a.5.5 0 00.5.498H9V8h2v7.006h1.5a.5.5 0 00.5-.498V8h2v6.508A2.496 2.496 0 0112.5 17h-5C6.12 17 5 15.884 5 14.508z" fill="#5C5F62"/>
                                            </svg>
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

    <div style="display: none" id="editProductModal">
        <div>
            <div class="Polaris-Modal-Dialog__Container" data-polaris-layer="true" data-polaris-overlay="true">
                <div>
                    <div role="dialog" aria-modal="true" aria-labelledby="Polarismodal-header2" tabindex="-1" class="Polaris-Modal-Dialog">
                        <div class="Polaris-Modal-Dialog__Modal">
                            <div class="Polaris-Modal-Header">
                                <div id="Polarismodal-header2" class="Polaris-Modal-Header__Title">
                                    <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall"><b> Product Edit </b></h2>
                                </div>
                                <button class="Polaris-Modal-CloseButton" aria-label="Close" id="editProductModalClose">
                                    <span class="Polaris-Icon Polaris-Icon--colorBase Polaris-Icon--applyColor">
                                        <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                            <path d="m11.414 10 6.293-6.293a1 1 0 1 0-1.414-1.414L10 8.586 3.707 2.293a1 1 0 0 0-1.414 1.414L8.586 10l-6.293 6.293a1 1 0 1 0 1.414 1.414L10 11.414l6.293 6.293A.998.998 0 0 0 18 17a.999.999 0 0 0-.293-.707L11.414 10z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                            <div class="Polaris-Modal__BodyWrapper">
                                <div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                                    <section class="Polaris-Modal-Section">
                                        <div>
                                            <form id="editProduct">
                                                @csrf
                                                <div class="Polaris-FormLayout">
                                                    <div class="Polaris-FormLayout__Item">
                                                        <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField4Label" for="title" class="Polaris-Label__Text"><b> Title</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="hidden" name="id" id="id">
                                                                    <input type="hidden" name="product_id" id="product_id">
                                                                    <input type="text" id="title" name="title" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="Polaris-FormLayout__Item">
                                                        <div class="">
                                                            <div class="Polaris-Labelled__LabelWrapper">
                                                                <div class="Polaris-Label">
                                                                    <label id="PolarisTextField4Label" for="description" class="Polaris-Label__Text"><b> Description</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="Polaris-Connected">
                                                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                    <div class="Polaris-TextField">
                                                                        <input type="text" id="description" name="description" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" value="">
                                                                        <div class="Polaris-TextField__Backdrop"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="Polaris-FormLayout__Item">
                                                        <div class="">
                                                            <div class="Polaris-Labelled__LabelWrapper">
                                                                <div class="Polaris-Label">
                                                                    <label id="PolarisTextField4Label" for="vendor" class="Polaris-Label__Text"><b> Vendor</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="Polaris-Connected">
                                                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                    <div class="Polaris-TextField">
                                                                        <input type="text" id="vendor" name="vendor" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" value="">
                                                                        <div class="Polaris-TextField__Backdrop"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="Polaris-FormLayout__Item">
                                                        <div class="">
                                                            <div class="Polaris-Labelled__LabelWrapper">
                                                                <div class="Polaris-Label">
                                                                    <label id="PolarisTextField4Label" for="type" class="Polaris-Label__Text"><b> Type</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="Polaris-Connected">
                                                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                    <div class="Polaris-TextField">
                                                                        <input type="text" id="type" name="type" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" value="">
                                                                        <div class="Polaris-TextField__Backdrop"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr style="width: 620px">
                                                    <div style="margin-left: 20px; margin-top: 15px;">
                                                        <button class="Polaris-Button Polaris-Button--primary" type="submit">
                                                            <span class="Polaris-Button__Content">
                                                                <span class="Polaris-Button__Text">Submit</span>
                                                            </span>
                                                        </button>
                                                        <div id="PolarisPortalsContainer"></div>
                                                    </div>

                                                    {{-- <div class="Polaris-FormLayout__Item">
                                                        <button class="Polaris-Button" type="submit">
                                                            <span class="Polaris-Button__Content">
                                                                <span class="Polaris-Button__Text">Submit</span>
                                                            </span>
                                                        </button>
                                                    </div> --}}
                                                </div>
                                            </form>
                                            <div id="PolarisPortalsContainer"></div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Polaris-Backdrop"></div>
    </div>

@push('page_script')
    <script>
        var callForm = {!! $callForm !!}
        $('#add_product').on('click', function(event) {
            if(callForm)
            {
                app.dispatch(Redirect.toApp({ path: '/product/create' }));
            }else
            {
                $("#add_product_btn_div").hide();
                $("#upgrade_plan_link_div").show();
            }
        });

        $('#upgrade').on('click', function(event) {
            app.dispatch(Redirect.toApp({ path: '/plan/list' }));
        });

        $('#import_product').on('click', function(event) {
            $.ajax({
                url: '{{ route('product.importProducts') }}',
                type: "GET",

                success:function(response){
                    if (response == 'success')
                    {
                        const toastOptions = {
                            message: 'Start Importing...',
                            duration: 5000,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                    }
                },
            });
        });

        $('#editProductModalClose').on('click',function(event){
            $("#editProductModal").hide();
        });

        $('.edit').on('click', function(event) {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: '{{ route('product.edit') }}',
                type: 'GET',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function(response) {
                    $("#editProductModal").show();

                    $("#id").val(response.id);
                    $("#product_id").val(response.product_id);
                    $("#title").val(response.title);
                    $("#description").val(response.description);
                    $("#vendor").val(response.vendor);
                    $("#type").val(response.type);
                },
            });
        });

        $('.delete').on('click',function(event){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            if (window.confirm('Are you sure you want to delete...!'))
            {
                $.ajax({
                url: '{{ route('product.delete') }}',
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success:function(response){
                        if (response == 'success') {
                            const toastOptions = {
                                message: 'Product deleted',
                                duration: 5000,
                            };
                            const toastSuccess = Toast.create(app, toastOptions);
                            toastSuccess.dispatch(Toast.Action.SHOW);
                            location.reload();
                        }
                        else
                        {
                            const toastOptions = {
                                message: 'Opps, something went wrong...',
                                duration: 5000,
                                isError: true,
                            };
                            const toastFail = Toast.create(app, toastOptions);
                            toastFail.dispatch(Toast.Action.SHOW);
                        }
                    },
                });
            }
        });

        $('#editProduct').on('submit',function(event){
            event.preventDefault();
            var formValues = $(this).serialize();

            $.ajax({
                url: '{{ route('product.update') }}',
                type: "POST",
                data: formValues,
                // processData: false,
                // contentType: false,

                success:function(response){
                    if (response == 'success')
                    {
                        const toastOptions = {
                            message: 'Product Updated',
                            duration: 5000,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                        location.reload();
                    }
                    else
                    {
                        const toastOptions = {
                            message: 'Opps, something went wrong...',
                            duration: 5000,
                            isError: true,
                        };
                        const toastFail = Toast.create(app, toastOptions);
                        toastFail.dispatch(Toast.Action.SHOW);
                    }
                },
            });
        });
    </script>
@endpush
@include('layouts.footer')
