@extends('layouts.base')

@section('title', "Forget Password")

@section('head_assets')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
<form action="/reset-password">
    <div class="forget">
        <div class="forget-container">

        </div>
    </div>
</form>
@endsection
