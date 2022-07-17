<!DOCTYPE html>
<html lang="en">

<head>
  <title>All History</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    
  <div class="text-center bg-primary text-white">
    <h3>Payment History</h3>
  </div>
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    <h4>{{ session('status')}}</h4>
  </div>
  @endif
  <div style="margin-left: 10px;">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_room_modal">Add New Room</button>
  </div>

  <!-- Modal -->
  <div id="add_room_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Room Number</h4>
        </div>
        <div class="modal-body">
          <form action="history" method="POST">
            @csrf
            <div class="form-group">
              <label for="room_no">Room Number</label>
              <input type="text" class="form-control" name="add_room_no" id="add_room_no" required>
            </div>
            <div class="text-center">
              <input type="submit" name="submit" class="btn btn-success">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th>Room Number</th>
        <th>Paid</th>
        <th>Paid To</th>
        <th>Paid At</th>
        <th>Delete Room</th>
      </tr>
      </thead>
      <tbody>
      @foreach($all_history as $history)

    <tr>
      <td>{{ $history->room_number }} <input type="hidden" value="{{$history->id}}"></td>
      <td><input type="checkbox" {{ ($history->paid_to) ? "checked":"" }}></td>
      <td>{{ $history->paid_to }}</td>
      <td>{{ $history->paid_at }}</td>
      <td>
        <form action="history/{{$history->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>

@endforeach
      </tbody>
     
    
  </table>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment Action</h4>
        </div>
        <div class="modal-body">

          <form action="" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="room_number">Room Number</label>
              <input class="form-control" type="text" name="room_number" id="room_number" disabled>
            </div>

            <div class="form-group">
              <label for="accepted_date" id="accept_label1">Accepted Date</label>
              <input class="form-control" type="date" name="accepted_date" id="accepted_date">
            </div>

            <div class="form-group">
              <label for="accepted_by" id="accept_label2">Accepted By</label>
              <input class="form-control" type="text" name="accepted_by" id="accepted_by">
            </div>
            <div class="form-group text-center">
              <input type="submit" id="submit" class="btn btn-success">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  </div>




</body>

<script>
  $('input[type="checkbox"]').on('change', function(e) {
    if (e.target.checked) {
      $('#accept_label1').show();
      $('#accept_label2').show();
      $("#accepted_by").show();
      $("#accepted_date").show();
      room_no = e.target.parentElement.previousElementSibling.innerText;
      id = e.target.parentElement.previousElementSibling.querySelector('input[type="hidden"]').value;
      $('#room_number').attr('value', room_no);
      $('#myModal').find('form').attr('action', 'history/' + id);
      $('#myModal').modal();
    } else {
      $('#accept_label1').hide();
      $('#accept_label2').hide();
      $('#accepted_by').val('');
      $("#accepted_by").hide();
      $('#accepted_date').val('');
      $("#accepted_date").hide();
      $('#submit').val('Un-Paid');
      room_no = e.target.parentElement.previousElementSibling.innerText;
      id = e.target.parentElement.previousElementSibling.querySelector('input[type="hidden"]').value;
      $('#room_number').attr('value', room_no);
      $('#myModal').find('form').attr('action', 'history/' + id);
      $('#myModal').modal();
    }
  });
</script>

</html>