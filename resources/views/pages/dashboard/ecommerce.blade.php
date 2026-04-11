@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-4 md:gap-6">
    <div class="col-span-12 space-y-6 xl:col-span-7">
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 md:gap-4">
            <x-company-profile.card-artikel />
            <x-company-profile.card-portofolio />
            <x-company-profile.card-testimoni />
            <x-company-profile.card-pending />
        </div>
        
    </div>

</div>
@endsection