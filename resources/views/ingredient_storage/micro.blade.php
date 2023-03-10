@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('content')
	<h3>Micro</h3>
	<div>
        <table class="table table-hover table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Total Batch</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>3</td>
                    <td>4</td>
                    <td><button type="button" class="btn btn-warning">Update</button></td>
                </tr>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>1</td>
                    <td>2</td>
                    <td><button type="button" class="btn btn-warning">Update</button></td>
                </tr>
                <tr>
                    <th scope="row">DummyData</th>
                    <td>4</td>
                    <td>5</td>
                    <td><button type="button" class="btn btn-warning">Update</button></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script>
		$.ajax({
			type: "GET",
			url: "{{ config('app.root_domain') . config('app.user_details_slug') . \Crypt::encryptString(Auth::user()->id) }}",
			dataType: 'json',
			success: function(response){
				document.getElementById('fullname').innerHTML = response['first_name'] + " " + response['last_name'];
				document.getElementById('email').innerHTML = response['email'];
			}
		});
	</script>
@endsection
