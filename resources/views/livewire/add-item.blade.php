<div class="container">
    <form wire:submit.prevent="create" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div class="row mb-3">
            <label for="item_name" class="col-md-3 col-form-label text-md">{{ __('Item') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="item_name" type="text" wire:model="item_name" wire:keyup="valOnly"
                    class="form-control @error('item_name') is-invalid @enderror" name="item_name"
                    value="{{ old('item_name') }}" placeholder="e.g: ITEM" autocomplete="item_name" autofocus
                    {!! $upCaseField !!}>

                @error('item_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{ strtoupper($item_name) }}
            </div>
        </div>

        <div class="row mb-3">
            <label for="selectedFarm" class="col-md-2 col-form-label text-md">{{ __('Farm') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedFarm" class="form-control">
                    @foreach ($farms as $key => $value)
                        <option value="{{ $value->id }}">{{ ucfirst($value->farm_name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{ strtoupper($selectedFarm) }}

        <div class="row">
            <div class="col-md-12">

                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    <div class="icon icon-sm text-center me-0 align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-bs-prefix="fa-duotone" data-bs-icon="plus"
                            class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <defs>
                                <style>
                                    .fa-secondary {
                                        opacity: .4
                                    }
                                </style>
                            </defs>
                            <g class="fa-group">
                                <path
                                    d="M224 464C201.906 464 184 446.094 184 424V88C184 65.906 201.906 48 224 48S264 65.906 264 88V424C264 446.094 246.094 464 224 464Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M392 296H56C33.906 296 16 278.094 16 256S33.906 216 56 216H392C414.094 216 432 233.906 432 256S414.094 296 392 296Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>Create
                </button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Create New Raw Material?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Create New Raw Material?
                            </div>
                            <div class="modal-footer">
                                <button wire:click="redirect_back_with_action"
                                    class="btn btn-secondary">{{ __('No') }}</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ __('Yes') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section('scripts')
    {{-- <script>
        window.addEventListener('danger_message', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.icon,
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Close'
            });
        });
    </script> --}}
    <script>
        Livewire.on('categoryFarm', (option) => {
            console.log('Selected option:', option);
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
                title: 'Danger!',
                text: '{{ session('danger_message') }}',
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

        @if (isset($_GET['action']) && $_GET['action'] == 'cancelled')
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
