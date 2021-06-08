<table class="table">
    <thead>
        <tr>
            <th scope="col">@lang('Name')</th>
            <th scope="col">@lang('Stock')</th>
            <th scope="col">@lang('Price')</th>
            <th scope="col">@lang('Submited at')</th>
            <th scope="col">@lang('Total Stock')</th>
            <th scope="col">@lang('Actions')</th>
        </tr>
    </thead>

    <tbody class="target">

    </tbody>
</table>

<table class="table">
    <tbody class="">
        <tr class="example-row d-none">
            <td class="name">Mark</td>
            <td class="stock">@mdo</td>
            <td class="price">Otto</td>
            <td class="date">@mdo</td>
            <td class="total_value_number">@mdo</td>
            <td class="">
                <a href="" class="link">@lang('Edit')</a>
            </td>
        </tr>
    </tbody>
</table>

@push('js')
<script type="text/javascript">
    $(loadProducts);
    function loadProducts(){
        $.ajax({
            type: "GET",
            url: "{{ route('api.products.index') }}",
            dataType: "JSON",
            beforeSend: function(){
                $('.target').html('')
              console.log('show a loader')
            },
            statusCode : {
                200: function(response){
                    let data = response.data;

                    $.each(data, function (index, value) {
                        let element = $("tr.example-row").clone();
                        element.find('.name').html(value.name)
                        element.find('.stock').html(value.quantity)
                        element.find('.price').html(value.price)
                        element.find('.date').html(value.created_at)
                        element.find('.total_value_number').html(value.total_value_number)
                        element.find('.link').attr('href', value.links.self.web)
                        element.removeClass('d-none example-row')
                        $('.target').append(element)
                    });
                },
                401:(response) =>{

                },
                422:(response) =>{

                },
            },
            error: (response) => {

                console.log('an error')
            }
        });
    }
</script>
@endpush