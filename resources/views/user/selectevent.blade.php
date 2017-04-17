@extends('layouts.profile')

@section('content')

  <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <div class="post-img-content">   
                                    <img src="{{asset($event->image)}}" style= "width:290px ;height:200px"; border-radius:50% ;>
                                </div>
                                <br>
                                <div style="height:100px;width:320px ;  word-break:break-all">
                                <p><strong>{{$event->title}}</strong></p>
                                </div>
                                <a href="{{URL('event_details')}}/{{Auth::user()->id}}" type="button" class="btn btn-default" id="details" name="details" style="margin-right:10px">Show details</a>
                                <a href="{{URL('/edit')}}/{{$event->id}}" type="button" class="btn btn-default" id="details" name="details">Edit Event</a>

                                <a href="{{URL('delete')}}/{{$event->id}}"><i class="fa fa-trash fa-2x" aria-hidden="true" style="color:red; margin-left:10px"></i></a> 
                            </div> <br>
                        </div> 
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection