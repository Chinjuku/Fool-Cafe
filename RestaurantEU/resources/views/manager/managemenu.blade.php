@extends('layouts.app')
@section('title', 'Manager')
@section('page_name', 'จัดการเมนู')
@section('content')
<div class="h-screen bg-cream pt-[88px] laptop:pt-[67px]">
    <div class="bg-lightcream h-[956px] mx-[110px] laptop:mx-[85px] rounded-t-[100px] laptop:px-[65px] px-[90px] pt-[12px]">
        @livewire('menu-list', ['lazy' => true])
    </div>
</div>
@endsection
