@extends('layouts.admin-nav')
@section(section: 'content')

                <div class="main-content">
{{-- <a class="navbar-brand" href="{{ route('posts.index') }}">Forum</a> --}}
                    <main class="py-4">

                          @include('posts.admin')
                      </main>
                </div>
            </div>
    <!------------------------------------------------------------------------------------------------------------------------->


  </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            @endsection
