            <!--app-sidebar-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <div class="app-sidebar">
                    <div class="side-header">
                        <a class="header-brand1" href="{{url('mv_international_home')}}">
                            <img src="../assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="../assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                            <img src="../assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                            <img src="../assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Accueil</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{url('mv_international_home')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                            </li>
                           
                            <li class="sub-category">
                                <h3>Paramétrage</h3>
                            </li>
                            
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">Paramétrage</span><span class="badge bg-pink side-badge">3</span><i class="angle fe fe-chevron-right hor-angle"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Paramétrage</a></li>
                                    <li><a href="{{url('type_organisations')}}" class="slide-item">Type Organisation</a></li>
                                    <li><a href="{{url('organisations')}}" class="slide-item">Organisation</a></li>
                                    <li><a href="{{url('type_composants')}}" class="slide-item">Type de composant</a></li>
                                    <li><a href="{{url('composants')}}" class="slide-item">Composant</a></li>
                                    <li><a href="{{url('roles')}}" class="slide-item">Role</a></li>
                                    <li><a href="{{url('users')}}" class="slide-item">Utilisateur</a></li>
                                    <li><a href="{{url('documents')}}" class="slide-item">Document</a></li>
                                    <li><a href="{{url('statuts')}}" class="slide-item">Statut</a></li>
                                    <li><a href="{{url('workflows')}}" class="slide-item">workflow</a></li>
                                    <li><a href="{{url('parametres')}}" class="slide-item">parametre</a></li>
                                </ul>
                            </li>
                            

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-map-pin"></i><span class="side-menu__label">Localité</span><span class="badge bg-pink side-badge">4</span><i class="angle fe fe-chevron-right hor-angle"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Localité</a></li>
                                    <li><a href="{{url('payss')}}" class="slide-item"> Pays</a></li>
                                    <li><a href="{{url('villes')}}" class="slide-item"> Ville</a></li>
                                </ul>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Referentiel</span><span class="badge bg-pink side-badge">4</span><i class="angle fe fe-chevron-right hor-angle"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Referentiel</a></li>
                                    <li><a href="{{url('genres')}}" class="slide-item">Genre</a></li>
                                    <li><a href="{{url('categories')}}" class="slide-item">Catégories</a></li>
                                    <li><a href="{{url('temoignages')}}" class="slide-item">Témoignage</a></li>
                                </ul>
                            </li>


                            <li class="sub-category">
                                <h3>Prière 24 Congo</h3>
                            </li>

                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-folder"></i><span class="side-menu__label">Procédure</span><span class="badge bg-pink side-badge">2</span><i class="angle fe fe-chevron-right hor-angle"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Procédure</a></li>
                                    <li><a href="{{url('entreprises')}}" class="slide-item"> Entreprise</a></li>
                                </ul>
                            </li>

                            <li class="sub-category">
                                <h3>Misc Pages</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Authentication</span><i class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Authentication</a></li>
                                    <li><a href="{{url('login')}}" class="slide-item"> Login</a></li>
                                    <li><a href="{{url('register')}}" class="slide-item"> Register</a></li>
                                    <li><a href="{{url('forgot-password')}}" class="slide-item"> Forgot Password</a></li>
                                    <li><a href="{{url('lockscreen')}}" class="slide-item"> Lock screen</a></li>
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span class="sub-side-menu__label">Error Pages</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            <li><a href="{{url('error400')}}" class="sub-slide-item"> 400</a></li>
                                            <li><a href="{{url('error401')}}" class="sub-slide-item"> 401</a></li>
                                            <li><a href="{{url('error403')}}" class="sub-slide-item"> 403</a></li>
                                            <li><a href="{{url('error404')}}" class="sub-slide-item"> 404</a></li>
                                            <li><a href="{{url('error500')}}" class="sub-slide-item"> 500</a></li>
                                            <li><a href="{{url('error503')}}" class="sub-slide-item"> 503</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
                    </div>
                </div>
                <!--/APP-SIDEBAR-->
            </div>
            <!--app-sidebar-->
