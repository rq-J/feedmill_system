@extends('layouts.app')

@section('title')
    Accounting Bills
@endsection

@section('content')
    <h3>Accounting Bills</h3>
    <br>
    <div class="row">
        <div class="col-6">
            <h4>Electric Cost</h4>
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Electric Cost</th>
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
        <div class="col-6">
            <h4>Maintenance Cost</h4>
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Maintenance Cost</th>
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
    </div>
    <div class="row">
        <div class="col-6">
            <h4>Man Power</h4>
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Man Power</th>
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
        {{-- <div class="col-6">
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Month</th>
                        <th scope="col">Maintenance Cost</th>
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
        </div> --}}
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $.ajax({
            type: "GET",
            url: "{{ config('app.root_domain') . config('app.user_details_slug') . \Crypt::encryptString(Auth::user()->id) }}",
            dataType: 'json',
            success: function(response) {
                document.getElementById('fullname').innerHTML = response['first_name'] + " " + response[
                    'last_name'];
                document.getElementById('email').innerHTML = response['email'];
            }
        });
    </script>
@endsection
