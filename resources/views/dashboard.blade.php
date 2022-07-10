<!-- Content Wrapper. Contains page content -->
@extends('layout.layout')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Search Hotel </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <form action="{{ route('showHotels') }}" method="post">
  @csrf
            
              
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">Country / State / City</div>
                </div>
                <input type="text" class="form-control" id="searchHotel" value="<?php if(isset($location)) {echo $location;} else {echo '';} ?>" required name="location" placeholder="Search hotels...">
              </div>
          </div><!-- /.col -->
          <div class="col">
          <input type="submit" class="btn btn-primary btn-sm" value="Search">
          </form>
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      

      <div class="mb-2">
      @if(session('showing'))
        {{session('showing')}}
      @endif
      </div>
      
      @if(!empty($hotels))
      <div class="mb-2 text-right">
        Suggested Places:
            @foreach($suggestions as $sug)
                <span class="text-danger">
                  <a href="{{ route('showHotels', ['location'=>$sug->name]) }}">{{ $sug->name }}</a>
                </span> 
            @endforeach
        </div>
       
      </div>
        
      </ul>
      <div class="row">
        @foreach($hotels as $hotel)
          <div class="col-sm-12 col-md-6 col-lg-4 col-lg-2 mb-4">
          <div class="card text-center">
              <img class="card-img-top" src="" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">
                      {{ $hotel['name'] }}
                    </p>
                    <a href="#" class="btn btn-primary">Details</a>
                </div>
          </div>
          </div><!-- col ends -->
        @endforeach
          
      </div> <!-- row ends -->
		  @endif
      </div>
		  
    </section>
    <!-- /.content -->
  </div>
  @endsection