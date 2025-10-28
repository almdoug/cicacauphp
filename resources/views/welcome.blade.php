@extends('layouts.app')

@section('title', 'Início')

@section('content')
    @include('components.hero')
    @include('components.news-section')
    @include('components.events-section')
    @include('components.interviews-section')
@endsection
