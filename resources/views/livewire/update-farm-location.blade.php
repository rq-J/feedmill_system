<div class="container">
    <form wire:submit.prevent="update" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div class="row mb-3">
            <label for="farm_location" class="col-md-3 col-form-label text-md">{{ __('Farm Name') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="farm_location" type="text" wire:model="farm_location" wire:keyup="valOnly"
                    class="form-control @error('farm_location') is-invalid @enderror" name="farm_location"
                    value="{{ old('farm_location') }}" placeholder="e.g: FARM LOCATION" autocomplete="farm_location" autofocus
                    {!! $upCaseField !!}>

                @error('farm_location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- {{ strtoupper($farm_location) }} --}}
            </div>
        </div>

        <div class="row mb-3">
            <label for="standard_days" class="col-md-2 col-form-label text-md">{{ __('Category') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedCategory" class="form-control">
                    @foreach ($farms as $key => $value)
                        <option value="{{ $value->farm_name }}">{{ ucfirst($value->farm_name ) }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        {{ strtoupper($selectedCategory) }}


        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal">Update
                </button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Location?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Update Location?
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
