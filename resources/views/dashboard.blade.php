@extends('layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard
    </li> --}}
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Example Content</h4>
        </div>
        <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quas omnis
            laudantium tempore
            exercitationem, expedita aspernatur sed officia asperiores unde tempora maxime odio
            reprehenderit
            distinctio incidunt! Vel aspernatur dicta consequatur!
        </div>
    </div>
</section>
@endsection
