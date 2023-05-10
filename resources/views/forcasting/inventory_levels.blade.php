@extends('layouts.app')

@section('title')
	Inventory Levels
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Inventory Levels</h3>
        <div>
            <table class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Actual</th>
                        <th scope="col">Standard</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">DummyData</th>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td><button type="button" class="btn btn-warning">Update</button></td>
                    </tr>
                    <tr>
                        <th scope="row">DummyData</th>
                        <td>DummyData</td>
                        <td>DummyData</td>
                        <td><button type="button" class="btn btn-warning">Update</button></td>
                    </tr>
                    <tr>
                        <th scope="row">DummyData</th>
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
			success: function(response){
				document.getElementById('fullname').innerHTML = response['first_name'] + " " + response['last_name'];
				document.getElementById('email').innerHTML = response['email'];
			}
		});
	</script>
@endsection
