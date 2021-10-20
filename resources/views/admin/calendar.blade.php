@extends('admin.layouts.app')
@section('content')
   <div class="container" style="width: 1000px!important;">
  <h1>Schedule calendar</h1>
  <div id='calendarFull'></div>

<div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form name="save-event" method="post" id="save-event">
        @csrf
          <input type="hidden" name="type" value="add">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" />
          </div>
          <div class="form-group">
            <label>Event start</label>
            <input type="text" name="evtStart" class="form-control col-xs-3" />
          </div>
          <div class="form-group">
            <label>Event end</label>
            <input type="text" name="evtEnd" class="form-control col-xs-3" />
          </div>

        </form>
      </div>

      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="jaipalyadav" class="btn btn-primary">Save changes</button>
      </div>
     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</div>

   @endsection