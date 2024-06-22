@extends('layouts.users')
@section('title', 'Dashboard')
@section('content')
@extends('re_usable_users.header')
@extends('re_usable_users.slider')

<!-- Page Content -->
<div class="container mt-4">
  <div class="row">
    <!-- Blog Entries Column -->
        <div class="col-lg-8">

            @if ($article)
            @foreach ($article as $articles)
                <!-- Blog Post -->
                <div class="card mb-4">
                    <img class="card-img-top" src="https://via.placeholder.com/750x300" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">{{ $articles->title }}</h2>
                        <p class="card-text">{{ $articles->abstract }}</p>
                        <a href="{{ url('article'. '/' . $articles->id) }}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ \Carbon\Carbon::parse($articles->created_at)->format('F j, Y') }}
                    </div>
                </div>
                @endforeach
                @endif
               

            {{ $article->links('pagination::bootstrap-5') }}

            </div>



@extends('re_usable_users.sidebar')
@extends('re_usable_users.footer')

@endsection
