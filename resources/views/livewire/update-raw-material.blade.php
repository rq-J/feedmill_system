@inject('raw_mats', 'Illuminate\Support\Facades\Crypt')
<div class="container">
    <form wire:submit.prevent="update" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <input type="hidden" name="edit_id" value="{{ $mat_id }}">

        <div class="row mb-3">
            <label for="raw_material_name" class="col-md-3 col-form-label text-md">{{ __('Raw Material Name') }}<span
                class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="raw_material_name" type="text" wire:model="raw_material_name" wire:keyup="valOnly"
                    class="form-control @error('raw_material_name') is-invalid @enderror" name="raw_material_name"
                    placeholder="e.g: RAW MATERIAL" autocomplete="raw_material_name" autofocus {!! $upCaseField !!}>

                @error('raw_material_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($raw_material_name) }} --}}
            </div>
        </div>

        <div class="row mb-3">
            <label for="standard_days" class="col-md-2 col-form-label text-md">{{ __('Standard Days') }}</label>

            <div class="col-md-12">
                <input id="standard_days" type="number" wire:model="standard_days" wire:keyup="valOnly"
                    class="form-control @error('standard_days') is-invalid @enderror" name="standard_days"
                    placeholder="e.g: 1" autocomplete="standard_days">

                @error('standard_days')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="standard_days" class="col-md-2 col-form-label text-md">{{ __('Category') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedCategory" class="form-control">
                    @foreach (['macro', 'micro', 'medicine'] as $option)
                        <option value="{{ $option }}" class="form-control">{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        {{-- {{ strtoupper($selectedCategory) }} --}}
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger float-end" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    <div class="icon icon-sm text-center me-0 align-items-center justify-content-center p-2">
                        <svg aria-hidden="true" focusable="false" data-bs-prefix="fa-duotone" data-bs-icon="trash"
                            class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
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
                                    d="M53.188 467.001C54.75 491.844 76.219 512.001 101.094 512.001H346.906C371.781 512.001 393.25 491.844 394.812 467.001L416 96.001H32L53.188 467.001Z"
                                    class="fa-secondary" fill="currentColor" />
                                <path
                                    d="M448 48.001V80.001C448 88.837 440.838 96.001 432 96.001H16C7.164 96.001 0 88.837 0 80.001V48.001C0 39.163 7.164 32.001 16 32.001H128L139.578 8.844C142.289 3.424 147.828 0.001 153.889 0.001H294.111C300.172 0.001 305.713 3.424 308.422 8.844L320 32.001H432C440.838 32.001 448 39.163 448 48.001Z"
                                    class="fa-primary" fill="currentColor" />
                            </g>
                        </svg>
                    </div>Delete
                </button>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                    aria-labelledby="deleteModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Raw Material?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Delete Raw Material?
                            </div>
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal" class="btn btn-warning">{{ __('No') }}</button>
                                <a href="{{ route('raw.remove', ['id' => $raw_mats::encryptString($mat_id)]) }}"
                                    class="btn btn-danger">
                                    Remove
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-end">&nbsp;</div>
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
                    </div>Update
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
                                {{-- <button wire:click="redirect_back_with_action"
                                    class="btn btn-secondary">{{ __('No') }}</button> --}}
                                {{-- <button data-bs-dismiss="modal" class="btn btn-warning">{{ __('No') }}</button> --}}
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">No</button>
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
    {{-- <script>
        Livewire.on('categorySelected', (option) => {
            console.log('Selected option:', option);
        });
    </script> --}}
</div>

<script>
    var noButton = document.querySelector('.btn-warning');
    noButton.addEventListener('click', function(event) {
        event.preventDefault();
        $('#exampleModal').modal('hide'); // hides the modal
    });
</script>
