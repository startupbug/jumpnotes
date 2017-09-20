@extends('masterlayout')
@section('content')

<div class="meet-with">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <form action="{{route('updatePass')}}" method="post">

                        <div class="form-group">
                            <label  class="sel-title">New Password</label>
                            <span class="user_password text-danger"></span>
                            <input type="password" name="new_password" id="user_password" placeholder="Enter New Password" required/>
                        </div>
                        <input type="hidden" name="rem_token" value="{{$token}}"/>
							
                        <input type="hidden" name="_token" value="{{ Session::token()  }}"/>
                        {{--<div class="col-md-12">--}}
                            {{--<a href="#forgotModel" data-toggle="modal" data-target="#forgotModel"><strong> Forgot Password ? </strong></a>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <input type="submit" name="submit" value="submit" class="btn btn-primary paym"/>
                        </div>

                    </form>
                    </div>
                    </div>
                    </div>
                    </div>


@endsection
