 <footer id="footer">
     <div class="container">
         <div class="footer-quiz">
             <h6>Want to get hired or make A hire? </h6>
             <a href="#">take the quiz</a>
         </div>
         <div class="footer-flex flex">
             <div class="footer-pages footer-data flex">
                 <ul>
                     <li> <a href="#">Company</a> </li>
                     <li> <a href="{{ route('aboutUs') }}">About</a> </li>
                     <li> <a href="#">Features</a> </li>
                     <li> <a href="#">Works</a> </li>
                     <li> <a href="#">Career</a> </li>
                 </ul>
             </div>
             <div class="social-links footer-data flex">
                 <ul>
                     <li> <a href="#">Help</a> </li>
                     <li> <a href="#">Customer Support</a> </li>
                     <li> <a href="#">Delivery Details</a> </li>
                     <li> <a href="#">Terms & Conditions</a> </li>
                     <li> <a href="#">Privacy Policy</a> </li>
                 </ul>
             </div>
             <div class="footer-pages footer-data flex">
                 <ul>
                     <li> <a href="#">Resources</a> </li>
                     <li> <a href="#">Free eBooks</a> </li>
                     <li> <a href="#">Development Tutorial</a> </li>
                     <li> <a href="#">How to - Blog</a> </li>
                     <li> <a href="#">Youtube Playlist</a> </li>
                 </ul>
             </div>
             <div class="footer-pages footer-data flex">
                 <ul>
                     <li> <a href="#">Extra Links</a> </li>
                     <li> <a href="#">Customer Support</a> </li>
                     <li> <a href="#">Delivery Details</a> </li>
                     <li> <a href="#">Terms & Conditions</a> </li>
                     <li> <a href="#">Privacy Policy</a> </li>
                 </ul>
             </div>
         </div>
         <div class="footer-last flex">
             <div class="footer-logo">
                 <img src="{{ asset('assets/images/footer-logo.svg') }}">
             </div>
             <p>Copyright &copy; {{date('Y')}}, chirrrp.</p>
             <div class="Privacy flex">
                 <a href="#"><img src="{{ asset('assets/images/1.svg') }}"></a>
                 <a href="#"><img src="{{ asset('assets/images/2.svg') }}"></a>
                 <a href="#"><img src="{{ asset('assets/images/3.svg') }}"></a>
                 <a href="#"><img src="{{ asset('assets/images/4.svg') }}"></a>
             </div>
         </div>
     </div>
 </footer>
