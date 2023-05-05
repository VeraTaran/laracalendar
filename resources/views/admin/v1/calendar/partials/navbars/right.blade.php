<div class="col-md-3">
    <div class="sticky-top mb-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Draggable Events</h4>
            </div>
            <div class="card-body">
                <!-- the events -->
                <div id="external-events">
                    @foreach($events as $event)
                        <div class="external-event" id="event-{{ $event->id }}" data-event-id="{{ $event->id }}" style="color: #fdfff8; background-color: {{ $event->color }}">{{ $event->name }}</div>
                    @endforeach
                    <div class="checkbox">
                        <label for="drop-remove">
                            <input type="checkbox" id="drop-remove">
                            remove after drop
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Event</h3>
            </div>
            <div class="card-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                </div>
                <!-- /btn-group -->
                <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    <!-- /btn-group -->
                </div>
                <!-- /input-group -->
            </div>
        </div>
    </div>
</div>
<!-- /.col -->
