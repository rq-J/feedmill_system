@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div>
        @if ($result == 'complete')
            <div>
                <p class="text-center">Good work!</p>
            </div>
        @elseif ($result == 'daily_inventory')
            <h3>Daily Inventory</h3>
            @livewire('add-daily-inventory')
        @elseif ($result == 'item_daily')
            <h3>Daily Item Entries</h3>
            @livewire('add-item-daily')
        @endif
    </div>
@endsection

@section('alt-script')
@endsection
