<form role="form" id="create-product">
    <div class="row">

        <div class="form-group col-sm-12">
            <label for="name">@lang('Name')</label>
            <input type="text" name="name" class="form-control" required id="name" placeholder="Mouse 001">
        </div>
        <div class="form-group col-sm-6">
            <label for="price">@lang('Price')</label>
            <input type="number" step="0.01" name="price" required class="form-control" id="price" placeholder="1500">
        </div>
        <div class="form-group col-sm-6">
            <label for="stock">@lang('Stock')</label>
            <input type="number" step="1" name="stock" required class="form-control" id="stock" placeholder="1500">
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-sm btn-outline-primary save">@lang('Save')</button>
            <button type="button" class="btn btn-sm btn-outline-success d-none saved">@lang('Saved')</button>
            <button type="button" class="btn btn-sm btn-outline-warning d-none saving"><i
                    class=" fas ion-ios-loop fa-spin " aria-hidden="true"></i>@lang('Saving')</button>
            <button type="button" class="btn btn-sm btn-outline-danger d-none error">@lang('Error')</button>
        </div>
    </div>
</form>


@push('js')
<script src="{{ asset('jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('jquery-validation/additional-methods.min.js') }}"></script>


@endpush

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
      $.validator.setDefaults({
        submitHandler: saveProduct
      });

      $('#create-product').validate({
        rules: {
            name:{
                required:true,
                minlength:2
            },

            price:{
                required:true,
                min:0
            },

        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });

    function saveProduct(){



        let data = $('form#create-product').serializeArray();

        $.ajax({
            method:'POST',
            url: "{{ URL::route('api.products.store') }}",
            data: data,
            beforeSend: function(){
              $('form#create-product button.save').addClass('d-none');
              $('form#create-product button.saved').addClass('d-none');
              $('form#create-product button.error').addClass('d-none');
              $('form#create-product button.saving').removeClass('d-none');
            },
            statusCode : {
                201: function(response){

                  $('form#create-product button.save').addClass('d-none');
                  $('form#create-product button.saved').removeClass('d-none');
                  $('form#create-product button.saving').addClass('d-none');
                  $('form#create-product button.error').addClass('d-none');

                  loadProducts()

              setTimeout(() => {
                $('form#create-product button.save').removeClass('d-none');
                $('form#create-product button.saved').addClass('d-none');
                $('form#create-product button.saving').addClass('d-none');
                $('form#create-product button.error').addClass('d-none');
              }, 2000)


                },
                401:(response) =>{

                },
                422:(response) =>{

                },
            },
            error: (response) => {
              $('form#create-product button.save').addClass('d-none');
              $('form#create-product button.saved').addClass('d-none');
              $('form#create-product button.saving').addClass('d-none');
              $('form#create-product button.error').removeClass('d-none');
              setTimeout(() => {
                $('form#create-product button.save').removeClass('d-none');
                $('form#create-product button.saved').addClass('d-none');
                $('form#create-product button.saving').addClass('d-none');
                $('form#create-product button.error').addClass('d-none');
              }, 2000)
            }
        });
    }
</script>
@endpush