@extends('layouts.app')

@section('content')
    <div>
        <livewire:chat :conversationId="$conversationId" />
        {{-- @livewire('chat') --}}
    </div>
@endsection