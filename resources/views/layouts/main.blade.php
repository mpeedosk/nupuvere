@extends('layouts.blank')
@section('title', 'Nuppel')
@section('page')
    <!-- Header -->
    @include('includes.header')
    <!-- End Header -->
    <!-- Menu bar -->
    @include('includes.menu')
    <!-- End Menu bar -->
    <!-- Content -->
    @yield('content')
    <!-- End content -->
@endsection