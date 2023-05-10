<div>
    <form wire:submit.prevent="update({{ $request_id }})" method="POST">
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div class="row mb-3">
            <label for="selectedCategory" class="col-md-2 col-form-label text-md">{{ __('Location') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedLocation" class="form-control">
                    @foreach ($locations as $key => $value)
                        <option value="{{ $value->id }}">
                            {{ $value->farm_location }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="selectedCategory" class="col-md-2 col-form-label text-md">{{ __('Item') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedItem" class="form-control">
                    @foreach ($items as $key => $value)
                        <option value="{{ $value->id }}">
                            {{ $value->item_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="age_or_stage" class="col-md-3 col-form-label text-md">{{ __('Age or Stage') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="age_or_stage" type="text" wire:model="age_or_stage" wire:keyup="valOnly"
                    class="form-control @error('age_or_stage') is-invalid @enderror" name="age_or_stage"
                    value="{{ old('age_or_stage') }}" placeholder="e.g: 1" autocomplete="age_or_stage" autofocus
                    {!! $upCaseField !!}>

                @error('age_or_stage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($age_or_stage) }} --}}
            </div>
        </div>

        <div class="row mb-3">
            <label for="population" class="col-md-3 col-form-label text-md">{{ __('Population') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="population" type="text" wire:model="population" wire:keyup="valOnly"
                    class="form-control @error('population') is-invalid @enderror" name="population"
                    value="{{ old('population') }}" placeholder="e.g: 1" autocomplete="population" autofocus
                    {!! $upCaseField !!}>

                @error('population')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($population) }} --}}
            </div>
        </div>

        <div class="row mb-3">
            <label for="grams_per_population"
                class="col-md-3 col-form-label text-md">{{ __('Grams per Population') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="grams_per_population" type="text" wire:model="grams_per_population" wire:keyup="valOnly"
                    class="form-control @error('grams_per_population') is-invalid @enderror" name="grams_per_population"
                    value="{{ old('grams_per_population') }}" placeholder="e.g: 1" autocomplete="grams_per_population"
                    autofocus {!! $upCaseField !!}>

                @error('grams_per_population')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($grams_per_population) }} --}}
            </div>
        </div>

        <div class="row mb-3">
            <label for="total_request" class="col-md-3 col-form-label text-md">{{ __('Total Request') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="total_request" type="text" wire:model="total_request" wire:keyup="valOnly"
                    class="form-control @error('total_request') is-invalid @enderror" name="total_request"
                    value="{{ old('total_request') }}" placeholder="e.g: 1" autocomplete="total_request" autofocus
                    {!! $upCaseField !!}>

                @error('total_request')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($total_request) }} --}}
            </div>
        </div>

        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Weekly Request?</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are You Sure You Want To Update Weekly Request?
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
<br>
<br>
<br>
