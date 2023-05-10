@extends('layouts.app')

@section('title')
    Weekly Request
@endsection

@section('content')
    {{-- #[x]: apply to all - bg-white shadow-lg rounded --}}
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Weekly Request</h3>

        @if ($weekly_request_last_week->count() >= 1)
            {{-- {{ $weekly_request_last_week }} --}}
            {{-- Show monitor (monday, tues, etc) --}}
            <h4>Daily Monitoring</h4>
            <table class="table table-hover table-bordered text-center">
                @inject('encrypt', 'Illuminate\Support\Facades\Crypt')
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Item</th>
                        <th>Total Request</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weekly_request_last_week as $last_week)
                        <tr>
                            <td>{{ $last_week->farm_location_id }}</td>
                            <td>{{ $last_week->item_id }}</td>
                            <td>{{ $last_week->total_request }}</td>
                            <td>
                                <a href="{{ route('request.monitor', ['id' => $encrypt::encryptString($last_week->id)]) }}"
                                    class="btn btn-warning">
                                    Update
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($weekly_request_this_week->count() >= 1)
            {{-- Show request this week (editable, deletable) --}}
            <h5>Request</h5>
            <div  style="overflow-x:auto;">
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
                            <th></th>
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

                                <td>
                                    <a href="{{ route('request.update', ['id' => $encrypt::encryptString($this_week->id)]) }}"
                                        class="btn btn-warning">
                                        Update
                                    </a>
                                    {{-- <a href="{{ route('request.remove', ['id' => $encrypt::encryptString($this_week->id)]) }}"
                                        class="btn btn-danger">
                                        Delete
                                    </a> --}}
                                    <button id="remove" data-id="{{ $encrypt::encryptString($this_week->id) }}" data-name="{{ $this_week->farm_location }} - {{ $this_week->item_name }}" class="btn btn-danger">Delete</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
        @else
            <div>
                @livewire('add-weekly-request')
            </div>
        @endif

    </div>
@endsection

@section('scripts')
    <script>
    $(document).on('click', '#remove', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var title = "Remove Item?";
      var name = $(this).data('name');
      var html_text = "<p>Are you sure you want to remove <b>" + name + "</b>?</p>";
      Swal.fire({
        title: title,
        html: html_text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continue'
      }).then((result) => {
        if (result.value) {
          var update_url = "{{ route('request.remove') }}"
          window.location.replace(update_url + "/" + id);
        }
        else {
          Swal.fire({
            title: 'Action Cancelled',
            text: "",
            icon: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close'
          });
        }
      });
    });

    @if (session('success_message'))
      Swal.fire({
        title: 'Done!',
        text: '{{ session('success_message') }}',
        icon: 'success',
        timer: 3000,
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Close'
      });
    @elseif (session('danger_message'))
      Swal.fire({
        title: 'Done!',
        text: '{{ session('danger_message') }}',
        icon: 'error',
        timer: 3000,
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      });
    @endif
    </script>
@endsection
