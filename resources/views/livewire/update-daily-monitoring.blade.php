<div>
    <div class="row mb-3">
        <div class="col-6">
            <div class="row">
                <label class="col-md-12 col-form-label text-md">{{ __('Location') }}</label>

                <div class="col-md-12">
                    <input id="selectedLocation" type="string" class="form-control" name="selectedLocation"
                        value="{{ $selectedLocation }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <label class="col-md-12 col-form-label text-md">{{ __('Item') }}</label>

                <div class="col-md-12">
                    <input id="selectedItem" type="string" class="form-control" name="selectedItem"
                        value="{{ $selectedItem }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <div class="row">
                <label class="col-md-12 col-form-label text-md">{{ __('Age or Stage') }}</label>

                <div class="col-md-12">
                    <input id="age_or_stage" type="number" class="form-control" name="age_or_stage"
                        value="{{ $age_or_stage }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <label class="col-md-12 col-form-label text-md">{{ __('Population') }}</label>

                <div class="col-md-12">
                    <input id="population" type="number" class="form-control" name="population"
                        value="{{ $population }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <div class="row">
                <label class="col-md-12 col-form-label text-md">{{ __('Grams per Population') }}</label>

                <div class="col-md-12">
                    <input id="grams_per_population" type="number" class="form-control" name="grams_per_population"
                        value="{{ $grams_per_population }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <label class="col-md-12 col-form-label text-md">{{ __('Total Request') }}</label>

                <div class="col-md-12">
                    <input id="total_request" type="number" class="form-control" name="total_request"
                        value="{{ $total_request }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="update({{ $request_id }})" method="POST">
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Monday</th>
                    <th scope="col">Tuesday</th>
                    <th scope="col">Wenesday</th>
                    <th scope="col">Thursday</th>
                    <th scope="col">Friday</th>
                    <th scope="col">Saturday</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input id="monday" type="number" wire:model="monday" wire:keyup="valOnly"
                            class="form-control @error('monday') is-invalid @enderror" name="monday"
                            value="{{ old('monday') }}" placeholder="e.g: FARM LOCATION" autocomplete="monday"
                            autofocus>

                        @error('monday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <input id="tuesday" type="number" wire:model="tuesday" wire:keyup="valOnly"
                            class="form-control @error('tuesday') is-invalid @enderror" name="tuesday"
                            value="{{ old('tuesday') }}" placeholder="e.g: FARM LOCATION" autocomplete="tuesday"
                            autofocus>

                        @error('tuesday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <input id="wenesday" type="number" wire:model="wenesday" wire:keyup="valOnly"
                            class="form-control @error('wenesday') is-invalid @enderror" name="wenesday"
                            value="{{ old('wenesday') }}" placeholder="e.g: FARM LOCATION" autocomplete="wenesday"
                            autofocus>

                        @error('wenesday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <input id="thursday" type="number" wire:model="thursday" wire:keyup="valOnly"
                            class="form-control @error('thursday') is-invalid @enderror" name="thursday"
                            value="{{ old('thursday') }}" placeholder="e.g: FARM LOCATION" autocomplete="thursday"
                            autofocus>

                        @error('thursday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <input id="friday" type="number" wire:model="friday" wire:keyup="valOnly"
                            class="form-control @error('friday') is-invalid @enderror" name="friday"
                            value="{{ old('friday') }}" placeholder="e.g: FARM LOCATION" autocomplete="friday"
                            autofocus>

                        @error('friday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <input id="saturday" type="number" wire:model="saturday" wire:keyup="valOnly"
                            class="form-control @error('saturday') is-invalid @enderror" name="saturday"
                            value="{{ old('saturday') }}" placeholder="e.g: FARM LOCATION" autocomplete="saturday"
                            autofocus>

                        @error('saturday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                </tr>
            </tbody>
        </table>
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

        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Daily Monitoring?</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are You Sure You Want To Update Daily Monitoring?
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
    </form>
</div>
<br><br><br>
