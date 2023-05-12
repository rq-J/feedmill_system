<div class="container">
    <form wire:submit.prevent="create" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div class="row mb-3">
            <label for="raw_material_name" class="col-md-3 col-form-label text-md">{{ __('Raw Material Name') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="raw_material_name" type="text" wire:model="raw_material_name" wire:keyup="valOnly"
                    class="form-control @error('raw_material_name') is-invalid @enderror" name="raw_material_name"
                    value="{{ old('raw_material_name') }}" placeholder="e.g: RAW MATERIAL"
                    autocomplete="raw_material_name" autofocus {!! $upCaseField !!}>

                @error('raw_material_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{ strtoupper($raw_material_name) }}
            </div>
        </div>

        <div class="row mb-3">
            <label for="" class="col-md-2 col-form-label text-md">{{ __('Category') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedCategory" class="form-control">
                    @foreach (['macro', 'micro', 'medicine'] as $option)
                        <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- {{ strtoupper($selectedCategory) }} --}}

        <div class="row mb-3">
            <label for="standard_days" class="col-md-2 col-form-label text-md">{{ __('Standard Days') }}</label>

            <div class="col-md-12">
                <input id="standard_days" type="number" wire:model="standard_days" wire:keyup="valOnly"
                    class="form-control @error('standard_days') is-invalid @enderror" name="standard_days"
                    value="{{ old('standard_days') }}" placeholder="e.g: 1" autocomplete="standard_days">

                @error('standard_days')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="price_per_kgs" class="col-md-4 col-form-label text-md">{{ __('Price per Kilogram') }}</label>

            <div class="col-md-12">
                <input id="price_per_kgs" type="number" wire:model="price_per_kgs" wire:keyup="valOnly"
                    class="form-control @error('price_per_kgs') is-invalid @enderror" name="price_per_kgs"
                    value="{{ old('price_per_kgs') }}" placeholder="e.g: 1" autocomplete="price_per_kgs">

                @error('price_per_kgs')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="inventory_cost" class="col-md-4 col-form-label text-md">{{ __('Inventory Cost') }}</label>

            <div class="col-md-12">
                <input id="inventory_cost" type="number" wire:model="inventory_cost" wire:keyup="valOnly"
                    class="form-control @error('inventory_cost') is-invalid @enderror" name="inventory_cost"
                    value="{{ old('inventory_cost') }}" placeholder="e.g: 1" autocomplete="inventory_cost">

                @error('inventory_cost')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="kgs_per_bag" class="col-md-4 col-form-label text-md">{{ __('Price per Kilogram') }}</label>

            <div class="col-md-12">
                <input id="kgs_per_bag" type="number" wire:model="kgs_per_bag" wire:keyup="valOnly"
                    class="form-control @error('kgs_per_bag') is-invalid @enderror" name="kgs_per_bag"
                    value="{{ old('kgs_per_bag') }}" placeholder="e.g: 1" autocomplete="kgs_per_bag">

                @error('kgs_per_bag')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

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
    <script>
        Livewire.on('categorySelected', (option) => {
            console.log('Selected option:', option);
        });
    </script>
</div>
