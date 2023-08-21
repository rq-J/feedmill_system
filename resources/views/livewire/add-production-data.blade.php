<div class="container">
    <form wire:submit.prevent="create" method="POST">
        @csrf
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp

        {{-- <div class="row mb-3">
            <label for="selectedCategory" class="col-md-2 col-form-label text-md">{{ __('Location') }}</label>

            <div class="col-md-12">
                <select wire:model="selectedLocation" class="form-control">
                    @foreach ($locations as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->farm_location }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        {{-- {{ strtoupper($selectedLocation) }} --}}

        <div class="row">
            <div class="col-12">
                <div class="row mb-3">
                    <label for="date" class="col-md-12 col-form-label text-md">{{ __('Date') }}<span
                            class="text-danger">*</span></label>

                    <div class="col-md-12">
                        {{-- #[ ]: should be disabled for not admin, for later stages --}}
                        <input type="date" wire:model="date" value="{{ old('date') }}" name="date"
                            id="date" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="target_tons_per_hour"
                class="col-md-12 col-form-label text-md">{{ __('Target Tons per Hour') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="target_tons_per_hour" type="number" wire:model="target_tons_per_hour" wire:keyup="valOnly"
                    class="form-control @error('target_tons_per_hour') is-invalid @enderror" name="target_tons_per_hour"
                    value="{{ old('target_tons_per_hour') }}" placeholder="e.g: 10" autocomplete="target_tons_per_hour"
                    autofocus {!! $upCaseField !!}>
            </div>
            {{ $target_tons_per_hour }}
        </div>

        <div class="row mb-3">
            <label for="prod_target_tons"
                class="col-md-12 col-form-label text-md">{{ __('Production Target Tons') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="prod_target_tons" type="number" wire:model="prod_target_tons" wire:keyup="valOnly"
                    class="form-control @error('prod_target_tons') is-invalid @enderror" name="prod_target_tons"
                    value="{{ old('prod_target_tons') }}" placeholder="e.g: 50" autocomplete="prod_target_tons"
                    autofocus {!! $upCaseField !!}>
            </div>
            {{ $prod_target_tons }}
        </div>

        <div class="row mb-3">
            <label for="number_of_manpower"
                class="col-md-12 col-form-label text-md">{{ __('Number of Man-Power') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="number_of_manpower" type="number" wire:model="number_of_manpower" wire:keyup="valOnly"
                    class="form-control @error('number_of_manpower') is-invalid @enderror" name="number_of_manpower"
                    value="{{ old('number_of_manpower') }}" placeholder="e.g: 15" autocomplete="number_of_manpower"
                    autofocus {!! $upCaseField !!}>
            </div>
            {{ $number_of_manpower }}
        </div>

        <div class="row mb-3">
            <label for="total_hours_operated"
                class="col-md-12 col-form-label text-md">{{ __('Total Hours Operated') }}<span
                    class="text-danger">*</span></label>

            <div class="col-md-12">
                <input id="total_hours_operated" type="number" wire:model="total_hours_operated" wire:keyup="valOnly"
                    class="form-control @error('total_hours_operated') is-invalid @enderror" name="total_hours_operated"
                    value="{{ old('total_hours_operated') }}" placeholder="e.g: 15" autocomplete="total_hours_operated"
                    autofocus {!! $upCaseField !!}>
            </div>
            {{ $total_hours_operated }}
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <table class="table table-striped " id="item_table">
                    <thead>
                        <tr>
                            <th class="text-center">Feed Type</th>
                            <th class="text-center">Farm</th>
                            <th class="text-center">Runtime Start</th>
                            <th class="text-center">Runtime End</th>
                            {{-- <th class="text-center">Cycle Total Time</th> --}}
                            <th class="text-center">Tons Produced</th>
                            {{-- <th class="text-center">Tons per Hour</th> --}}
                            <th class="text-center">QA Result</th>
                            <th class="text-center">DT Category</th>
                            <th class="text-center">Downtime Start</th>
                            <th class="text-center">Downtime End</th>
                            {{-- <th class="text-center">DT Hour</th> --}}
                            {{-- <th class="text-center">Total Hours Operated</th> --}}
                            <th class="text-center">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_list as $key => $data_list)
                            <tr>
                                {{-- #NOTE: cannot ba added with wire:keyup --}}
                                <td class="text-center">
                                    <select name="data_list[{{ $key }}][item_id]"
                                        wire:model="data_list.{{ $key }}.item_id" class="form-control">
                                        {{-- #NOTE: switch the option --}}
                                        <option value="">--Please Select--</option>
                                        @foreach ($items as $item_key => $item_value)
                                            <option value="{{ $item_value->id }}"
                                                {{ $item_value->id == 1 ? 'selected' : '' }}>
                                                {{ $item_value->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="data_list[{{ $key }}][farm_id]"
                                        wire:model="data_list.{{ $key }}.farm_id" class="form-control">
                                        {{-- #NOTE: switch the option --}}
                                        <option value="">--Please Select--</option>
                                        @foreach ($farms as $item_key => $item_value)
                                            <option value="{{ $item_value->id }}">
                                                {{ $item_value->farm_location }} - {{ $item_value->farm->farm_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="time" name="data_list[{{ $key }}][runtime_start]"
                                        class="form-control" wire:model="data_list.{{ $key }}.runtime_start">
                                </td>
                                <td>
                                    <input type="time" name="data_list[{{ $key }}][runtime_end]"
                                        class="form-control" wire:model="data_list.{{ $key }}.runtime_end">
                                </td>
                                {{-- <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="data_list[{{ $key }}][cycle_total_time]" class="form-control"
                                        wire:model="data_list.{{ $key }}.cycle_total_time" required>
                                </td> --}}
                                <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="data_list[{{ $key }}][tons_produced]" class="form-control"
                                        wire:model="data_list.{{ $key }}.tons_produced">
                                </td>
                                {{-- <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="data_list[{{ $key }}][tons_per_hour]" class="form-control"
                                        wire:model="data_list.{{ $key }}.tons_per_hour" required>
                                </td> --}}
                                <td class="text-center">
                                    <select name="data_list[{{ $key }}][quality_assurance_id]"
                                        wire:model="data_list.{{ $key }}.quality_assurance_id"
                                        class="form-control">
                                        {{-- #NOTE: switch the option --}}
                                        <option value="">--Please Select--</option>
                                        @foreach ($quality_assurances as $item_key => $item_value)
                                            <option value="{{ $item_value->id }}">
                                                {{ $item_value->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select name="data_list[{{ $key }}][downtime_id]"
                                        wire:model="data_list.{{ $key }}.downtime_id" class="form-control">
                                        <option value="">--Please Select--</option>
                                        @foreach ($downtimes as $item_key => $item_value)
                                            <option value="{{ $item_value->id }}">
                                                {{ $item_value->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- {{ $data_list[$key][downtime_id] }} --}}
                                </td>
                                <td>
                                    <input type="time" name="data_list[{{ $key }}][downtime_start]"
                                        class="form-control"
                                        wire:model="data_list.{{ $key }}.downtime_start" required>
                                </td>
                                <td>
                                    <input type="time" name="data_list[{{ $key }}][downtime_end]"
                                        class="form-control" wire:model="data_list.{{ $key }}.downtime_end"
                                        required>
                                </td>
                                {{-- <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="data_list[{{ $key }}][downtime_hour]" class="form-control"
                                        wire:model="data_list.{{ $key }}.downtime_hour" required>
                                </td> --}}
                                {{-- <td>
                                    <input type="number" step="any" min="1" max="100"
                                        name="data_list[{{ $key }}][total_hours_operated]"
                                        class="form-control"
                                        wire:model="data_list.{{ $key }}.total_hours_operated" required>
                                </td> --}}
                                <td>
                                    <input type="text" step="any" min="1" max="100"
                                        name="data_list[{{ $key }}][remarks]" class="form-control"
                                        wire:model="data_list.{{ $key }}.remarks">
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
                                <h5 class="modal-title" id="exampleModalLongTitle">Create New Production Data?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Create New Production Data?
                            </div>
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal"
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
