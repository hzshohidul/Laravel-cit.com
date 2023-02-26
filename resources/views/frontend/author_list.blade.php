@extends('frontend.master')
@section('contentgola')
    <!--section-heading-->
    <div class="section-heading " >
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title ">
                            <h1>All Authors</h1>
                            <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!--blog-layout-1-->
    <div class="authors ">
        <div class="container-fluid">
            <div class="authors-area">
                <div class="row">
                    @foreach ($author_list as $author_data)
                    <!--author-1-->
                    <div class="col-md-6 ">
                        <div class="authors-single">
                            <div class="authors-single-image">
                                <a href="author.html">
                                    @if ($author_data->rel_to_user->image == null)
                                    <img src="{{ Avatar::create($author_data->rel_to_user->name)->toBase64() }}" />
                                    @else
                                    <img src="{{ asset('uploads/user') }}/{{ $author_data->rel_to_user->image }}" alt="">
                                    @endif
                                </a>
                            </div>
                            <div class="authors-single-content ">
                                <div class="left">
                                    <h6> <a href="{{ route('author.post', $author_data->author_id) }}">
                                        {{ $author_data->rel_to_user->name }}
                                    </a></h6>
                                    <p >{{ App\Models\Post::where('author_id', $author_data->author_id)->count() }} articles</p>
                                </div>
                                <div class="right">
                                    <div class="more-icon">
                                        <a href="{{ route('author.post', $author_data->author_id) }}">
                                            <i class="las la-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <!--pagination-->
    <div class="pagination">
        <div class="container-fluid">
            <div class="pagination-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination-list">
                            <ul class="list-inline">
                                <li><a href="#" ><i class="las la-arrow-left"></i></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#" ><i class="las la-arrow-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
