 <header class="padding-header" id="header">
     <div class="container">
         <div class="inner-header">
             <div class="logo">
                 <a href="{{ route('home') }}"><img src="{{ asset('assets/images/Group 1429918.svg') }}"></a>
             </div>
             <nav id="nav" class="menusflex">
                 <ul>
                     <li class="active">
                         <a href="{{ route('home') }}">HOME</a>
                     </li>
                     <li>
                         <a href="{{ route('aboutUs') }}">ABOUT</a>
                     </li>
                     <li>
                         <a href="{{ route('contactUs') }}">CONTACT</a>
                     </li>
                     <li>
                         <a href="{{ route('service') }}">SERVICES</a>
                     </li>
                 </ul>
             </nav>
             <div class="quote-btn">
                 <a href="{{env('APP_URL')}}login"><img src="{{ asset('assets/images/login-1.svg') }}">LOGIN</a> /
                 <a href="{{env('APP_URL')}}select-role">SIGN-UP</a>
             </div>
             <div class="three col">
                 <div class="hamburger" id="hamburger-6">
                     <span class="line"></span>
                     <span class="line"></span>
                     <span class="line"></span>
                 </div>
             </div>
         </div>
     </div>
 </header>
