@extends('layout')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            Admin pagina

            <a class="btn btn-primary" href="{{ url('dashboard') }}">Back</a>

            Create product form

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('dashboard/product-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Naam</strong>
                        <label for="name"></label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Prijs</strong>
                        <label for="price"></label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                            <input type="text" id="price" name="price" class="form-control"
                                   value="{{ old('price') }}">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="description">
                            <strong>Beschrijving</strong>
                        </label>
                        <textarea class="form-control" name="description" id="description" rows="3">
                            {{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="product_type">
                        <strong>Type</strong>
                    </label>
                    <select class="custom-select mr-sm-2" id="product_type" name="product_type">
                        @foreach($product_types as $product_type)
                            <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" name="on_the_menu" type="checkbox" id="on_the_menu" checked>
                            <label class="form-check-label" for="on_the_menu">
                                Op het menu
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
