@extends('layout')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <a class="btn btn-dark text-white mb-3" href="#">Klik hier om het menu te downloaden</a>
        <div id="app" class="bg-menu">
            @foreach($menuCategories as $menuCategory)
                <menu-table :menu='{!! json_encode($menuCategory) !!}'></menu-table>
            @endforeach
        </div>
    </div>
@endsection
