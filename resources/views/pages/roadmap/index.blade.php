@extends('layouts.main')
@section('title', 'Project Roadmap')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h3 class="text-dark mb-3">Roadmap</h3>
          </div>
        </div>
        <div class="row">
          <div class="col p-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item">
                  <a href="{{ route('my-project.index') }}">My Project</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Roadmap
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
            <div id="gantt_here" style='width:100%; height:100%;'></div>
        </div>
      
    
</div>
</div>
</section>

</div>






@endsection

@push('addon-style')
<link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
<style type="text/css">
    
    html, body{
        height:100%;
        padding:0px;
        margin:0px;
        overflow: hidden;
    }
    
    
</style>
@endpush

@push('addon-script')
<script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
<script type="text/javascript">
    
    gantt.init("gantt_here");
    
</script>
@endpush