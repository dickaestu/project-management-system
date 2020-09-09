@extends('layouts.main')
@section('title', 'Project Board')

@section('content')
<div class="main-content">
          <section class="section">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-dark mb-3">Dashboard</h3>
                    <p class="text-muted" style="font-size: 16px;">Task Overview </p>
                </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4 car">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h2 class="font-18">102</h2>
                            <h2 class="mb-3 font-15">New Task</h2>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="{{ asset('assets/img/banner/5.png') }}" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h2 class="font-18">112</h2>
                            <h2 class="mb-3 font-15">Ongoing Task</h2>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="{{ asset('assets/img/banner/6.png') }}"  alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h5 class="font-18">456</h5>
                            <h2 class="mb-3 font-15">Completed Tasks</h2>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="{{ asset('assets/img/banner/7.png') }}"  alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h2 class="font-18">132</h2>
                            <h2 class="mb-3 font-15">Completed Project</h2>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="{{ asset('assets/img/banner/8.png') }}"  alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <p class="text-muted" style="font-size: 14px;">Due Tasks </p>
                  </div>
                  <div class="card-body">
                    <span class="badge badge-pill badge-secondary" style="justify-content: space-between;">UI/UX Design</span>
                    <h5 class="card-title mb-3">Absensi PT Anugrah</h5>
                    <p class="card-text text-black-50" style="font-size: 14px;">
                        <i class="fa fa-clock"></i> Due Date : 5 day 5 hours 46 minutes
                    </p>
                    <p class="card-text text-black" style="line-height: 18px;">
                        This is a wider card with supporting text 
                        below as a natural lead-in to additional
                        content. This content is a little bit longer.
                    </p>
                  </div>
                  <div class="card-footer">
                    <i class="fas fa-bars" style="padding-right: 10px;"> 
                        5/6 Task 
                    </i>
                    <i class="fas fa-comment">
                        35
                    </i>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <p class="text-muted" style="font-size: 14px;">In Progress Tasks </p>
                  </div>
                  <div class="card-body">
                    <span class="badge badge-pill badge-secondary">UI/UX Design</span>
                    <h5 class="card-title mb-3">Absensi PT Anugrah</h5>
                    <p class="card-text text-black-50" style="font-size: 14px;">
                        <i class="fa fa-clock"></i> Due Date : 5 day 5 hours 46 minutes
                    </p>
                    <p class="card-text text-black" style="line-height: 18px;">
                        This is a wider card with supporting text 
                        below as a natural lead-in to additional
                        content. This content is a little bit longer.
                    </p>
                  </div>
                  <div class="card-footer">
                    <i class="fas fa-bars" style="padding-right: 10px;"> 
                        5/6 Task 
                    </i>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <p class="text-muted" style="font-size: 14px;">Completed Tasks </p>
                  </div>
                  <div class="card-body">
                    <span class="badge badge-pill badge-secondary">Front End Developer</span>
                    <h5 class="card-title mb-3">Absensi PT Anugrah</h5>
                    <p class="card-text text-black-50" style="font-size: 14px;">
                        <i class="fa fa-clock"></i> Due Date : 5 day 5 hours 46 minutes
                    </p>
                    <p class="card-text text-black" style="line-height: 18px;">
                        This is a wider card with supporting text 
                        below as a natural lead-in to additional
                        content. This content is a little bit longer.
                    </p>
                  </div>
                  <div class="card-footer">
                    <i class="fas fa-bars" style="padding-right: 10px;"> 
                        5/6 Task 
                    </i>
                  </div>
                </div>
              </div>
                    
            </div>
            <p class="text-muted" style="font-size: 16px;">Completed Projects </p>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <span class="badge badge-pill badge-secondary" style="justify-content: space-between;">Website</span>
                        <h5 class="card-title mb-3">Fitur Chat</h5>
                        <p class="card-text text-black" style="line-height: 18px;">
                            Sebuah desain fitur chat yang terdapat voice note,
                             add attachment, broadcast message, membuat grup.
                        </p>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-bars" style="padding-right: 15px;"> 
                            20/20 Task 
                        </i>
                        <i class="fas fa-comment" style="padding-right: 15px;">
                            35
                        </i>
                        <i class="fas fa-check-square">
                            12 January 2020
                        </i>
                      </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <span class="badge badge-pill badge-secondary" style="justify-content: space-between;">Android</span>
                        <h5 class="card-title mb-3">Fitur Chat</h5>
                        <p class="card-text text-black" style="line-height: 18px;">
                            Sebuah desain fitur chat yang terdapat voice note,
                             add attachment, broadcast message, membuat grup.
                        </p>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-bars" style="padding-right: 15px;"> 
                            20/20 Task 
                        </i>
                        <i class="fas fa-comment" style="padding-right: 15px;">
                            35
                        </i>
                        <i class="fas fa-check-square">
                            12 January 2020
                        </i>
                      </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <span class="badge badge-pill badge-secondary" style="justify-content: space-between;">iOS</span>
                        <h5 class="card-title mb-3">Fitur Chat</h5>
                        <p class="card-text text-black" style="line-height: 18px;">
                            Sebuah desain fitur chat yang terdapat voice note,
                             add attachment, broadcast message, membuat grup.
                        </p>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-bars" style="padding-right: 15px;"> 
                            20/20 Task 
                        </i>
                        <i class="fas fa-comment" style="padding-right: 15px;">
                            35
                        </i>
                        <i class="fas fa-check-square">
                            12 January 2020
                        </i>
                      </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

