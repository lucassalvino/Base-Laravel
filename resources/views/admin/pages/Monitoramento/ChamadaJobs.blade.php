@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
    </div>
</div>

<script>
    jQuery(function($){
        if ($("#menu-status").length) {
            $("#menu-status").addClass('active');
            $("#menu-status > .sidebar-submenu").show();
        }
        $(document).ready(function(){
        });
    });
</script>
@stop
