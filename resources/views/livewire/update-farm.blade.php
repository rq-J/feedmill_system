<div class="container">
    <form wire:submit.prevent="update" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div class="row mb-3">
            <label for="farm_name" class="col-md-3 col-form-label text-md">{{ __('Farm Name') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="farm_name" type="text" wire:model="farm_name" wire:keyup="valOnly"
                    class="form-control @error('farm_name') is-invalid @enderror" name="farm_name"
                    value="{{ old('farm_name') }}" placeholder="e.g: FARM" autocomplete="farm_name" autofocus
                    {!! $upCaseField !!}>

                @error('farm_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($farm_name) }} --}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal" {{ !$errors->has('farm_name') ? '' : 'disabled' }}>Update
                </button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Farm?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Update Farm?
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-bs-dismiss="modal"
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
