@section('slider')
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="http://4.bp.blogspot.com/-qMvBu_325JM/UWMEtV59-wI/AAAAAAAADJ0/HDSzWj6GyAY/s1600/welcome+slide.JPG" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="http://3.bp.blogspot.com/-m9CHFmqF0AY/UWWNU5XSoTI/AAAAAAAADKI/ye4BHMSm56U/s1600/wheat-field-research.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="http://4.bp.blogspot.com/-GBeUhyYB_xo/UWWQBNIwq1I/AAAAAAAADKU/ZGoUJOpOdoQ/s1600/flower.JPG" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


@endsection
