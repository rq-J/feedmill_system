<div class="container">
    <form wire:submit.prevent="create" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div class="row mb-3">
            <label for="description" class="col-md-3 col-form-label text-md">{{ __('Description') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="description" type="text" wire:model="description" wire:keyup="valOnly"
                    class="form-control @error('description') is-invalid @enderror" name="description"
                    value="{{ old('description') }}" placeholder="e.g: DESCRIPTION" autocomplete="description" autofocus
                    {!! $upCaseField !!}>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{ strtoupper($description) }}
            </div>
        </div>
        <div class="row mb-3">
            <label for="code" class="col-md-3 col-form-label text-md">{{ __('Code') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="code" type="text" wire:model="code" wire:keyup="valOnly"
                    class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}"
                    placeholder="e.g: CODE" autocomplete="code" autofocus {!! $upCaseField !!}>

                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{ strtoupper($code) }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal" {{ !$errors->has('farm_name') ? '' : 'disabled' }}>
                    Create
                </button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Create New Quality Assurance?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Create New Quality Assurance?
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
