@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <h3>Production Order</h3>
    <table class="table table-hover table-bordered text-center">
        @inject('encrypt', 'Illuminate\Support\Facades\Crypt')
        <thead>
            <tr>
                <th>Location</th>
                <th>Item</th>
                <th>Age/Stage</th>
                <th>Population</th>
                <th>Grams/Pop.</th>
                <th>Total Request</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weekly_request_this_week as $this_week)
                <tr>
                    {{-- {{ $this_week }} --}}
                    <td>{{ $this_week->farm_location }}</td>
                    <td>{{ $this_week->item_name }}</td>
                    <td>{{ $this_week->age_or_stage }}</td>
                    <td>{{ $this_week->population }}</td>
                    <td>{{ $this_week->grams_per_population }}</td>
                    <td>{{ $this_week->total_request }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
