
<!-- Content Wrapper. Contains page content -->
@extends('layout.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h3 class="m-0 text-dark"><u>Server Side Pagination</u></h3>
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
                <div class="row mt-2">
                    <div class="col">
                    </div>
                    <div class="col">
                        <!-- <button class="btn btn-light float-right" data-toggle="modal" data-target="#myModal">Add Question</button> -->
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12 col-sm-6 mb-2">
                    <table id="example" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Team</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Position</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
  </div>
  <!-- /.content -->
  
  

  @endsection

  