@extends('layouts.app')

@section('content')
{{-- Container dengan padding-top agar tidak mepet ke header --}}
<div class="pt-6">
    
    {{-- Grid Statistik dengan gap yang lebih lega --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        
        {{-- Card Artikel --}}
        <div class="w-full">
            <x-company-profile.card-artikel />
        </div>

        {{-- Card Portofolio --}}
        <div class="w-full">
            <x-company-profile.card-portofolio />
        </div>

        {{-- Card Testimoni --}}
        <div class="w-full">
            <x-company-profile.card-testimoni />
        </div>

        {{-- Card Pending --}}
        <div class="w-full">
            <x-company-profile.card-pending />
        </div>

    </div>

</div>
@endsection