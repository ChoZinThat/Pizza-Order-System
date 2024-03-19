@extends('user.layouts.master')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-dark text-white pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST" action="{{route('user#contactSent')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{Auth::user()->id}}" >

                        <div class="control-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name"
                                value="{{old('name',Auth::user()->name)}}" data-validation-required-message="Please enter your name" disabled/>
                            <p class="help-block text-danger">
                            </p>
                        </div>

                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email"
                            value="{{old('email',Auth::user()->email)}}" data-validation-required-message="Please enter your email" disabled/>
                            <p class="help-block text-danger">
                            </p>
                        </div>

                        <div class="control-group">
                            <input type="text" class="form-control  @error('subject') is-invalid @enderror" name="subject" placeholder="Subject"
                                 data-validation-required-message="Please enter a subject" value="{{old('subject')}}"/>
                            <p class="help-block text-danger">
                                @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>

                        <div class="control-group">
                            <textarea class="form-control @error('message') is-invalid @enderror" rows="8" name="message" placeholder="Message"
                                data-validation-required-message="Please enter your message" >{{old('message')}}</textarea>
                            <p class="help-block text-danger">
                                @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </p>
                        </div>

                        <div>
                            <button class="btn btn-warning py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-warning mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-warning mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-warning mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

