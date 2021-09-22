        </div>
    <script src="https://unpkg.com/@shopify/app-bridge@2"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $("meta[name='csrf-token']").attr("content"),
                "Authorization" : "Bearer {{ Crypt::encrypt( $shop->token ) }}",
                "shop" : "{{ $shop->shop_domain }}"
            }
        });

        let shop = {!! $shop !!};
        let currentAppVersion = {!! config('constant.app_version') !!}
        let charge = {!! $charge !!};

        var AppBridge = window['app-bridge'];
        var actions = window['app-bridge'].actions;
        var createApp = AppBridge.default;
        var app = createApp({
            apiKey: "{{ config('constant.shopify_api_key') }}",
            host: "{{base64_encode($shop->domain.'/admin')}}",
        });

        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var ButtonGroup = actions.ButtonGroup;
        var Redirect = actions.Redirect;
        var Toast = actions.Toast;
        var NavigationMenu = actions.NavigationMenu;
        var AppLink = actions.AppLink;
        var ResourcePicker = actions.ResourcePicker;
        var Modal = actions.Modal;

        if (shop.app_version < currentAppVersion)
        {
            app.dispatch(Redirect.toApp({ path: '/install' }));
        }


        function offer(){
            if (charge == 0)
            {
                app.dispatch(Redirect.toApp({ path: '/plan/list' }));
            }
        }

        var back = Button.create(app, {label: 'Home'});
        back.subscribe(Button.Action.CLICK, function() {
            app.dispatch(Redirect.toApp({ path: '/' }));
        });

        var product = Button.create(app, {label: 'Product'});
        product.subscribe(Button.Action.CLICK, function() {
            offer();
            app.dispatch(Redirect.toApp({ path: '/product/list' }));
        });

        var customer = Button.create(app, {label: 'Customer'});
        customer.subscribe(Button.Action.CLICK, function() {
            offer();
            app.dispatch(Redirect.toApp({ path: '/customer/view' }));
        });

        var discount = Button.create(app, {label: 'Discount'});
        discount.subscribe(Button.Action.CLICK, function() {
            offer();
            if(charge.name == "Basic Plan")
            {
                app.dispatch(Redirect.toApp({ path: '/plan/list' }));
            }
            app.dispatch(Redirect.toApp({ path: '/discount/view' }));
        });

        var installation = Button.create(app, {label: 'Installation'});
        installation.subscribe(Button.Action.CLICK, function() {
            offer();
            if(charge.name != "Premium Plan")
            {
                app.dispatch(Redirect.toApp({ path: '/plan/list' }));
            }
            app.dispatch(Redirect.toApp({ path: '/script/list' }));
        });

        var newAsset = Button.create(app, {label: 'New Asset'});
        newAsset.subscribe(Button.Action.CLICK, function() {
            offer();
            if(charge.name != "Premium Plan")
            {
                app.dispatch(Redirect.toApp({ path: '/plan/list' }));
            }
            app.dispatch(Redirect.toApp({ path: '/asset/index' }));
        });

        var plan = Button.create(app, {label: 'Offer/Plan'});
        plan.subscribe(Button.Action.CLICK, function() {
            app.dispatch(Redirect.toApp({ path: '/plan/list' }));
        });

        var titleBarOptions = {
            title: 'Product Page',
            buttons: {
                primary: back,
                secondary : [plan, product, customer, discount, installation, newAsset],
            },
        };

        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
    @stack('page_script')
</body>
</html>
