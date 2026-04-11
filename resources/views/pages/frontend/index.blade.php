@extends('layouts.frontend')

@section('content')
    <div class="relative">
        @include('pages.frontend.sections.hero')
        
        <div class="bg-[#050505]">
            @include('pages.frontend.sections.services')
        </div>

        
        @include('pages.frontend.sections.portfolio-techstack')
        
        <div class="bg-[#050505]">
            @include('pages.frontend.sections.team')
        </div>

        @include('pages.frontend.sections.testimonial')
        @include('pages.frontend.sections.blog-faq')
    </div>
@endsection