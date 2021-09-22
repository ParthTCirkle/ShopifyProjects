@section('title','Product Create')
@include('layouts.header')
    @if ($callForm)
        <div>
            <div class="Polaris-Layout">
                <div class="Polaris-Layout__Section">
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Section">
                                <div>
                                    <form id="createProduct">
                                        @csrf
                                        <div class="Polaris-FormLayout">
                                            <div class="Polaris-FormLayout__Item">
                                                <div class="">
                                                    <div class="Polaris-Connected">
                                                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                            <div class="Polaris-TextField">
                                                                <input type="text" id="title" name="title" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" placeholder="Title" value="">
                                                            <div class="Polaris-TextField__Backdrop"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="Polaris-FormLayout__Item">
                                                <div class="">
                                                    <div class="Polaris-Connected">
                                                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                            <div class="Polaris-TextField">
                                                                <input type="text" id="description" name="description" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" placeholder="Description" value="">
                                                            <div class="Polaris-TextField__Backdrop"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="Polaris-FormLayout__Item">
                                                <div class="">
                                                    <div class="Polaris-Connected">
                                                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                            <div class="Polaris-TextField">
                                                                <input type="text" id="vendor" name="vendor" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" placeholder="Vendor" value="">
                                                            <div class="Polaris-TextField__Backdrop"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="Polaris-FormLayout__Item">
                                                <div class="">
                                                    <div class="Polaris-Connected">
                                                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                                            <div class="Polaris-TextField">
                                                                <input type="text" id="type" name="type" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField4Label" aria-invalid="false" placeholder="Type" value="">
                                                            <div class="Polaris-TextField__Backdrop"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="Polaris-FormLayout__Item">
                                                <button class="Polaris-Button" type="submit">
                                                    <span class="Polaris-Button__Content">
                                                        <span class="Polaris-Button__Text">Submit</span>
                                                    </span>
                                                </button>
                                            </div>
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
    @else
        <div>
            <div class="Polaris-Layout">
                <div class="Polaris-Layout__Section">
                    <div class="Polaris-Card">
                        <div class="Polaris-Card__Header">
                            <div>
                                <p class="Polaris-DisplayText Polaris-DisplayText--sizeLarge">You exceed your limit of creating products as per your plan</p>
                                <div id="PolarisPortalsContainer"></div>
                            </div>
                        </div>
                        <div class="Polaris-Card__Section">
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
                    </div>
                </div>
            </div>
            <div id="PolarisPortalsContainer"></div>
        </div>
    @endif

@push('page_script')
    <script>
        // var itemsLink = AppLink.create(app, {
        //     label: 'Add Product',
        //     destination: '/product/create',
        // });

        // var navigationMenu = NavigationMenu.create(app, {
        //     items: [itemsLink],
        //     active: itemsLink,
        // });

        $('#upgrade').on('click',function(event){
            app.dispatch(Redirect.toApp({ path: '/plan/list' }));
        });

        $('#createProduct').on('submit',function(event){
            event.preventDefault();
            var formValues = $(this).serialize();

            $.ajax({
                url: '{{ route('product.store') }}',
                type:"POST",
                data: formValues,

                success:function(response){
                    if (response == 'success')
                    {
                        const toastOptions = {
                            message: 'Product saved',
                            duration: 5000,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                        app.dispatch(Redirect.toApp({ path: '/product/list' }));
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
