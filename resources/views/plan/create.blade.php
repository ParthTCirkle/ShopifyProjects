@section('title','Plan Create')
@include('layouts.header')
    <div>
        <div class="Polaris-Layout">
            <div class="Polaris-Layout__Section">
                <div class="Polaris-Card">
                    <div class="Polaris-Card__Header">
                    </div>
                    <div class="Polaris-Card__Section">
                        <div>
                            <form id="createPlanForm" enctype="multipart/form-data">
                                @csrf
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
                                                <div class="Polaris-Label"><label id="PolarisTextField8Label" for="capped_amout" class="Polaris-Label__Text"><strong> Plan Capped Aamout : </strong></label></div>
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
                                                <div class="Polaris-Label"><label id="PolarisTextField8Label" for="terms" class="Polaris-Label__Text"><strong> Terms : </strong></label></div>
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
                    </div>
                </div>
            </div>
        </div>
        <div id="PolarisPortalsContainer"></div>
    </div>

@push('page_script')
    <script>
        $('#createPlanForm').on('submit',function(event){
            event.preventDefault();
            var formValues = $(this).serialize();
            // console.log(formValues);
            $.ajax({
                url: '{{ route('plan.store') }}',
                type:"POST",
                data: formValues,

                success:function(response){
                    if (response == 'success')
                    {
                        const toastOptions = {
                            message: 'Plan Created Successfully',
                            duration: 5000,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                        app.dispatch(Redirect.toApp({ path: '/plan/list' }));
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
