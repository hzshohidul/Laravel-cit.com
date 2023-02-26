@extends('frontend.master')
@section('contentgola')
   <!--section-heading-->
   <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $category_info->category_name }}</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                @forelse ($category_post_gola as $category_post)
                 <!--post 1-->
                 <div class="post-list post-list-style2">
                     <div class="post-list-image">
                         <a href="{{ route('post.details', $category_post->slug) }}">
                             <img src="{{ asset('uploads/post') }}/{{ $category_post->feat_image }}" alt="">
                         </a>
                     </div>
                     <div class="post-list-content">
                         <h3 class="entry-title">
                             <a href="{{ route('post.details', $category_post->slug) }}">
                                {{ $category_post->title }}
                             </a>
                         </h3>
                         <ul class="entry-meta">
                             <li class="post-author-img">
                                <a href="{{ route('author.post', $category_post->author_id) }}">
                                @if ($category_post->rel_to_user->image == null)
                                    <img src="{{ Avatar::create($category_post->rel_to_user->name)->toBase64() }}" />
                                @else
                                    <img src="{{ asset('/uploads/user') }}/{{ $category_post->rel_to_user->image; }}" alt="">
                                @endif

                                {{ $category_post->rel_to_user->name }}
                                </a>
                             </li>
                             <li class="entry-cat">
                                <a href="{{ route('category.post', $category_post->category_id) }}" class="category-style-1 "> <span class="line"></span> {{ $category_info->category_name }}
                                </a></li>
                             <li class="post-date"> <span class="line"></span>
                                {{ $category_post->created_at->format('M d, Y') }}
                            </li>
                         </ul>
                         <div class="post-exerpt">
                             <p>
                                {{ $category_post->short_desp }}
                             </p>
                         </div>
                         <div class="post-btn">
                             <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                         </div>
                     </div>
                 </div>
                 @empty
                 <div class="text-center my-3">
                    <h3 class="text-danger">No Post Found</h3>
                 </div>
                 @endforelse
             </div>
         </div>
     </div>
 </section>


<!--pagination-->
<div class="pagination">
     <div class="container-fluid">
         <div class="pagination-area">
             <div class="row">
                 <div class="col-lg-12">
                    <div class="pagination-list">
                        <ul class="list-inline">
                            <li><a href="#"><i class="las la-arrow-left"></i></a></li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#"><i class="las la-arrow-right"></i></a></li>
                        </ul>
                    </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
