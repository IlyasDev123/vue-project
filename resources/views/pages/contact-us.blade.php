 @extends('pages.layouts.master')
 @section('content')
     <section class="about-banner">
         <div class="container">
             <div class="about-banner-main">
                 <div class="about-b-text">
                     <h2>Services</h2>
                     <div class="about-link">
                         <a href="#.">Services /</a>
                         <a href="#.">Employer Reference Guide</a>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- banner -->
     <!-- refrence -->
     <section class="refrences">
         <div class="container">
             <div class="refrence-main">
                 <div class="refrence-text">
                     <span>Employer Costs & Agreement</span>
                     <h2>Signing up & utilizing the Chirrrp Matching system</h2>
                     <p>Signing up & utilizing the Chirrrp Matching system is completely free of
                         cost for both employers & talent! We believe in creating partnerships,
                         not contracts which is why we're a risk-free, no upfront-cost Staffing
                         service</p>
                     <a href="#.">Read more<img src="{{ asset('assets/images/right.svg') }}"></a>
                 </div>
                 <div class="refrence-text">
                     <span>Contracted VS Direct-Placement</span>
                     <div class="ref-t">
                         <p>Our Chirrrp website is currently built for direct-placement/non-contracted
                             hiring needs. Our team does have the ability to create a contract-to-hire
                             hiring plan if your needs require it. Please Contact us for any contracted
                             hiring needs & we'll be more than happy to curate a plan for your team.</p>
                     </div>
                 </div>
                 <div class="refrence-text">
                     <span>We Respect Your Privacy</span>
                     <div class="ref-t">
                         <p>Signing up with Chirrrp doesn't mean that your data & information is
                             immediately accessible to any talent or 3rd party companies. All sensitive
                             information such as your email, phone number, last name etc. are not
                             provided to the talent unless you provide it to them yourself.</p>
                         <a href="#.">Read more<img src="{{ asset('assets/images/right.svg') }}"></a>
                     </div>
                 </div>
                 <div class="refrence-text">
                     <span>The Chirrrp Difference</span>
                     <div class="ref-t">
                         <p>Employers choose to work with Chirrrp because of our belief that matching with talent should be more than just their experience & skillset. We provide the tools to get to know a little more about your next potential hire before you even sit down to interview them.</p>
                         <a href="#.">Read more<img src="{{ asset('assets/images/right.svg') }}"></a>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- refrence -->
 @endsection
