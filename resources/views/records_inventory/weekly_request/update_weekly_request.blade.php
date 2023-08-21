@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Update Weekly Request</h3>
        @livewire('update-weekly-request', ['id' => $id])
    </div>
@endsection

@section('scripts')
    <script>
    $(document).on('click', '#remove', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var title = "Remove Item?";
      var name = $(this).data('name');
      var html_text = "<p>Are you sure you want to remove <b>" + name + "</b>?</p>";
      Swal.fire({
        title: title,
        html: html_text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continue'
      }).then((result) => {
        if (result.value) {
          var update_url = "{{ route('request.remove') }}"
          window.location.replace(update_url + "/" + id);
        }
        else {
          Swal.fire({
            title: 'Action Cancelled',
            text: "",
            icon: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close'
          });
        }
      });
    });
    </script>
@endsection
