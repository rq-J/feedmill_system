<div class="container">
    <form wire:submit.prevent="create" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp

        <div class="row mb-3">
            <label for="selectedCategory" class="col-md-2 col-form-label text-md">{{ __('Location') }}</label>

            <div class="col-md-12">
                {{-- #BUG: needs to be selected to actually register the value --}}
                <select wire:model="selectedLocation" class="form-control">
                    @foreach ($locations as $key => $value)
                        <option value="{{ $value->id }}" {{ $value->id == 1 ? 'selected' : '' }}>
                            {{ $value->farm_location }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- {{ strtoupper($selectedLocation) }} --}}

        <div class="row mb-3">
            <div class="col-md-12">
                <table class="table table-striped " id="item_table">
                    <thead>
                        <tr>
                            <th class="text-center">Item</th>
                            <th class="text-center">Age/Stage</th>
                            <th class="text-center">Population</th>
                            <th class="text-center">Grams per Population</th>
                            <th class="text-center">Total Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item_list as $key => $item_list)
                            <tr>
                                {{-- #NOTE: cannot ba added with wire:keyup --}}
                                <td class="text-center">
                                    {{-- #[x]: sometimes works, sometimes not --}}
                                    {{-- #BUG: needs to be selected to actually register the value --}}
                                    <select name="item_list[{{ $key }}][item_id]"
                                        wire:model="item_list.{{ $key }}.item_id" class="form-control">
                                        @foreach ($items as $item_key => $item_value)
                                            <option value="{{ $item_value->id }}"
                                                {{ $item_value->id == 1 ? 'selected' : '' }}>
                                                {{ $item_value->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="item_list[{{ $key }}][age_or_stage]" class="form-control"
                                        wire:model="item_list.{{ $key }}.age_or_stage" required>
                                </td>
                                <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="item_list[{{ $key }}][population]" class="form-control"
                                        wire:model="item_list.{{ $key }}.population" required>
                                </td>
                                <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="item_list[{{ $key }}][grams_per_population]"
                                        class="form-control"
                                        wire:model="item_list.{{ $key }}.grams_per_population" required>
                                </td>
                                <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="item_list[{{ $key }}][total_request]" class="form-control"
                                        wire:model="item_list.{{ $key }}.total_request" required>
                                </td>
                                <td>
                                    <button class="btn btn-danger"
                                        wire:click.prevent="removeButton({{ $key }})"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center" colspan="8">
                                <button class="btn btn-primary" wire:click.prevent="addButton"><i
                                        class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
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
                                <h5 class="modal-title" id="exampleModalLongTitle">Create New Week Request?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Create New Weekly Request?
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
    <script>
        Livewire.on('categorySelected', (option) => {
            console.log('Selected option:', option);
        });
    </script>
</div>
