@extends('products.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List') }}</div>

                <div class="card-body">
                    @include('products.comps.table')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 