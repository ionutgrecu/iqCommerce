@extends('layout.main')

@section('content')
<div class="main-container error404">
    <div class="entry-header">
        <h1>Oops ! <?=$exception->getMessage()?:'That Page Can\'t Be Found.'?></h1>
    </div>
    <div class="image-404"><img src="http://demo.roadthemes.com/saharan_digital/wp-content/uploads/2015/07/img404.png" alt=""></div>
    <div class="form404-wrapper">
        <div class="container">
            <a href="http://demo.roadthemes.com/saharan_digital/" title="Back to homepage">Back to homepage</a>
        </div>
    </div>
</div>
@endsection