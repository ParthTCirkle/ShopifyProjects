@section('title','Customer')
@include('layouts.header')

@push('page_script')
    <script>
        // const collectionPicker = ResourcePicker.create(app, {
        //     resourceType: ResourcePicker.ResourceType.Collection,
        //     options: {
        //         selectMultiple: true
        //     }
        // });

        // // Open the collection picker
        // collectionPicker.dispatch(ResourcePicker.Action.OPEN);

        //-----------------------------------------------------------------------------------------------------------------------------------

        var productWithSpecificVariantsSelected = {
            // id: 'gid://shopify/Product/5463452778649',
            variants: [{
                id: 'gid://shopify/ProductVariant/40056491114649'
            },
            {
                id: 'gid://shopify/ProductVariant/40056490983577'
            },
            {
                id: 'gid://shopify/ProductVariant/40056491016345'
            },
            {
                id: 'gid://shopify/ProductVariant/40056491049113'
            },],
        };

        // var productWithAllVariantsSelected = {
        //     id: 'gid://shopify/Product/5463452778649',
        // };

        var productPicker = ResourcePicker.create(app, {
            resourceType: ResourcePicker.ResourceType.Product,
            options: {
                initialSelectionIds: [productWithSpecificVariantsSelected],
                selectMultiple: true
            }
        });

        const selectUnsubscribe = productPicker.subscribe(ResourcePicker.Action.SELECT, ({selection}) => {
            console.log(selection);

        });

        // Open the product picker
        productPicker.dispatch(ResourcePicker.Action.OPEN);

        //-----------------------------------------------------------------------------------------------------------------------------------

        // const productVariantPicker = ResourcePicker.create(app, {
        //     resourceType: ResourcePicker.ResourceType.ProductVariant,
        //     options: {
        //         selectMultiple: true
        //     }
        // });

        // // Open the product variant picker
        // productVariantPicker.dispatch(ResourcePicker.Action.OPEN);

    </script>
@endpush
@include('layouts.footer')
