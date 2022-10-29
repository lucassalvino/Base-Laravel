@extends('layouts.admin')

@section('content')

<script>
    jQuery(function($){
        if ($("#menu-status").length) {
            $("#menu-status").addClass('active');
            $("#menu-status > .sidebar-submenu").show();
        }
    });
</script>
@stop