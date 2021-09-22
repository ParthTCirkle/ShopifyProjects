@section('title','Installation')
@include('layouts.header')
    <div>
        <button class="Polaris-Button" type="button" id="create">
            <span class="Polaris-Button__Content">
                <span class="Polaris-Button__Text">Create</span>
            </span>
        </button>
        <div id="PolarisPortalsContainer"></div>
    </div>

    <div id="scriptInstallationModal">
        <div>
            <div class="Polaris-Modal-Dialog__Container" data-polaris-layer="true" data-polaris-overlay="true">
            <div>
                <div role="dialog" aria-modal="true" aria-labelledby="Polarismodal-header2" tabindex="-1" class="Polaris-Modal-Dialog">
                    <div class="Polaris-Modal-Dialog__Modal">
                        <div class="Polaris-Modal-Header">
                            <div id="Polarismodal-header2" class="Polaris-Modal-Header__Title">
                                <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Installation</h2>
                            </div>
                            <button class="Polaris-Modal-CloseButton" aria-label="Close" id="modalClose">
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
                                        <div class="">
                                            <div class="Polaris-Select">
                                                <select id="themesDropDown" class="Polaris-Select__Input" aria-invalid="false">
                                                    <option value="">Select Theme</option>
                                                    @foreach ($themes as $theme)
                                                    <option value="{{ $theme['id'] }}">{{ $theme['name'] }},{{ $theme['role'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="Polaris-Select__Content" aria-hidden="true">
                                                    <span class="Polaris-Select__SelectedOption" id="title">Select Theme</span>
                                                </div>
                                                <div class="Polaris-Select__Backdrop"></div>
                                            </div>
                                        </div>
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
        $('#create').on('click', function(event) {
            $("#scriptInstallationModal").show();
        });

        $('#modalClose').on('click',function(event){
            $("#scriptInstallationModal").hide();
        });

        $(document).on('change','#themesDropDown',function (e) {
            var tr = $(this).closest('div');
            $(tr).find('#title').html($('option:selected', this).text());

            var themeid = $(this).val();
            // console.log(themeid);
            $.ajax({
                url: '{{ route('script.create') }}',
                type: "POST",
                data: {
                        id:themeid
                    },

                success:function(response){
                    // console.log(response);
                    if (response == 'success')
                    {
                        const toastOptions = {
                            message: 'Installation complete...',
                            duration: 5000,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                    }
                    else if(response == 'contains')
                    {
                        const toastOptions = {
                            message: 'Your theme updated successfully...',
                            duration: 5000,
                            // isError: true,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                    }
                    else
                    {
                        const toastOptions = {
                            message: 'Oops, something went wrong...',
                            duration: 5000,
                            isError: true,
                        };
                        const toastSuccess = Toast.create(app, toastOptions);
                        toastSuccess.dispatch(Toast.Action.SHOW);
                    }
                },
            });

        });
    </script>
@endpush
@include('layouts.footer')
