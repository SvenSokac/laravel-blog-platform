@include('helpers.head')

<body class="bg-dark text-light transition-colors duration-300">
    @include('helpers.navbar')

    <!-- Main Content -->
    <main class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl md:text-5xl font-bold text-light mb-8">About Spezia</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <div>
                    <!-- Display about page content from database -->
                    <p class="text-lg text-light/70 mb-6">
                        {{ $about->description ?? 'Spezia is an innovative blogging platform that connects readers and writers from around the world.' }}
                    </p>
                    <p class="text-lg text-light/70 mb-6">
                        {{ $about->mission ?? 'We believe in the power of storytelling to bridge cultures and create meaningful connections across borders.' }}
                    </p>
                    <p class="text-lg text-light/70">
                        {{ $about->vision ?? 'Founded in 2024, Spezia has grown to serve thousands of readers and writers across 50+ countries.' }}
                    </p>
                </div>
                <div class="w-full rounded-lg border border-accent-purple/30 overflow-hidden">
                <img src="{{ asset('images/location.png') }}" alt=""></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-4">
                @if($about && $about->stats)
                    @foreach($about->stats as $stat)
                        <div class="bg-dark-secondary rounded-lg p-6 border border-accent-purple/20 text-center">
                            <h3 class="text-3xl font-bold text-{{ $stat['color'] }} mb-2">{{ $stat['value'] }}</h3>
                            <p class="text-light/70">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="bg-dark-secondary rounded-lg p-6 border border-accent-purple/20 text-center">
                        <h3 class="text-3xl font-bold text-accent-purple mb-2">16+</h3>
                        <p class="text-light/70">Countries Represented</p>
                    </div>
                    <div class="bg-dark-secondary rounded-lg p-6 border border-accent-purple/20 text-center">
                        <h3 class="text-3xl font-bold text-accent-purple mb-2"><a href="/location">View Full Map</a></h3>
                        <p class="text-light/70"><a href="/location">Click to View >></a></p>
                    </div>
                @endif
            </div>

            <div class="bg-dark-secondary rounded-lg p-8 border border-accent-purple/20 mb-12">
                <h2 class="text-2xl font-bold text-light mb-4">Our Features</h2>
                <ul class="space-y-3 text-light/70">
                    @if($about && $about->features)
                        @foreach($about->features as $feature)
                            <li class="flex items-start gap-3">
                                <span class="text-accent-purple font-bold">✓</span>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    @else
                        <li class="flex items-start gap-3">
                            <span class="text-accent-purple font-bold">✓</span>
                            <span>Interactive world map showing reader locations</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-accent-purple font-bold">✓</span>
                            <span>Rich blog posts with multiple images and media</span>
                        </li>
                    @endif
                </ul>
            </div>


        </div>
    </main>

    <!-- Footer -->
    @include('helpers.footer')
    @include('helpers.scripts')
</body>

</html>
