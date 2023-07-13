@extends('layouts.custom-app')

    @section('styles')



    @endsection

    @section('class')

    <!-- BACKGROUND-IMAGE -->
    <div class="login-img">

    @endsection

        @section('content')

        <x-auth-session-status class="mb-4" :status="session('status')" />

        
                <!-- CONTAINER OPEN -->
                <div class="col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="{{asset('assets/images/brand/logo-white.png')}}" class="header-brand-img" alt="">
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                         <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <span class="login100-form-title pb-5">
                                Connexion
                            </span>
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                     
                                </div>
                                <div class="panel-body tabs-menu-body p-0 pt-5">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
 
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" /> 
                                                <x-text-input id="email" class="input100 form-control" placeholder="Email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
 
                                            </div>
                                            <div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
 
                                                <x-text-input  placeholder="Password" class="input100 form-control" id="password"  
                                                                type="password"
                                                                name="password"
                                                                required autocomplete="current-password" />

                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="text-end pt-4">
                                                <p class="mb-0"><a href="{{url('forgot-password')}}" class="text-primary ms-1">Mot de passe oublié</a></p>
                                            </div>
                                            <div class="container-login100-form-btn">
                                                
                                                <x-primary-button class="login100-form-btn btn-primary">
                                                    {{ __('Se connecter') }}
                                                </x-primary-button>
                                            </div>
                                            <div class="text-center pt-3">
                                                <p class="text-dark mb-0">Vous n'avez pas de compte?<a href="{{url('register')}}" class="text-primary ms-1">Créer votre compte</a></p>
                                            </div>
                                              
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
         @endsection

    @section('scripts')

    <!-- GENERATE OTP JS -->
    <script src="{{asset('assets/js/generate-otp.js')}}"></script>

    @endsection
