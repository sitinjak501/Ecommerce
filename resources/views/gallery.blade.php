@extends('layout.themplate')

@section('title', 'Melodi Chord')

@section('content')


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
	<video width="380px" height="640px" controls>
		<source src="{{asset('asset/img/video3.mp4')}}" type="video/mp4">
    </video>

    <video  width="380px" height="640px" controls>
        <source  src="{{asset('asset/img/video4.mp4')}}" type="video/mp4">
    </video>
    
    <video width="380px" height="640px" controls>
        <source src="{{asset('asset/img/video5.mp4')}}" type="video/mp4">
	</video>

    <video width="380px" height="640px" controls>
        <source src="{{asset('asset/img/video6.mp4')}}" type="video/mp4">
	</video>

    <video width="380px" height="640px" controls>
        <source src="{{asset('asset/img/video7.mp4')}}" type="video/mp4">
	</video>

    <video width="380px" height="640px" controls>
        <source src="{{asset('asset/img/video8.mp4')}}" type="video/mp4">
	</video>
     
    <video width="572px" height="350px" controls>
        <source src="{{asset('asset/img/video1l.mp4')}}" type="video/mp4">
	</video>

    <video width="572px" height="350px" controls>
        <source src="{{asset('asset/img/video2l.mp4')}}" type="video/mp4">
	</video>


            </div>
        </div>
    </div>

@endsection
