@section('title','Plan List')
@include('layouts.header')
    <div style="display: none" id="redirect_product_list">
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                        <h2 class="Polaris-Heading">You are down grading your plan so please manage your products as per your plan discription...</h2>
                    </div>
                    <div class="Polaris-Card__Section">
                        <p>
                            <div>
                                <div>
                                    <button class="Polaris-Button Polaris-Button--plain Polaris-Button--monochrome" type="button" id="redirect_product_list_btn">
                                        <span class="Polaris-Button__Content">
                                            <span class="Polaris-Button__Text">Click me to move on product list page</span>
                                        </span>
                                    </button>
                                </div>
                                <div id="PolarisPortalsContainer"></div>
                            </div>
                        </p>
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
                                <h2 class="Polaris-Heading">{{$plan->plan_name}}</h2>
                            </div>
                            <div class="Polaris-Stack__Item">
                                <div class="Polaris-ButtonGroup">
                                    @if ($plan->primary)
                                        <div>
                                            <span class="Polaris-Badge Polaris-Badge--statusSuccess Polaris-Badge--progressComplete">
                                                <span class="Polaris-Badge__Pip">
                                                </span>Most Popular
                                            </span>
                                            <div id="PolarisPortalsContainer"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Polaris-Card__Section">
                        <span class="Polaris-TextStyle--variationSubdued">Plan Price : <b> {{$plan->price}}$ </b></span><br>
                        <span class="Polaris-TextStyle--variationSubdued">Plan Type : <b> {{( $plan->test ) ? ( $plan->id > 1 ) ? "Paid Plan" : "Free Plan" : $plan->test."Paid Plan"}} </b></span><br>
                        <span class="Polaris-TextStyle--variationSubdued">Plan Discription : <b> {{ $plan->description }} </b></span>
                    </div>
                    <div class="Polaris-Card__Section">
                        <div class="Polaris-Card__SectionHeader">
                            <div>
                                <button class="Polaris-Button Polaris-Button--primary subscribe {{($charge) ? ($charge->plan_id == $plan->id) ? "Polaris-Button--disabled" : "" : ""}}" type="button" id="{{$plan->id}}">
                                    <span class="Polaris-Button__Content">
                                        <span class="Polaris-Button__Text">{{($charge) ? ($charge->plan_id == $plan->id) ? "Active" : "Subscribe" : "Subscribe"}}</span>
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

    <br>
    @if ($shop->shop_domain == "app-store-dev.myshopify.com")
    <div>
        <button class="Polaris-Button Polaris-Button--primary" type="button" name="createPlan" id="createPlan">
            <span class="Polaris-Button__Content">
                <span class="Polaris-Button__Text">New Plan</span>
            </span>
        </button>
        <div id="PolarisPortalsContainer"></div>
    </div>

    <div>
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
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col"><strong> # </strong></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col"><strong> Plan Name </strong></th>
                                        {{-- <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Primary </strong></th> --}}
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col"><strong> Plan Description </strong></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Plan Price </strong></th>
                                        {{-- <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Test </strong></th> --}}
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Trial Days </strong></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Capped Amount </strong></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Terms </strong></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Total Installed </strong></th>
                                        <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col"><strong> Action </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach ($plans as $plan)
                                    @php
                                        $count = $plan->charges->count();
                                        $index++;
                                    @endphp

                                    <tr class="Polaris-DataTable__TableRow Polaris-DataTable--hoverable">
                                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{{$index}}</th>
                                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{{$plan->plan_name}}</th>
                                        {{-- <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                            @if ($plan->primary)
                                            <div>
                                                <label class="Polaris-Choice" for="primary{{$plan->id}}">
                                                    <span class="Polaris-Choice__Control">
                                                        <span class="Polaris-Checkbox">
                                                            <input id="primary{{$plan->id}}" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" checked value="">
                                                            <span class="Polaris-Checkbox__Backdrop"></span>
                                                            <span class="Polaris-Checkbox__Icon">
                                                                <span class="Polaris-Icon">
                                                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                        <path d="m8.315 13.859-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </label>
                                                <div id="PolarisPortalsContainer"></div>
                                            </div>
                                            @endif
                                        </td> --}}
                                        <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">{{$plan->description}}</th>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$plan->price}}</td>
                                        {{-- <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                            @if ($plan->test)
                                            <div>
                                                <label class="Polaris-Choice" for="test{{$plan->id}}">
                                                    <span class="Polaris-Choice__Control">
                                                        <span class="Polaris-Checkbox">
                                                            <input id="test{{$plan->id}}" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" checked value="">
                                                            <span class="Polaris-Checkbox__Backdrop"></span>
                                                            <span class="Polaris-Checkbox__Icon">
                                                                <span class="Polaris-Icon">
                                                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                        <path d="m8.315 13.859-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </label>
                                                <div id="PolarisPortalsContainer"></div>
                                            </div>
                                            @endif
                                        </td> --}}
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$plan->trial_days}}</td>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$plan->capped_amout}}</td>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$plan->terms}}</td>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">{{$count}}</td>
                                        <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="height: 28px; width: 27px;" class="editPlan" data-id="{{ $plan->id }}" ><path d="M13.877 3.123l3.001 3.002.5-.5a2.123 2.123 0 10-3.002-3.002l-.5.5zM15.5 7.5l-3.002-3.002-9.524 9.525L2 17.999l3.976-.974L15.5 7.5z" fill="#5C5F62"/></svg>
                                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" style="height: 30px; width: 30px;" class="deletePlan" data-id="{{ $plan->id }}" ><path d="M8 3.994C8 2.893 8.895 2 10 2s2 .893 2 1.994h4c.552 0 1 .446 1 .997 0 .55-.448.997-1 .997H4c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zM5 14.508V8h2v6.508a.5.5 0 00.5.498H9V8h2v7.006h1.5a.5.5 0 00.5-.498V8h2v6.508A2.496 2.496 0 0112.5 17h-5C6.12 17 5 15.884 5 14.508z" fill="#5C5F62"/></svg>
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
    @endif

    <div style="display: none" id="editPlanModal">
        <div>
            <div class="Polaris-Modal-Dialog__Container" data-polaris-layer="true" data-polaris-overlay="true">
            <div>
                <div role="dialog" aria-modal="true" aria-labelledby="Polarismodal-header2" tabindex="-1" class="Polaris-Modal-Dialog">
                    <div class="Polaris-Modal-Dialog__Modal">
                        <div class="Polaris-Modal-Header">
                            <div id="Polarismodal-header2" class="Polaris-Modal-Header__Title">
                                <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall"><b> Plan Edit </b></h2>
                            </div>
                            <button class="Polaris-Modal-CloseButton" aria-label="Close" id="editPlanModalClose">
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
                                        <form id="editPlanForm">
                                            @csrf
                                            <input type="hidden" name="id" id="id">
                                            <div class="Polaris-FormLayout">
                                                <div class="Polaris-FormLayout__Item">
                                                    <div>
                                                        <label class="Polaris-Choice" for="primary">
                                                            <span class="Polaris-Choice__Control">
                                                                <span class="Polaris-Checkbox">
                                                                    <input id="primary" name="primary" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="true">
                                                                    <span class="Polaris-Checkbox__Backdrop"></span>
                                                                    <span class="Polaris-Checkbox__Icon">
                                                                        <span class="Polaris-Icon">
                                                                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                                <path d="m8.315 13.859-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                            <span class="Polaris-Choice__Label"><strong> Primary plan </strong></span>
                                                        </label>
                                                        <div id="PolarisPortalsContainer"></div>
                                                    </div>

                                                    <br>

                                                    <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField8Label" for="plan_name" class="Polaris-Label__Text"><strong>Plan Name :</strong></label></div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="text" id="plan_name" name="plan_name" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField8Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField8Label" for="price" class="Polaris-Label__Text"><strong> Plan Price : </strong></label></div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="text" id="price" name="price" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField8Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField8Label" for="trial_days" class="Polaris-Label__Text"><strong> Trial Days : </strong></label></div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="text" id="trial_days" name="trial_days" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField8Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div>
                                                        <label class="Polaris-Choice" for="test">
                                                            <span class="Polaris-Choice__Control">
                                                                <span class="Polaris-Checkbox">
                                                                    <input id="test" name="test" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="true">
                                                                    <span class="Polaris-Checkbox__Backdrop"></span>
                                                                    <span class="Polaris-Checkbox__Icon">
                                                                        <span class="Polaris-Icon">
                                                                            <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                                                                <path d="m8.315 13.859-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                            <span class="Polaris-Choice__Label"><strong> Test plan </strong></span>
                                                        </label>
                                                        <div id="PolarisPortalsContainer"></div>
                                                    </div>

                                                    <br>
                                                    <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField8Label" for="capped_amout" class="Polaris-Label__Text"><strong> Plan Capped Aamout : </strong></label></div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="text" id="capped_amout" name="capped_amout" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField8Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField8Label" for="terms" class="Polaris-Label__Text"><strong> Terms : </strong></label></div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="text" id="terms" name="terms" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField8Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>
                                                    <div class="">
                                                        <div class="Polaris-Labelled__LabelWrapper">
                                                            <div class="Polaris-Label">
                                                                <label id="PolarisTextField8Label" for="description" class="Polaris-Label__Text"><strong> Description : </strong></label></div>
                                                        </div>
                                                        <div class="Polaris-Connected">
                                                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                                <div class="Polaris-TextField">
                                                                    <input type="text" id="description" name="description" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField8Label" aria-invalid="false" value="">
                                                                    <div class="Polaris-TextField__Backdrop"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                                <hr>
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
        $('.subscribe').on('click',function(event){
            var id = $(this).attr("id");
            $.ajax({
                url: '{{ route('charge.create') }}',
                type: "POST",
                data: {
                        id:id
                    },
                success:function(response){
                    // console.log(response);
                    if (response == "product list")
                    {
                        $("#redirect_product_list").show();
                    }
                    else
                    {
                        window.top.location.href = response;
                    }
                },
            });
        });

        $('#createPlan').on('click',function(event){
            app.dispatch(Redirect.toApp({ path: '/plan/create' }));
            // window.top.location.href = "{{ route('plan.create',['shop_id' => $shop->id]) }}";
        });

        $('#redirect_product_list_btn').on('click',function(event){
            app.dispatch(Redirect.toApp({ path: '/product/list' }));
        });

        $('#editPlanModalClose').on('click',function(event){
            $("#editPlanModal").hide();
        });

        $('.editPlan').on('click', function(event) {
            var planid = $(this).data("id");
            $.ajax({
                url: '{{ route('plan.edit') }}',
                type: 'GET',
                data: {
                    "id": planid,
                },
                success: function(response) {
                    $("#editPlanModal").show();

                    $("#id").val(response.id);
                    $("#primary" ).prop( "checked", response.primary);
                    $("#plan_name").val(response.plan_name);
                    $("#price").val(response.price);
                    $("#trial_days").val(response.trial_days);
                    $( "#test" ).prop( "checked", response.test);
                    $("#capped_amout").val(response.capped_amout);
                    $("#terms").val(response.terms);
                    $("#description").val(response.description);
                },
            });
        });

        $('.deletePlan').on('click',function(event){
            var planid = $(this).data("id");

            if (window.confirm('Are you sure you want to delete...!'))
            {
                $.ajax({
                url: '{{ route('plan.delete') }}',
                    type: 'DELETE',
                    data: {
                        "id": planid,
                    },
                    success:function(response){
                        if (response == 'success')
                        {
                            const toastOptions = {
                                message: 'Plan deleted...',
                                duration: 5000,
                            };
                            const toastSuccess = Toast.create(app, toastOptions);
                            toastSuccess.dispatch(Toast.Action.SHOW);
                            location.reload();
                        }
                        else
                        {
                            const toastOptions = {
                                message: 'This, plan is subscribe by user...',
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

        $('#editPlanForm').on('submit',function(event){
            event.preventDefault();
            var formValues = $(this).serialize();

            $.ajax({
                url: '{{ route('plan.update') }}',
                type: "POST",
                data: formValues,

                success:function(response){
                    if (response == 'success')
                    {
                        const toastOptions = {
                            message: 'Plan Updated',
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
