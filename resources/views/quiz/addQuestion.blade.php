
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
                <h3 class="m-0 text-dark"><u>{{ $quiz[0]->quiz_title }}</u></h3>
                <div class="row mt-2">
                    <div class="col">
                        <button class="btn-danger btn" data-toggle="modal" data-target="#publish">Publish</button>
                        <!-- Modal -->
                    <div id="publish" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Publish Quiz</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="modalBody">
                                    <div class="form-group">
                                    Are you sure you want to Publish the quiz?
                                    </div>
                                    
                                    <a href="{{ route('publish-quiz', ['quizId' => $quiz[0]->quizId]) }}">
                                        <button class="btn btn-success"><i class="fas fa-upload"></i> Confirm Publish</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- modal ends -->
                    </div>
                    <div class="col">
                        <button class="btn btn-light float-right" data-toggle="modal" data-target="#myModal">Add Question</button>
                    </div>
                </div>
                <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Add Question</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="modalBody">
                                    
                                    <form action="{{ route('post-question', ['quizId' =>$quiz[0]->quizId ]) }}" method="post">
                                        @csrf
                                        <div id="mainBody">
                                            <div class="form-group">
                                                <span class="text-primary">Enter Question</span>
                                                <input type="text" name="question" class="form-control" required>
                                            </div>
                                            <div class="form-group" id="answerDiv">
                                                <!-- <input type="radio" name="correctAnswer">
                                                <input type="text" name="answer[]" class="form-control" placeholder="add option..." style="border-top: 0;border-left: 0;border-right: 0;"> -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                        <input type="radio" name="" disabled>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="options[]" placeholder="add option...">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <i class="fa fa-plus" id="clone_btn" style="cursor: pointer;"></i>
                                        <br>
                                        <input type="submit" value="Add" class="btn btn-success">
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- modal ends -->
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-sm-6 mb-2">
                        <?php $x=1 ?>
                    @foreach($questions as $q)
                            {{ $x.". ".$q->question_title }}
                            <?php 
                            
                            $ans = DB::table('answer')->where('qid', $q->id)->get();
                            foreach($ans as $a) { ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="text-field" name="" disabled>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control text-field" value="{{ $a->answer_text }}" disabled>
                                    <!-- <span class="text-primary"></span> -->
                                </div>
                            <?php  } ?>
                            <?php $x++; ?>
                    @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </section>
  </div>
  @endsection