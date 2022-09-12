
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
                      <div class="col-md-8">
                          <div class="card-body">
                             
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="card-title pb-2">
                                          <b>{{ $hotel['name'] }}</b>
                                        </h5>
                                    </div>
                                    {{--
                                    <?php 
                                    if(!empty($hotel['transport'])) { ?>
                                        <div class="col-md-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-fill" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                                            </svg> {{ $hotel['transport'][0]['locations'][0]['distance'] ." from ". $hotel['transport'][0]['locations'][0]['name'] ." ". $hotel['transport'][0]['category']}}
                                        </div>  
                                    <?php  } ?>
                                    --}}     
                                </div>
                                
                                
                              
                              <p class="card-text"><small class="text-muted">{{ $hotel['propertyDetails']['address']['fullAddress'] }}</small></p>
                              <hr class="hr hr-blurry" />
                              <div class="container">
                                    <span class="fa fa-star checked"></span>
                                    {{ $hotel['propertyDetails']['starRatingTitle'] }}
                                    
                              </div>
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