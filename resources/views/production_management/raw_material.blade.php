@extends('layouts.app')

@section('title')
    Raw Material
@endsection

@section('content')
    <h3>Raw Material</h3>
    <div class="pull-right">
        <button id="myButton" class="btn btn-primary">Show/Hide Div</button>

    </div>
    @php
        $isHidden = true;
    @endphp
    @if ($isHidden)
        <div id="create" style="display: none">
            @livewire('add-raw-material')
        </div>
        <div class="container" id="table">
            <livewire:raw-material-table />
        </div>
    @endif

    {{-- <div>
        @inject('raw_mats', 'Illuminate\Support\Facades\Crypt')

        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Standard Days</th>
                    <th>Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($raw_materials as $raw_material)
                    <tr>
                        <td>{{ $raw_material->raw_material_name }}</td>
                        <td>{{ $raw_material->standard_days }}</td>
                        <td>{{ $raw_material->category }}</td>
                        <td>
                            <a href="{{ route('raw_materials.show', ['id' => $raw_mats::encryptString($raw_material->id)]) }}"
                                class="btn btn-warning">
                                Update
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        const button = document.getElementById("myButton");
        const create = document.getElementById("create");
        const table = document.getElementById("table");
        let isVisible = true;
        table.style.display = "block";

        button.addEventListener("click", function() {
            if (isVisible) {
                create.style.display = "block";
                table.style.display = "none";
                isVisible = false;
            } else {
                create.style.display = "none";
                table.style.display = "block";
                isVisible = true;
            }
        });

        @if(session('success_message'))
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
        @elseif(session('danger_message'))
            Swal.fire({
                title: 'Done!',
                text: '{{session('danger_message') }}',
                icon: 'error',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            });
        @endif

        @error('task')
            Swal.fire({
                title: 'Invalid Input!',
                text: '',
                icon: 'error',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            });
        @enderror

        @if(isset($_GET['action']) && $_GET['action'] == 'cancelled')
            Swal.fire({
                title: 'Action Cancelled!',
                text: '',
                icon: 'error',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
