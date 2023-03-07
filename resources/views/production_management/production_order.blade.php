@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <h3>Production Order</h3>
    <div>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Farm</th>
                    <th scope="col">Location</th>
                    <th scope="col">Item Request</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>DummyData</td>
                    <td>DummyData</td>
                    <td><button type="button" class="btn btn-warning">Delivered</button></td>
                </tr>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>DummyData</td>
                    <td>DummyData</td>
                    <td><button type="button" class="btn btn-warning">Delivered</button></td>
                </tr>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>DummyData</td>
                    <td>DummyData</td>
                    <td><button type="button" class="btn btn-warning">Delivered</button></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
