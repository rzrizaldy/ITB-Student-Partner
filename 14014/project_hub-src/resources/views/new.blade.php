@extends('layouts.master')

@section('head')

    <link rel="stylesheet" href="css/vendor/trix.css"/>
    <style>
        trix-editor {
            border: 1px solid rgba(0, 0, 0, .15);
            min-height: 200px;
        }
        /* Turn off trix toolbar buttons */
        button.code,
        button.decrease,
        button.heading-1,
        button.increase,
        button.link,
        button.quote,
        button.strike {
            display: none;
        }

    </style>
    <script type="text/javascript" src="js/vendor/trix.js"></script>

@stop

@section('content')

    <h1>Post a new project</h1>
        <p>Your project listing will remain on this site for 30 days. After 30 days your job listing will expire and be removed.</p>
    <hr>

    <form method="POST" action="{{ route('project.store') }}">
        <!-- Title -->
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Project title</label>

            <div class="col-sm-8">
                <input type="text" class="form-control" name="title" id="title" value="" required autofocus>
                <p class="form-text text-muted">"Cool Website" or "Custom Mobile Application"</p>
            </div>
        </div>

        <!-- Duration -->
        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label">Duration</label>

            <div class="col-sm-8">
                <input type="text" class="form-control" name="duration" value="" id="duration" required>
                <p class="form-text text-muted">"4 Months" or "1 Week"</p>
            </div>
        </div>

        <!-- Fee -->
        <div class="form-group row">
            <label for="city" class="col-sm-2 col-form-label">Fee</label>

            <div class="col-sm-8">
                <input type="text" class="form-control" name="fee" value="" id="fee" required>
                <p class="form-text text-muted">"Rp 2.000.000 - Rp5.000.000" or "-"</p>
            </div>
        </div>

        <!-- Description -->
        <div class="form-group row m-b-3">
            <div class="col-sm-10">
                <input type="hidden" id="description-hidden" name="description" value="">
                <label for="description">Project description</label>
                <trix-editor id="description" input="description-hidden" class="trix-content"></trix-editor>
            </div>
        </div>

        <!-- Contact -->
        <div class="form-group row">
            <label for="contact" class="col-sm-2 col-form-label">Contact</label>

            <div class="col-sm-8">
                <input type="text" class="form-control" name="contact" id="contact" value="" required>
                <p class="form-text text-muted">"nusa@ibah.net" or "+62 83874202221"</p>
            </div>
        </div>

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <!-- Submit button -->
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit your project listing</button>
            </div>
        </div>
    </form>


    
@stop
