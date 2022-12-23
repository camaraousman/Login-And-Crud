@extends('layouts.app')

@include('layouts.partials.messages')
@section('main')

@auth

{{-- add new subscriber modal start --}}
<div class="modal fade" id="addSubscriberModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Subscriber</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_subscriber_form" enctype="multipart/form-data">

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">First Name *</label>
              <input type="text" name="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-lg">
              <label for="lname">Last Name *</label>
              <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail">
          </div>
          <div class="my-2">
            <label for="phone">Phone *</label>
            <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
          </div>
          <div class="my-2">
            <label for="number_plate">Number Plate</label>
            <input type="text" name="number_plate" class="form-control" placeholder="number_plate" required>
            <div class="col-lg">
              <label for="kimlik">Kimlik</label>
              <input type="text" name="kimlik" class="form-control" placeholder="Kimlik">
            </div>
            <div class="col-lg">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control" placeholder="address">
            </div>
          </div>
          <div class="my-2">
            <label for="file">Select File *</label>
            <input type="file" name="file" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_subscriber_btn" class="btn btn-primary">Add Subscriber</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new subcriber modal end --}}

{{-- edit subscriber modal start --}}
<div class="modal fade" id="editSubscriberModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subscriber</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_subscriber_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="sub_id" id="sub_id">
        <input type="hidden" name="sub_file" id="sub_file">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">First Name</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-lg">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
          </div>
          <div class="my-2">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
          </div>
          <div class="my-2">
            <label for="number_plate">Number Plate</label>
            <input type="text" name="number_plate" id="number_plate" class="form-control" placeholder="Number Plate" required>
          </div>
          <div class="col-lg">
              <label for="kimlik">Kimlik</label>
              <input type="text" name="kimlik" id="kimlik" class="form-control" placeholder="Kimlik">
            </div>
            <div class="col-lg">
              <label for="address">Address</label>
              <input type="text" name="address" id="address" class="form-control" placeholder="Address">
            </div>
          <div class="my-2">
            <label for="file">Select File</label>
            <input type="file" name="file" class="form-control">
          </div>
          <div class="mt-2" id="file">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_subsciber_btn" class="btn btn-success">Update Subscriber</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit subscriber modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Subscribers</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addSubscriberModal"><i
                class="bi-plus-circle me-2"></i>Add New Subscriber</button>
          </div>
          <div class="card-body" id="show_all_subscribers">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {

      // add new subscriber ajax request
      $("#add_subscriber_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_subscriber_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Subscriber Added Successfully!',
                'success'
              )
              fetchAllSubscribers();
            }
            $("#add_subscriber_btn").text('Add Subscriber');
            $("#add_subscriber_form")[0].reset();
            $("#addSubscriberModal").modal('hide');
          }
        });
      });

      // edit subscriber ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#fname").val(response.first_name);
            $("#lname").val(response.last_name);
            $("#email").val(response.email);
            $("#phone").val(response.phone);
            $("#number_plate").val(response.number_plate);
            $("#kimlik").val(response.kimlik);
            $("#address").val(response.address);
            $("#file").html(
              `<img src="storage/images/${response.file}" width="100" class="img-fluid img-thumbnail">`);
            $("#sub_id").val(response.id);
            $("#sub_file").val(response.file);
          }
        });
      });

      // update subscriber ajax request
      $("#edit_subscriber_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_subscriber_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Subscriber Updated Successfully!',
                'success'
              )
              fetchAllSubscribers();
            }
            $("#edit_subscriber_btn").text('Update Subscriber');
            $("#edit_subscriber_form")[0].reset();
            $("#editSubscriberModal").modal('hide');
          }
        });
      });

      // delete subscriber ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllSubscribers();
              }
            });
          }
        })
      });

      // fetch all subscribers ajax request
      fetchAllSubscribers();

      function fetchAllSubscribers() {
        $.ajax({
          url: '{{ route('fetchAll') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_subscribers").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
@endauth

@guest
        <div class="container">
        <h1>Homepage</h1>
        <p class="lead">You're viewing the home page. Please login to view and Manage Subscribers.</p>
        </div>
@endguest
  @endsection
