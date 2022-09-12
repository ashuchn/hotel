
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
                <u>
                  <span class="text-danger">
                      <a href="{{ route('showHotels', ['location'=>urlencode($sug->name)]) }}">{{ $sug->name }}</a>
                  </span> 
                </u>
            @endforeach
        </div>
       
      </div>
        
      </ul>
      <div class="row">
      <?php $i = 1; ?>
        @foreach($hotels as $hotel)
        
          <!-- <div class="col-sm-12 col-md-6 col-lg-4 col-lg-2 mb-4"> -->
          <div class="col-sm-12  mb-4">
          <div class="card">
              <!-- <img class="card-img-top" src="" alt="Card image cap"> -->
              <div class="row">
                      <div class="col-md-4">
                            <div id="carouselExampleControls<?php echo $i ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <?php
                                    $active = TRUE;
                                  ?>
                                  @foreach($hotel['hotelImg'] as $img)
                                      <div class="carousel-item <?php if($active == TRUE) { echo "active" ;} ?>">
                                        <img class="img-fluid card-img-top img-thumbnail" src="{{ $img }}" alt="First slide">
                                        <div class="card-img-overlay">
                                              
                                        </div>
                                      </div>
                                      <?php  $active = FALSE; ?>
                                  @endforeach
                                      
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $i ?>" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls<?php echo $i ?>" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                            </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card-body">
                              <h5 class="card-title pb-2">
                                <b>
                                {{ $hotel['name'] }}
                                </b>
                              </h5>
                              <br>
                              <hr class="hr hr-blurry" />

                              <h6>Features:</h6>
                              <p class="card-text">
                                  @foreach($hotel['ameneties'][0]['content'] as $features)
                                      <button class="btn btn-outline-light text-dark shadow-none rounded-pill" style=" height: 30px;">{{ $features }}</button>
                                  @endforeach
                                  <?php 

                                    //for($x = 0; $x < count())

                                  ?>
                              </p>
                              <a href="{{ $hotel['destinationId'] }}" class="btn btn-primary">Details</a>
                          </div>
                      </div>
              </div>
              
                
          </div>
          </div><!-- col ends -->
          <?php $i++; ?>
        @endforeach
          
      </div> <!-- row ends -->
		  @endif
      </div>
		  
    </section>
    <!-- /.content -->
  </div>
  @endsection