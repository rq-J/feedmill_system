@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <h3>Feeds Information</h3>
    <div>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Standard</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>DummyData</td>
                    <td><button type="button" class="btn btn-warning">Update</button></td>
                </tr>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>DummyData</td>
                    <td><button type="button" class="btn btn-warning">Update</button></td>
                </tr>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>DummyData</td>
                    <td><button type="button" class="btn btn-warning">Update</button></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
