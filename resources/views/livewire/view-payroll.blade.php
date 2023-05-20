<div>
    <style>
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            text-align: center;
        }
    </style>
    <form wire:submit.prevent="update" method="POST">
        @php
            $upCaseField = 'style="text-transform:uppercase;"';
        @endphp
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="date_now"  class="col-md-12 col-form-label text-md">{{ __('Date') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                                <input type="date" wire:model="payroll_date" value="{{ old('payroll_date') }}" name="payroll_date" id="payroll_date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location" class="col-md-12 col-form-label text-md">{{ __('Salary - 15th') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="manila_salary_15" type="text" wire:model="manila_salary_15"
                                wire:keyup="valOnly"
                                class="form-control @error('manila_salary_15') is-invalid @enderror"
                                name="manila_salary_15" value="{{ old('manila_salary_15') }}" placeholder="e.g: 10000"
                                autocomplete="manila_salary_15" autofocus {!! $upCaseField !!}>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location" class="col-md-12 col-form-label text-md">{{ __('13th Month - 15th') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="manila_month_13th_15" type="text" wire:model="manila_month_13th_15"
                                wire:keyup="valOnly"
                                class="form-control @error('manila_month_13th_15') is-invalid @enderror"
                                name="manila_month_13th_15" value="{{ old('manila_month_13th_15') }}" placeholder="e.g: 10000"
                                autocomplete="manila_month_13th_15" autofocus {!! $upCaseField !!}>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location" class="col-md-12 col-form-label text-md">{{ __('Allowance - 15th') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="manila_allowance_15" type="text" wire:model="manila_allowance_15"
                                wire:keyup="valOnly"
                                class="form-control @error('manila_allowance_15') is-invalid @enderror"
                                name="manila_allowance_15" value="{{ old('manila_allowance_15') }}" placeholder="e.g: 10000"
                                autocomplete="manila_allowance_15" autofocus {!! $upCaseField !!}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location" class="col-md-12 col-form-label text-md">{{ __('Salary - 30th') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="manila_salary_30" type="text" wire:model="manila_salary_30"
                                wire:keyup="valOnly"
                                class="form-control @error('manila_salary_30') is-invalid @enderror"
                                name="manila_salary_30" value="{{ old('manila_salary_30') }}" placeholder="e.g: 10000"
                                autocomplete="manila_salary_30" autofocus {!! $upCaseField !!}>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location" class="col-md-12 col-form-label text-md">{{ __('13th Month - 30th') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="manila_month_13th_30" type="text" wire:model="manila_month_13th_30"
                                wire:keyup="valOnly"
                                class="form-control @error('manila_month_13th_30') is-invalid @enderror"
                                name="manila_month_13th_30" value="{{ old('manila_month_13th_30') }}" placeholder="e.g: 10000"
                                autocomplete="manila_month_13th_30" autofocus {!! $upCaseField !!}>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row mb-3">
                        <label for="farm_location" class="col-md-12 col-form-label text-md">{{ __('Allowance - 30th') }}<span
                                class="text-danger">*</span></label>

                        <div class="col-md-12">
                            <input id="manila_allowance_30" type="text" wire:model="manila_allowance_30"
                                wire:keyup="valOnly"
                                class="form-control @error('manila_allowance_30') is-invalid @enderror"
                                name="manila_allowance_30" value="{{ old('manila_allowance_30') }}" placeholder="e.g: 10000"
                                autocomplete="manila_allowance_30" autofocus {!! $upCaseField !!}>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped " id="item_table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Salaries
                        <br>15th
                    </th>
                    <th scope="col">Salaries
                        <br>30th
                    </th>
                    <th scope="col">Overtime
                        <br>15th
                    </th>
                    <th scope="col">Overtime
                        <br>30th
                    </th>
                    <th scope="col">Allowance
                        <br>15th
                    </th>
                    <th scope="col">Allowance
                        <br>30th
                    </th>
                    <th scope="col">13th Month
                        <br>15th
                    </th>
                    <th scope="col">13th Month
                        <br>30th
                    </th>
                    {{-- <th scope="col"></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($payroll_list as $key => $payroll_list)
                    <tr>
                        <td>
                            <input type="text" step="any" name="payroll_list[{{ $key }}][name]"
                                class="form-control" wire:model="payroll_list.{{ $key }}.name" required>
                        </td>
                        <td>
                            <input type="text" step="any" name="payroll_list[{{ $key }}][position]"
                                class="form-control" wire:model="payroll_list.{{ $key }}.position" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][salary_15]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.salary_15" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][salary_30]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.salary_30" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][overtime_15]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.overtime_15" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][overtime_30]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.overtime_30" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][allowance_15]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.allowance_15" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][allowance_30]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.allowance_30" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][month_13th_15]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.month_13th_15" required>
                        </td>
                        <td>
                            <input type="number" step="any"
                                name="payroll_list[{{ $key }}][month_13th_30]" class="form-control"
                                wire:model="payroll_list.{{ $key }}.month_13th_30" required>
                        </td>
                        <td>
                            <button class="btn btn-danger" wire:click.prevent="removeButton({{ $key }})"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center" colspan="13">
                        <button class="btn btn-primary" wire:click.prevent="addButton"><i
                                class="fas fa-plus"></i></button>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $this->latest->sum('salary_15') }}</td>
                    <td>{{ $this->latest->sum('salary_30') }}</td>
                    <td>{{ $this->latest->sum('overtime_15') }}</td>
                    <td>{{ $this->latest->sum('overtime_30') }}</td>
                    <td>{{ $this->latest->sum('allowance_15') }}</td>
                    <td>{{ $this->latest->sum('allowance_30') }}</td>
                    <td>{{ $this->latest->sum('month_13th_15') }}</td>
                    <td>{{ $this->latest->sum('month_13th_30') }}</td>
                </tr>
                <tr>
                    <td colspan="5">
                        Net Pay: {{
                            $this->latest->sum('salary_15') +
                            $this->latest->sum('salary_30') +
                            $this->latest->sum('allowance_15') +
                            $this->latest->sum('allowance_30')
                            }}
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        Overtime: {{
                            $this->latest->sum('overtime_15') +
                            $this->latest->sum('overtime_30')
                            }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <div class="row">
            <div class="col-md-12">

                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Update
                </button>

                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                    aria-labelledby="createModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Payroll?</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Update Payroll?
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
