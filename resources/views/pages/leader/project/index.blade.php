@extends('layouts.leader')
@section('title', 'Projects')

@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <h3 class="text-dark mb-2">All Projects</h3>
        {{-- <p class="text-muted" style="font-size: 16px;">Project Overview </p> --}}
      </div>
      
    </div>
    
    <div class="categories mt-5">
      <ul>
        <li data-filter="*" class="active">
          <a href="#" >All Status</a>
        </li>
        <li data-filter=".pending">
          <a href="#" >Pending</a>
        </li>
        <li data-filter=".in-progress">
          <a href="#" >In Progress</a>
        </li>
        <li data-filter=".completed">
          <a href="#" >Completed</a>
        </li>
        <li data-filter=".abandoned">
          <a href="#" >Abandoned</a>
        </li>
      </ul>
    </div>
    
    <div class="row mt-4 project-item">
      @foreach ($items as $item)
      <div class="col-12 col-md-4 col-lg-4 item
      @if($item->project_status == 'Pending')
          pending
          @elseif($item->project_status == 'In Progress')
          in-progress
          @elseif($item->project_status == 'Completed')
          completed
          @elseif($item->project_status == 'Abandoned')
          abandoned
      @endif
      ">
        <article class="article article-style-c">
          <div class="article-header">
            <div class="article-image" 
            @if ($item->project_logo == null)
            data-background="{{ asset('assets/img/no-image.png') }}"
            @else
            data-background="{{ Storage::url($item->project_logo)}}"
            @endif>
          </div>
        </div>
        <div class="article-details">
          <div class="article-category mb-3">
            <div class="badge @if($item->project_status == 'Pending')
              badge-light
              @elseif($item->project_status == 'In Progress')
              badge-secondary
              @elseif($item->project_status == 'Completed')
              badge-success
              @elseif($item->project_status == 'Abandoned')
              badge-danger
              @endif">
              {{ $item->project_status }}</div>
            </div>
            <div class="article-title">
              <h6>{{ $item->project_name }}</h6>
            </div>
            <p>{!! Str::limit($item->description,100,'<a id="readMore" href="#" class="text-decoration-none text-small">...Read More</a>') !!}
            </p>
            <p class="card-text mb-1 text-black-50" style="font-size: 14px;">
              <i class="fa fa-clock"></i> Due Date : 
              {{ Carbon\Carbon::create($item->end)->format('d  F  Y') }}
            </p>
            <p
            class="card-text mb-1 text-black-50"
            style="font-size: 14px;"
            >
            <i class="fa fa-calendar-alt"></i> Working Days : 
            {{ Carbon\Carbon::parse($item->start)->diffInBusinessDays(Carbon\Carbon::parse($item->end)->endOfDay()) }} Days
          </p>
          <div class="article-user">
            <img alt="image" src="https://ui-avatars.com/api/?name={{ $item->user->name }}">
            <div class="article-user-details">
              <div class="user-detail-name">
                {{ $item->user->name }}
              </div>
              <div class="text-job">Project Manager</div>
            </div>
          </div>
          <div class="article-user">
            <p class="mb-1">Project Member</p>
            @foreach ($item->project_member->take(7) as $member)
            <img data-toggle="tooltip" data-original-title="{{ $member->user->name }}" src="https://ui-avatars.com/api/?name={{ $member->user->name }}" height="35" class="w-auto" style="margin-right: -4px">
            
            @endforeach
            @if($item->project_member->count() > 0)
            
            <a class="bg-primary text-light"
            href="#modalMember"
            data-remote="{{ route('show-member-leader',$item->id) }}"
            data-toggle="modal"
            data-target="#modalMember"
            data-title="List Member"
            style="margin-left: -2px; border-radius: 100px; padding: 5px 8px 5px 4px; position:absolute;">
            <i class="fas fa-users"></i>
          </a>
          @else
          No Member
          @endif
        </div>
        <div class="row mt-4">
          <div class="col-12 d-flex justify-content-center">
            <a href="{{ route('project-board-leader',$item->id) }}" class="btn btn-primary btn-sm mr-3">Board</a>
            <a href="{{ route('project-roadmap-leader', $item->id) }}" class="btn btn-warning btn-sm">Roadmap</a>
            <a href="{{ route('project-file-leader',$item->id) }}" class="btn btn-info btn-sm ml-3">Project File</a>
          </div>
        </div>
      </div>
    </article>
  </div>
  @endforeach
</div>

</section>
</div>


@endsection

@push('addon-script')
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>

<script>
  $(document).ready(function(){
    // Background
    $("[data-background]").each(function () {
      var me = $(this);
      me.css({
        backgroundImage: "url(" + me.data("background") + ")"
      });
    });
    
    
    $('.project-item').isotope({
      itemSelector: '.item',
      layoutMode: 'fitRows'
    });
    $('.categories ul li').click(function () {
      $('.categories ul li').removeClass('active');
      $(this).addClass('active');
      
      var selector = $(this).attr('data-filter');
      $('.project-item').isotope({
        filter: selector
      });
      return false;
    });
  })
</script>

@endpush