
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
    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif
    <section class="content">
        <div class="card">
            <div class="card-header ">
                <a href=" {{ url('add-new-quiz') }} ">
                    <button class="float-right btn btn-primary">Add Quiz</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quiz Title</th>
                                <th>Starts on</th>
                                <th>Ends on</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1 ?>
                            @foreach($data as $rows)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $rows->quiz_title }}</td>
                                    <td>{{ $rows->quiz_starts_on }}</td>
                                    <td>{{ $rows->quiz_ends_on }}</td>
                                    <td><button class="btn btn-outline-light text-dark shadow-none rounded-pill" style=" height: 30px;">Published</button></td>
                                    <td>
                                      <a href="{{ route('add-quiz' , ['quizId' => $rows->quizId]) }}">
                                          <button class="btn btn-success">Add Question</button>
                                      </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        
                        </tbody>  
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Quiz Title</th>
                                <th>Starts on</th>
                                <th>Ends on</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>  
                        
                    </table>
                </div>
            </div>
        </div>
    </section>
  </div>
  @endsection