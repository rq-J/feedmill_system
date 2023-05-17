@extends('layouts.app')

@section('title')
    Accounting Payrolls
@endsection

@section('content')
    <h3>Accounting Payrolls</h3>
    <div class="row">
        <div class="">
            <h4></h4>
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Feedmill</th>
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
                            <br>15th
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">DummyData</th>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td><button type="button" class="btn btn-warning">Update</button></td>
                    </tr>
                    <tr>
                        <th scope="row">DummyData</th>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td><button type="button" class="btn btn-warning">Update</button></td>
                    </tr>
                    <tr>
                        <th scope="row">DummyData</th>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td><button type="button" class="btn btn-warning">Update</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
