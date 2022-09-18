
<!-- Content Wrapper. Contains page content -->
@extends('layout.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quiz Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card">
            <div class="card-header ">
                <h3>Add New Quiz (Step-1)</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('post-quiz') }}" method="post">
                    @csrf
                    <div class="form-group">
                       <label for="">Quiz Title</label>
                        <input type="text" name="quiz_title" id="quiz_title" class="form-control" placeholder="Mathematics Quiz 1 etc">
                    </div>
                    <div class="form-group">
                       <label for="">Start Time</label>
                        <input type="datetime-local" name="startTime" id="startTime" class="form-control">
                    </div>
                    <div class="form-group">
                       <label for="">End Time</label>
                        <input type="datetime-local" name="endTime" id="endTime" class="form-control">
                    </div>
                    <input type="submit" value="Create" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
  </div>
  @endsection