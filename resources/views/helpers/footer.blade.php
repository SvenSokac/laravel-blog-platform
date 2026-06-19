<footer class="bg-dark-secondary border-t border-accent-purple/20 mt-16">
    @include('sweetalert::alert')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-accent-purple to-accent-red rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold"><img src="{{ asset('images/logo.png') }}" alt="logo"></span>
                    </div>
                    <span class="text-lg font-bold text-light">Spezia</span>
                </div>
                <p class="text-light/60 text-sm">Connecting readers and writers worldwide</p>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-light font-bold mb-4">Navigation</h3>
                <ul class="space-y-2 text-light/60 text-sm">
                    <li><a href="/" class="hover:text-accent-purple transition-colors">Home</a></li>
                    <li><a href="/about" class="hover:text-accent-purple transition-colors">About</a></li>
                    <li><a href="/contact" class="hover:text-accent-purple transition-colors">Contact</a></li>
                    <li><a href="/register" class="hover:text-accent-purple transition-colors">Register</a></li>
                </ul>
            </div>

            <!-- Newsletter Subscription -->
            <div>
                <h3 class="text-light font-bold mb-4">Subscribe</h3>
                <p class="text-light/60 text-sm mb-3">Get weekly updates delivered to your inbox</p>
                <!-- Updated form to POST to subscription route with CSRF token -->
                <form action="{{ route('subscribe.store') }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="email" name="email" placeholder="Your email" required
                        class="flex-1 px-3 py-2 bg-dark border border-accent-purple/30 rounded text-light placeholder-light/50 text-sm focus:outline-none focus:border-accent-purple transition-colors">
                    <button type="submit"
                        class="px-4 py-2 bg-accent-purple text-white rounded font-medium hover:bg-accent-purple/80 transition-colors text-sm">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="border-t border-accent-purple/20 pt-8 text-center text-light/60 text-sm">
            <p>&copy; <?= date('Y')?> Spezia. All rights reserved.</p>
        </div>
    </div>
</footer>
