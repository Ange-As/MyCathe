@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="app">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gestion des animateur</h1>
        </div>

        <filter-animateur-component />
    </div>
@endsection
