@extends('products.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                    <table class="table">
                        <tbody class="">
                            <tr>
                                <td scope="col">
                                    <b>
                                        @lang('Name')
                                    </b>
                                </td>

                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td scope="col">
                                    <b>
                                        @lang('Price')
                                    </b>
                                </td>

                                <td>{{ $product->price }}</td>
                            </tr>
                            <tr>
                                <td scope="col">
                                    <b>
                                        @lang('Current Stock')
                                    </b>
                                </td>

                                <td>{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <td scope="col">
                                    <b>
                                        @lang('Submited At')
                                    </b>
                                </td>

                                <td>{{ $product->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                    @include('products.comps.form-edit')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection