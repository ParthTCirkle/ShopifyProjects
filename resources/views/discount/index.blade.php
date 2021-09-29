@extends('layout.master_layout')
@section('title','Discount Index')
@section('content')
    {{-- <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">Welcome to Discount Index</h2>
                    </div>
                    <div class="Polaris-Card__Section">
                        <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div> --}}

    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__AnnotatedSection">
                <div class="Polaris-Layout__AnnotationWrapper">
                    <div class="Polaris-Layout__Annotation">
                        <div class="Polaris-TextContainer">
                            <h2 class="Polaris-Heading">Discount Condition Type</h2>
                            <div class="Polaris-Layout__AnnotationDescription">
                                {{-- <p>Shopify and your customers will use this information to contact you.</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="Polaris-Layout__AnnotationContent">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h2 class="Polaris-Heading">Get Filtered Product</h2>
                            </div>
                            <div class="Polaris-Card__Section">

                                <div>
                                    <div class="Polaris-Stack Polaris-Stack--vertical">
                                        <div class="Polaris-Stack__Item">
                                            <div>
                                                <label class="Polaris-Choice" for="anyCondition">
                                                    <span class="Polaris-Choice__Control">
                                                        <span class="Polaris-RadioButton">
                                                            <input id="anyCondition" name="condition" type="radio" class="Polaris-RadioButton__Input" aria-describedby="disabledHelpText" value="OR">
                                                            <span class="Polaris-RadioButton__Backdrop"></span>
                                                        </span>
                                                    </span>
                                                    <span class="Polaris-Choice__Label">Any Condition</span>
                                                </label>

                                            </div>
                                        </div>
                                        <div class="Polaris-Stack__Item">
                                            <div>
                                                <label class="Polaris-Choice" for="allCondition">
                                                    <span class="Polaris-Choice__Control">
                                                        <span class="Polaris-RadioButton">
                                                            <input id="allCondition" name="condition" type="radio" class="Polaris-RadioButton__Input" aria-describedby="optionalHelpText" value="AND">
                                                            <span class="Polaris-RadioButton__Backdrop"></span>
                                                        </span>
                                                    </span>
                                                    <span class="Polaris-Choice__Label">All Condition</span>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="PolarisPortalsContainer"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>

    <br>

    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__AnnotatedSection">
                <div class="Polaris-Layout__AnnotationWrapper">
                <div class="Polaris-Layout__Annotation">
                    <div class="Polaris-TextContainer">
                    <h2 class="Polaris-Heading">Discount Condition</h2>
                    <div class="Polaris-Layout__AnnotationDescription">
                        {{-- <p>Shopify and your customers will use this information to contact you.</p> --}}
                    </div>
                    </div>
                </div>
                <div class="Polaris-Layout__AnnotationContent">
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Section">

                            <div>
                                <div class="Polaris-Page">
                                    <div class="Polaris-Page-Header Polaris-Page-Header--isSingleRow Polaris-Page-Header--mobileView Polaris-Page-Header--noBreadcrumbs Polaris-Page-Header--mediumTitle">
                                    <div class="Polaris-Page-Header__Row">
                                        <div class="Polaris-Page-Header__TitleWrapper">
                                        <div>
                                            <div class="Polaris-Header-Title__TitleAndSubtitleWrapper">
                                            <h1 class="Polaris-Header-Title" id="conditionTypeLable">Condition</h1>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="Polaris-Page__Content">
                                    <div class="Polaris-Card">
                                        <div class="">
                                        <div class="Polaris-DataTable__Navigation"><button class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table left one column" type="button" disabled=""><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                    <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16z"></path>
                                                    </svg></span></span></span></button><button class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column" type="button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                    <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16z"></path>
                                                    </svg></span></span></span></button></div>
                                        <div class="Polaris-DataTable">
                                            <div class="Polaris-DataTable__ScrollContainer">
                                            <table class="Polaris-DataTable__Table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Condition Type</th>
                                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Search</th>
                                                        <th></th>
                                                    </tr>

                                                </thead>
                                                <tbody id="discountConditionTable">
                                                    <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable 1" id="1">
                                                        <td></td>
                                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                            <div>
                                                                <div class="">
                                                                    <div class="Polaris-Select">
                                                                        <select id="type1" class="Polaris-Select__Input conditionType">
                                                                            <option value="">Select Condition Type</option>
                                                                            <option value="vendor">Product Vendor</option>
                                                                            <option value="product_type">Product Type</option>
                                                                            <option value="tags">Product Tag</option>
                                                                        </select>
                                                                        {{-- Product Vender:Florabelle123 OR Product Type : Accessories_Artificial Plants OR 456654645 --}}
                                                                        <div class="Polaris-Select__Content" aria-hidden="true">
                                                                            <span class="Polaris-Select__SelectedOption title">Select Condition Type</span>
                                                                            <span class="Polaris-Select__Icon">
                                                                                <span class="Polaris-Icon">
                                                                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                                        <path d="m10 16-4-4h8l-4 4zm0-12 4 4H6l4-4z"></path>
                                                                                    </svg>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="Polaris-Select__Backdrop"></div>
                                                                    </div>
                                                                </div>
                                                                <div id="PolarisPortalsContainer"></div>
                                                            </div>
                                                        </td>

                                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                                            <div>
                                                                <div class="">
                                                                    <div class="Polaris-Connected">
                                                                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                        <div class="Polaris-TextField Polaris-TextField--hasValue">
                                                                            <input id="search1" class="Polaris-TextField__Input search" aria-labelledby="PolarisTextField2Label" aria-invalid="false">
                                                                            <div class="Polaris-TextField__Backdrop"></div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="PolarisPortalsContainer"></div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div id="PolarisPortalsContainer"></div>
                            </div>

                            <div>
                                <button class="Polaris-Button Polaris-Button--primary" type="button" style="float: right" id="getProduct">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text">Get Product</span>
                                    </span>
                                </button>
                                <div id="PolarisPortalsContainer"></div>
                            </div>

                            <button class="Polaris-Button" type="button" id="addDiscountCondition">
                                <span class="Polaris-Button__Content">
                                    <span class="Polaris-Button__Text">Add Condition</span>
                                </span>
                            </button>
                            <div id="PolarisPortalsContainer"></div>
                        </div>
                    </div>
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

        const breadcrumb = Button.create(app, { label: 'Product' });
        breadcrumb.subscribe(Button.Action.CLICK, () => {
            app.dispatch(Redirect.toApp({ path: '/product/create' }));
        });


        var titleBarOptions = {
            title: 'Discount',
            // breadcrumbs: breadcrumb,
            buttons: {
                // primary:
                secondary: [],
            },
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);

    </script>
    <script>
        $(document).ready(function () {
            $("#anyCondition").click(function(){
                $("#conditionTypeLable").html("Any Condition");
            });

            $("#allCondition").click(function(){
                $("#conditionTypeLable").html("All Condition");
            });

            $('input[name="condition"]').change(function (e) {
                e.preventDefault();
                var discount_type = $('input[name="condition"]:checked').val();
                // console.log(discount_type);
                $(".prefix").html(discount_type);
            });

            var i = 1;
            var counter = 0;
            $("#addDiscountCondition").click(function(){
                $( "#discountConditionTable tr" ).each(function( i,el )
                {
                    if ($( el ).find(".conditionType").val() == null || $( el ).find(".search").val() == "")
                    {

                        var toastOptions = {
                            message: 'Select condition type/provide search content...',
                            duration: 5000,
                            isError: true,
                        };
                        var toastError = Toast.create(app, toastOptions);
                        toastError.dispatch(Toast.Action.SHOW);
                        // toastr.error("Select condition type/provide search content...");
                        counter = 0;
                        return false;
                    }
                    else
                    {
                        counter = 1;
                    }
                });
                if (counter == 1) {
                    var checked = $('input[name="condition"]:checked').val();
                    i++;
                    var itemRow =
                    '<tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable '+i+'" id="'+i+'">' +
                        '<td class="prefix"> '+checked+' </td>' +
                        '<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"> <div> <div class=""> <div class="Polaris-Select"> <select id="type'+i+'" class="Polaris-Select__Input conditionType"> <option value="">Select Condition Type</option> <option value="vendor">Product Vendor</option> <option value="product_type">Product Type</option> <option value="tags">Product Tag</option></select> <div class="Polaris-Select__Content" aria-hidden="true"> <span class="Polaris-Select__SelectedOption title">Select Condition Type</span> <span class="Polaris-Select__Icon"> <span class="Polaris-Icon"> <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"> <path d="m10 16-4-4h8l-4 4zm0-12 4 4H6l4-4z"></path> </svg> </span> </span> </div> <div class="Polaris-Select__Backdrop"></div> </div> </div> <div id="PolarisPortalsContainer"></div> </div></td>' +
                        '<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"> <div> <div class=""> <div class="Polaris-Connected"> <div class="Polaris-Connected__Item Polaris-Connected__Item--primary"> <div class="Polaris-TextField Polaris-TextField--hasValue"> <input id="search'+i+'" class="Polaris-TextField__Input search" aria-labelledby="PolarisTextField2Label" aria-invalid="false"> <div class="Polaris-TextField__Backdrop"></div> </div> </div> </div> </div> <div id="PolarisPortalsContainer"></div> </div> </td>' +
                        '<td> <div><button class="Polaris-Button Polaris-Button--destructive Polaris-Button--plain" type="button" onclick="deleteRow('+i+')"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Remove</span></span></button> <div id="PolarisPortalsContainer"></div> </div></td>' +
                    '</tr>';
                    $("#discountConditionTable").append(itemRow);
                }
            });

            $("#getProduct").click(function(){
                var checked = $('input[name="condition"]:checked').val();
                var string = "";
                $( "#discountConditionTable tr" ).each(function( i,el )
                {
                    string += $( el ).find(".conditionType").val() +':'+ $( el ).find(".search").val()+' '+ checked + ' ';
                });
                var lastIndex = string.lastIndexOf(" "+checked);
                string = string.substring(0, lastIndex);
                // console.log(string);

                var productPicker = ResourcePicker.create(app, {
                    resourceType: ResourcePicker.ResourceType.Product,
                    options: {
                        selectMultiple: true,
                        initialQuery: string
                    }
                });

                productPicker.dispatch(ResourcePicker.Action.OPEN);
            });
        });

        function deleteRow(id) {
            $("#"+id).remove();
        }

        $(document).on('change','.conditionType',function (e) {
            var checked = $('input[name="condition"]:checked').val();
            if (checked == undefined) {
                var toastOptions = {
                            message: 'Select Discount condition type first...',
                            duration: 5000,
                            isError: true,
                        };
                var toastError = Toast.create(app, toastOptions);
                toastError.dispatch(Toast.Action.SHOW);
            }

            var tr = $(this).closest('tr');
            $(tr).find('.title').html($('option:selected', this).text());

        });
    </script>
@endpush
@endsection


