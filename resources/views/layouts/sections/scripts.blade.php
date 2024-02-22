<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('assets/vendor/libs/jquery/jquery.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/popper/popper.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/bootstrap.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')) }}"></script>
<script src="{{ asset(mix('assets/vendor/js/menu.js')) }}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('assets/js/main.js')) }}"></script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subheads.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'subhead_code', name: 'subhead_code'},
            {data: 'subhead_name', name: 'subhead_name'},
            // {data: 'department_name', name: 'department_name'},
            // {data: 'approved_provision', name: 'approved_provision'},
            // {data: 'dob', name: 'dob'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>


{{-- All Subhead Allocation Table --}}
<script type="text/javascript">
    $(function () {
      
      var table = $('.all-subhead-allocation').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('all-subhead-allocation.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'subhead_code', name: 'subhead_code'},
              {data: 'subhead.subhead_name', name: 'subhead_name'},
              {data: 'department.department_name', name: 'department_name'},
              {data: 'approved_provision', name: 'approved_provision'},
              {data: 'revised_provision', name: 'revised_provision'},
              // {data: 'dob', name: 'dob'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
      
    });
  </script>

  {{-- Subhead Allocation Table --}}
<script type="text/javascript">
    $(function () {
      
      var table = $('.subhead-allocation').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('subhead-allocation.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'subhead_code', name: 'subhead_code'},
              {data: 'subhead.subhead_name', name: 'subhead_name'},
              {data: 'department.department_name', name: 'department_name'},
              {data: 'approved_provision', name: 'approved_provision'},
              {data: 'revised_provision', name: 'revised_provision'},
              // {data: 'dob', name: 'dob'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
      
    });
  </script>

{{-- Users table --}}
<script type="text/javascript">
    $(function () {
      
      var table = $('.users-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('users.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'username', name: 'username'},

              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
                // {data: 'role_name', name: 'role_name'},
                {
    data: 'role_name',
    name: 'role_name',
    render: function(data, type, row) {
        if (data === null || data === '') {
            return '<span style="color:red">No role assigned yet</span>';
        } else {
            return data;
        }
    }
},
                {
    data: 'department_name',
    name: 'department_name',
    render: function(data, type, row) {
        if (data === null || data === '') {
            return '<span style="color:red">No department assigned</span>';
        } else {
            return data;
        }
    }
},



              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
      
    });
  </script>




<script>
    $(document).ready(function() {
        $('edit-btn2').click(function(e) {
            // e.preventDefault();
            console.log('Edit button clicked');
            var roleId = $(this).data('role-id');
            console.log('Role ID:', roleId);
            // Other actions you want to perform...
        });
    });
</script>




<script>
    document.getElementById('copyRecordsBtn').addEventListener('click', function() {
        // Send an AJAX request to the Laravel route
        fetch('/copy-subheads', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show a success message
        })
        .catch(error => {
            console.error('Error:', error); // Handle any errors
        });
    });
  </script>