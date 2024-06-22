@extends('layouts.users')
@section('title', 'Dashboard')
@section('content')
@extends('re_usable_users.header')

 <!-- Page Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

            @if ($article)
     <!-- Blog Post -->
         <article class="card mb-4">
         <img class="card-img-top" src="https://via.placeholder.com/750x300" alt="Card image cap">
            <div class="card-body">
                 <h2 class="card-title">{{ $article->title }}</h2>
                    <p class="card-text">{{ $article->abstract }}</p>
                 </div>

                    <div class="card-footer text-muted">
                    Posted on {{ \Carbon\Carbon::parse($article->created_at)->format('F j, Y') }} 
                    </div>

   <div class="card-footer text-muted">keywords: <b>
    @foreach ($keywords as $keyword)
    {{ $keyword->keyword }},
   @endforeach
    </b>
    </div>

    <div class="card-footer text-muted">Uploaded Files: <br>
    @foreach (json_decode($article->upload_pdf) as $filePaths)
        <a href="{{ $filePaths }}" target="_blank">{{ basename($filePaths) }}</a><br>
    @endforeach
    </div>

    </article>
    @endif

                <!-- Comments Section
                <section class="mb-4">
                    <h4>Comments</h4>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Comment 1 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p class="card-text">Comment 2 Nulla convallis egestas rhoncus. Donec facilisis fermentum sem,
                                ac viverra ante luctus vel.</p>
                        </div>
                        <div class="card-footer">
                            <form>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Add a comment:</label>
                                    <textarea class="form-control" id="comment" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </section> -->
       
</div>
    
@extends('re_usable_users.sidebar')
@extends('re_usable_users.footer')
@endsection
