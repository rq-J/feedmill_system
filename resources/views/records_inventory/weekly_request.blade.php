@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    {{-- #[ ]: apply to all - bg-white shadow-lg rounded --}}
    <div class="bg-white shadow-lg rounded">

        @if ($weekly_request_last_week->count() >= 1)
            {{-- {{ $weekly_request_last_week }} --}}
            Show monitor (monday, tues, etc)
        @endif
        @if ($weekly_request_this_week->count() >= 1)
            Show request this week (editable, deletable)

        @else
            <div>
                <div class="container pt-4">
                    <h3>Feed Request</h3>
                </div>
                @livewire('add-weekly-request')
            </div>
        @endif

    </div>
@endsection

@section('scripts')
@endsection
