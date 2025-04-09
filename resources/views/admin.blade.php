@extends('layouts.main')

@section('content')
    @foreach ($reports as $report)
        <x-admin-card :report="$report" />
    @endforeach
@endsection