<x-app-layout>
    <!-- Hero Section -->
    <div class="hero-gradient min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">Never Miss a Special Moment Again</h1>
                    <p class="text-xl mb-8">Automatically send heartfelt wishes to your loved ones on their special days. Birthdays, anniversaries, and celebrations made effortless.</p>
                    <a href="{{route('register')}}" class="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition">Start Celebrating Today</a>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <img src="/images/celebration.svg" alt="Celebration" class="w-full">
                </div>
            </div>
        </div>
    </div>

    <!-- Add Social Proof section before Features -->
<div class="bg-white py-12">
  <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-4 gap-8 text-center" data-aos="fade-up">
          <div class="stat-card">
              <h3 class="text-4xl font-bold text-purple-600 mb-2" data-count="15000">15,000+</h3>
              <p class="text-gray-600">Active Users</p>
          </div>
          <div class="stat-card">
              <h3 class="text-4xl font-bold text-purple-600 mb-2" data-count="100000">100,000+</h3>
              <p class="text-gray-600">Celebrations Tracked</p>
          </div>
          <div class="stat-card">
              <h3 class="text-4xl font-bold text-purple-600 mb-2" data-count="98">98%</h3>
              <p class="text-gray-600">Satisfaction Rate</p>
          </div>
          <div class="stat-card">
              <h3 class="text-4xl font-bold text-purple-600 mb-2" data-count="50000">50,000+</h3>
              <p class="text-gray-600">Wishes Sent</p>
          </div>
      </div>
  </div>
</div>
    <!-- Features Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16">Why Choose CelebrationHub?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg">
                    <i class="fas fa-calendar-check text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-4">Smart Reminders</h3>
                    <p>Never forget important dates with our intelligent reminder system</p>
                </div>
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg">
                    <i class="fas fa-envelope-open-text text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-4">Personalized Messages</h3>
                    <p>Create custom messages that reflect your personality and relationship</p>
                </div>
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg">
                    <i class="fas fa-chart-line text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-bold mb-4">Smart Dashboard</h3>
                    <p>Track all celebrations and analyze your connections in one place</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16">What Our Users Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial cards here -->
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-purple-600 py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">Ready to Start Celebrating?</h2>
            <p class="text-white text-xl mb-8">Join thousands of users who never miss a special moment</p>
            <a href="{{route('register')}}" class="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition">Get Started Free</a>
        </div>
    </div>

    <!-- FAQ Section before Footer -->
<div class="bg-gray-50 py-20">
  <div class="max-w-3xl mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
      <div class="space-y-6" data-aos="fade-up">
          <div class="faq-item bg-white rounded-lg p-6 shadow-sm">
              <button class="flex justify-between items-center w-full">
                  <span class="font-semibold text-lg">How does the automatic reminder system work?</span>
                  <svg class="w-6 h-6 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
              </button>
              <div class="mt-3 hidden">
                  <p class="text-gray-600">Our system checks your contacts' special dates daily and automatically sends personalized wishes via email or SMS at the perfect time.</p>
              </div>
          </div>
          <!-- Add more FAQ items following the same structure -->
      </div>
  </div>
</div>

</x-app-layout>