 @if (session()->has('success'))
     <div id="flash-message" class="fixed top-0 left-1/2 transform -reanslate-x-1/2 bg-laravel text-white">
         <p>{{ session('success') }}</p>
     </div>
 @endif

 <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script>
     $(document).ready(function() {
         $("#flash-message").fadeOut(3000); // Fade out in 3 seconds
     });
 </script>
