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
                                <p><strong>{{$event->title}}</strong></p>
                               
                                <a href="{{URL('details')}}/{{$event->id}}" type="button" class="btn btn-default" id="details" name="details" style="margin-right:10px">Show details</a>
                                
                            </div> <br>
                        </div> 
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection