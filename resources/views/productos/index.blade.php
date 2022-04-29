@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-12">
                <a href="/productos/create" class="btn btn-primary">Nuevo</a>
            </div>
        </div>
    </div>



    <list-component></list-component>

@endsection