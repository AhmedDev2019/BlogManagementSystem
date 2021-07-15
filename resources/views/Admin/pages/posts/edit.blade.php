@extends('Admin.layouts.master')

@section('css')

@section('title')
    {{ trans('backend.add') }} {{ trans('backend.posts') }}
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('backend.add') }} {{ trans('backend.posts') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div class="mainContent">
    
    <div class="card" style="border-top:3px solid #639a40">
        <div class="card-body">
            
            <form id="myForm" action="{{ route('posts.update' , $post->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @include('Admin.includes._messages')

                <!-- First Row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('backend.title') }}</label>
                            <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ trans('backend.categories') }}</label>
                            <select name="category_id" id="category_id" class="form-control select2" style="wdith:100%">
                                @foreach( $categories as $category )
                                    <option value="{{ $category->id }}" {{ $post->category->id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                   
                </div>
                <!-- First Row -->



                <!-- First Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ trans('backend.tags') }}</label>
                            <div style="background-color:#eee;padding:10px;width:100%;min-height:100px">

                                
                                @foreach( $tags as $index=> $tag )
                                    <div class="checkbox" style="background-color:white;display:inline-block;margin:10px;padding:10px 10px 2px 10px;border-radius:10px">
                                        <input id="tag{{ $index }}" type="checkbox" value="{{ $tag->id }}" name="tag[]" id="tag"
                                            @foreach( $post->tags as $t )
                                                @if( $tag->id == $t->id )
                                                    checked
                                                @endif
                                            @endforeach
                                        > 
                                        <label for="tag{{ $index }}"><b>{{ $tag->name }}</b></label>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                <!-- First Row -->
            


                <!-- Image ( Post Image ) -->
                <div class="form-group">
                    <label>{{ trans('backend.image') }}</label>
                    <input type="file" name="image" class="form-control image">
                    <div class="text-center">
                        <img src="{{ asset($post->image) }}" class="img-thumbnail image-preview" style="margin-top:2px;width:550px;height:400px" alt="">
                    </div>
                </div>



                <!-- First Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ trans('backend.content') }}</label>
                            <textarea name="content" id="summernote" rows="10" class="form-control content">{!! $post->content !!}</textarea>
                        </div>
                    </div>
                </div>
                <!-- First Row -->

                <div class="text-center">
                    <button type="submit" class="btn btn-info">{{ trans('backend.update') }}</button>&nbsp;
                    <a href="{{ route('posts.index') }}" class="btn btn-danger"> <i class="fa fa-reply"></i> {{ trans('backend.back') }}</a>
                </div>

            </form>

        </div>
    </div>    

</div>

<!-- row closed -->
@endsection
@section('js')




<script>
$(document).ready(function(){

    
    //CKEDITOR.replace('content');

    $('.select2').select2();


    // Summernote Conent
    $('#summernote').summernote();
    

  // Validate Form ...
  $('#myForm').validate({
      rules : {
        title : { required : true , minlength: 10 },
        content : { required : true , minlength: 20 },
        category_id : { required : true },
        'tag[]' : { required : true }
        
      },
      messages : {

      },
      errorEelement : 'span',
      errorPlacement : function(error , element){
          
          element.closest('.form-group').append(error);
          
      },

  });

});
</script>
@endsection
