@extends('layouts.leader')
@section('title', 'Project Overview')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">Project Overview (Travellz)</h3>
        {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
      </div>  
    </div>
    
    
    <div class="row">
      <div class="col p-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item">
              <a href="{{ route('project-leader') }}">Project</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Overview
            </li>
          </ol>
        </nav>
      </div>
    </div>
    
    
  </section>
</div>


@endsection

