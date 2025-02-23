  <!-- Updated Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="space-y-4">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-purple-400" viewBox="0 0 40 40">
                        <path fill="currentColor" d="M20 3.33a16.67 16.67 0 1 0 0 33.34 16.67 16.67 0 0 0 0-33.34zm-1.67 25h3.34v-3.33h-3.34V28.33zm0-6.66h3.34V11.67h-3.34v10z"/>
                    </svg>
                    <span class="text-xl font-bold ml-2">CelebrationHub</span>
                </div>
                <p class="text-gray-400">Making every moment memorable</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Features</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Pricing</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Legal</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Cookie Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Newsletter</h3>
                <p class="text-gray-400 mb-4">Stay updated with our latest features</p>
                <form class="flex">
                    <input type="email" placeholder="Enter your email" class="px-4 py-2 rounded-l-md w-full">
                    <button class="bg-purple-600 px-4 py-2 rounded-r-md hover:bg-purple-700">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; {{date('Y')}} MyAnniversary. All rights reserved.</p>
        </div>
    </div>
  </footer>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
      AOS.init({
          duration: 800,
          once: true
      });
  
      // FAQ Toggle
      document.querySelectorAll('.faq-item button').forEach(button => {
          button.addEventListener('click', () => {
              const content = button.nextElementSibling;
              const icon = button.querySelector('svg');
              content.classList.toggle('hidden');
              icon.classList.toggle('rotate-180');
          });
      });
  
      // Animate stats on scroll
      const stats = document.querySelectorAll('[data-count]');
      stats.forEach(stat => {
          const target = parseInt(stat.dataset.count);
          let current = 0;
          const increment = target / 50;
          const updateCount = () => {
              if(current < target) {
                  current += increment;
                  stat.textContent = Math.ceil(current).toLocaleString() + (stat.textContent.includes('%') ? '%' : '+');
                  requestAnimationFrame(updateCount);
              }
          };
          updateCount();
      });
  </script>
  @livewireScripts
  </body>
  </html>
  