@extends('layouts.app')

@section('title')
    Accounting Payrolls
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">
            <a href="{{ route('payrolls') }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="left"
                    class="svg-inline--fa fa-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512">
                    <defs>
                        <style>
                            .fa-secondary {
                                opacity: .4
                            }
                        </style>
                    </defs>
                    <g class="fa-group">
                        <path d="M448 224V288C448 305.674 433.674 320 416 320H224V192H416C433.674 192 448 206.328 448 224Z"
                            class="fa-secondary" fill="currentColor" />
                        <path
                            d="M224 416C224 428.938 216.203 440.609 204.25 445.562C192.281 450.516 178.531 447.781 169.375 438.625L9.375 278.625C3.125 272.375 0 264.188 0 256S3.125 239.625 9.375 233.375L169.375 73.375C178.531 64.219 192.281 61.484 204.25 66.438C216.203 71.391 224 83.062 224 96V416Z"
                            class="fa-primary" fill="currentColor" />
                    </g>
                </svg>
            </a>&nbsp;Accounting Payrolls</h3>
        <div class="">
            @livewire('view-payroll',[$id, 'id'])
        </div>
    </div>
@endsection

@section('alt-scripts')
@endsection
