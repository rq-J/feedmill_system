<div>
    <style>
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            text-align: center;
        }
    </style>
    <form wire:submit.prevent="create" method="POST">
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="date_now" class="col-md-12 col-form-label text-md">{{ __('Date') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            {{-- #[ ]: should be disabled for not admin, for later stages --}}
                            <input type="date" wire:model="date_now" value="{{ old('date_now') }}" name="date_now"
                                id="date_now" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location"
                            class="col-md-12 col-form-label text-md">{{ __('Electric Cost') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="electric_cost" type="number" wire:model="electric_cost" wire:keyup="valOnly"
                                class="form-control @error('electric_cost') is-invalid @enderror" name="electric_cost"
                                value="{{ old('electric_cost') }}" placeholder="e.g: 10000" autocomplete="electric_cost"
                                autofocus {!! $upCaseField !!}>
                        </div>
                        {{ $electric_cost }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Create
                </button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Create Payroll?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Create New Payroll?
                            </div>
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal" class="btn btn-secondary">{{ __('No') }}</button>
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
