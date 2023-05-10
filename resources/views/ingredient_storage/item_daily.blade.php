@extends('layouts.app')

@section('title')
    Dailies
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        @if ($result == 'complete')
            <div>
                <p class="text-center">Good work!</p>
            </div>
        @elseif ($result == 'daily_inventory')
            <h3 class="pt-4">Daily Inventory</h3>
            @livewire('add-daily-inventory')
        @elseif ($result == 'item_daily')
            <h3 class="pt-4">Daily Item Entries</h3>
            @livewire('add-item-daily')
        @endif
        <br>
    </div>
@endsection

@section('alt-script')
@endsection
