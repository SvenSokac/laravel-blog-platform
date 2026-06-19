@include('helpers.head')

@include('sweetalert::alert')
<body class="bg-dark text-light transition-colors duration-300">
    @include('helpers.navbar')

    <!-- Main Content -->
    <main class="min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl md:text-5xl font-bold text-light mb-8">Contact Us</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-dark-secondary rounded-lg p-6 border border-accent-purple/20">
                    <h3 class="text-lg font-bold text-light mb-4">Get in Touch</h3>
                    <div class="space-y-4 text-light/70">
                        <div>
                            <p class="font-medium text-light">Email</p>
                            <p>hello@spezia.com</p>
                        </div>
                        <div>
                            <p class="font-medium text-light">Phone</p>
                            <p>+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <p class="font-medium text-light">Address</p>
                            <p>123 Creative Street<br>San Francisco, CA 94105</p>
                        </div>
                    </div>
                </div>

                <div class="bg-dark-secondary rounded-lg p-6 border border-accent-purple/20">
                    <h3 class="text-lg font-bold text-light mb-4">Business Hours</h3>
                    <div class="space-y-2 text-light/70">
                        <div class="flex justify-between">
                            <span>Monday - Friday</span>
                            <span>9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Saturday</span>
                            <span>10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sunday</span>
                            <span>Closed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <!-- Use Laravel form with CSRF token and validation -->
            <form action="{{ route('contact.store') }}" method="POST" class="bg-dark-secondary rounded-lg p-8 border border-accent-purple/20 space-y-6">
                @csrf
                <h2 class="text-2xl font-bold text-light mb-6">Send us a Message</h2>

                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500 rounded-lg p-4 mb-6">
                        <ul class="text-red-400 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="name" class="block text-light font-medium mb-2">Full Name</label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}" class="w-full px-4 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light placeholder-light/50 focus:outline-none focus:border-accent-purple transition-colors">
                </div>

                <div>
                    <label for="email" class="block text-light font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light placeholder-light/50 focus:outline-none focus:border-accent-purple transition-colors">
                </div>

                <div>
                    <label for="phone" class="block text-light font-medium mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" class="w-full px-4 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light placeholder-light/50 focus:outline-none focus:border-accent-purple transition-colors">
                </div>

                <div>
                    <label for="message" class="block text-light font-medium mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" required class="w-full px-4 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light placeholder-light/50 focus:outline-none focus:border-accent-purple transition-colors resize-none">{{ old('message') }}</textarea>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" id="subscribe" name="subscribe" value="1" class="w-4 h-4 rounded border-accent-purple/30 text-accent-purple focus:ring-accent-purple">
                    <label for="subscribe" class="text-light/70">Subscribe to our weekly newsletter</label>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-accent-purple to-accent-red dark:text-white text-gray-500 font-bold py-3 rounded-lg hover:shadow-lg hover:shadow-accent-purple/50 transition-all duration-300">
                    Send Message
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    @include('helpers.footer')
    @include('helpers.scripts')
</body>

</html>
