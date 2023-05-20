@extends('admin.v1.layouts.default')
@section('title', 'AdminLTE 3 | Calendar'))
@section('style')
    @include('admin.v1.calendar.partials.style')
@endsection
@section('script')
    @include('admin.v1.calendar.partials.script')
@endsection

@section('content')

    <div class="wrapper">
        @include('admin.v1.layouts.navbars.top.index')
        @include('admin.v1.layouts.navbars.right.index')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('admin.v1.calendar.partials.navbars.top')
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @include('admin.v1.calendar.partials.navbars.right')
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-body p-0" id="calendar_parent_id">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('admin.v1.layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

@endsection
