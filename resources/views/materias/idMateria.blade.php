@extends("layouts.base")
@section("title", "")

@section("content")
    @livewire("materia-gestion", ["materia"=>$materia])
@endsection