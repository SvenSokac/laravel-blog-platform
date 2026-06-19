<!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-dark-secondary border-b border-accent-purple/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-accent-purple to-accent-red rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg"><img src="{{ asset('images/logo.png') }}" alt="logo"></span>
                    </div>
                    <span class="text-xl font-bold text-light hidden sm:inline">Spezia</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex gap-8">
                    <a href="/" class="nav-link text-light hover:text-accent-purple transition-colors">Home</a>
                    <a href="/about" class="nav-link text-light hover:text-accent-purple transition-colors">About</a>
                    <a href="/contact" class="nav-link text-light hover:text-accent-purple transition-colors">Contact</a>
                </div>

                <!-- Theme Toggle & Mobile Menu Button -->
                <div class="flex items-center gap-4">

                    <a href="/login" class="nav-link text-light hover:text-accent-purple bg-orange-300 rounded-xl p-2 text-md">Login</a>
                    <button id="themeToggle"
                        class="p-2 rounded-lg bg-dark hover:bg-dark-secondary transition-colors flex items-center gap-2"
                        title="Toggle theme">
                        <i class="fa-solid fa-circle-half-stroke"></i>
                        <span class="font-medium hidden sm:inline"></span>
                    </button>
                    <button id="mobileMenuBtn"
                        class="md:hidden p-2 rounded-lg bg-dark hover:bg-dark-secondary transition-colors"
                        title="Toggle mobile menu">
                        <i class="fa-brands fa-ethereum"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-accent-purple/20">
                <a href="/" class="block py-2 text-light hover:text-accent-purple transition-colors">Home</a>
                <a href="/about" class="block py-2 text-light hover:text-accent-purple transition-colors">About</a>
                <a href="/contact"class="block py-2 text-light hover:text-accent-purple transition-colors">Contact</a>
            </div>
        </div>
    </nav>
