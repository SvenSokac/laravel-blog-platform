@include('helpers.head')

<body class="bg-dark text-light transition-colors duration-300">
    @include('helpers.navbar')

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-accent-purple/10 to-accent-red/10 py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-base md:text-lg text-light/70">Welcome to Your #1 Blog Site</h3>
            <p class="text-base md:text-lg text-light/70">Discover stories from around the world</p>
        </div>
    </section>

    <!-- Main Content with Sidebar Layout -->
    <main class="min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar for Desktop (>768px) -->
                <aside class="hidden lg:block w-64 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <!-- Search Bar -->
                        <div class="space-y-2">
                            <label class="text-light font-semibold text-sm">Search</label>
                            <div class="flex gap-2">
                                <input type="text" id="searchInput" placeholder="Search articles..."
                                    class="flex-1 px-3 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light placeholder-light/50 text-sm focus:outline-none focus:border-accent-purple transition-colors">
                                <button id="searchBtn"
                                    class="px-3 py-2 bg-gradient-to-r from-accent-purple to-accent-red text-gray-500 font-bold rounded-lg hover:shadow-lg hover:shadow-accent-purple/50 transition-all duration-300 text-sm">Go</button>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="space-y-2">
                            <label class="text-light font-semibold text-sm">Categories</label>
                            <select id="categoryFilter"
                                class="w-full px-3 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light text-sm focus:outline-none focus:border-accent-purple transition-colors">
                                <option value="">All Categories</option>
                                <option value="travel">Travel</option>
                                <option value="lifestyle">Lifestyle</option>
                                <option value="food">Food</option>
                                <option value="nature">Nature</option>
                            </select>
                        </div>

                        <!-- Tag Filters -->
                        <div class="space-y-2">
                            <label class="text-light font-semibold text-sm">Tags</label>
                            <div id="tagFilters" class="flex flex-wrap gap-2">
                                <!-- Tags will be dynamically generated -->
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Main Content Area -->
                <div class="flex-1">
                    <!-- Mobile Search and Filters (shown only on small devices) -->
                    <div class="lg:hidden mb-6 space-y-4">
                        <div class="flex gap-2">
                            <input type="text" id="searchInputMobile" placeholder="Search articles..."
                                class="flex-1 px-4 py-3 bg-dark border border-accent-purple/30 rounded-lg text-light placeholder-light/50 focus:outline-none focus:border-accent-purple transition-colors">
                            <button id="searchBtnMobile"
                                class="px-6 py-3 bg-gradient-to-r from-accent-purple to-accent-red text-gray-500 font-bold rounded-lg hover:shadow-lg hover:shadow-accent-purple/50 transition-all duration-300">Search</button>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <div>
                                <label class="text-light/70 text-sm font-medium mr-2">Categories:</label>
                                <select id="categoryFilterMobile"
                                    class="px-3 py-2 bg-dark border border-accent-purple/30 rounded-lg text-light text-sm focus:outline-none focus:border-accent-purple transition-colors">
                                    <option value="">All Categories</option>
                                    <option value="travel">Travel</option>
                                    <option value="lifestyle">Lifestyle</option>
                                    <option value="food">Food</option>
                                    <option value="nature">Nature</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Loop through blogs from database -->
                        @foreach($blogs as $blog)
                        <div class="p-6">
                            <!-- Author and Date -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-accent-purple to-accent-red flex items-center justify-center text-gray-500 font-bold">
                                        {{ $blog->author_initial }}
                                    </div>
                                    <div>
                                        <p class="text-light font-medium text-sm">{{ $blog->author_name }}</p>
                                        <p class="text-light/60 text-xs">{{ $blog->published_date->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Gallery -->
                            <div class="image-gallery mb-4">
                                @if($blog->images)
                                    @foreach(array_slice($blog->images, 0, 3) as $image)
                                        {{-- <img src="{{ asset($image) }}" alt="{{ $blog->title }}" class="gallery-image"> --}}
                                        <img src="{{ asset(file_exists(public_path('storage/' . $image)) ? 'storage/' . $image : $image) }}"
                                        alt="{{ $blog->title }}"
                                        class="gallery-image">
                                    @endforeach
                                    @if(count($blog->images) > 3)
                                        <div class="gallery-image flex items-center justify-center bg-dark text-light/60 text-sm font-medium">
                                            +{{ count($blog->images) - 3 }} more
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <!-- Title and Excerpt -->
                            <h2 class="text-xl font-bold text-light mb-2">{{ $blog->title }}</h2>
                            <p class="text-light/70 text-sm mb-4">{{ $blog->excerpt }}</p><br>
                            <a href="{{ route('blog.show', $blog->id) }}"
                                class="inline-block text-gray-500 text-sm mb-2 font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-lg hover:shadow-accent-purple/30 transition-all duration-300">
                                Read more →
                            </a>

                            <!-- Category and Tags -->
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="text-xs px-2 py-1 bg-accent-purple/20 text-accent-purple rounded">{{ $blog->category }}</span>
                                @if($blog->tags)
                                    @foreach($blog->tags as $tag)
                                        <span class="text-xs px-2 py-1 bg-accent-seagreen/20 text-accent-seagreen rounded">{{ $tag }}</span>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Social Links -->
                            <div class="flex gap-3 mb-4">
                                <a href="https://twitter.com" target="_blank"
                                    class="text-light/60 hover:text-accent-purple transition-colors" title="Twitter">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                                <a href="https://facebook.com" target="_blank"
                                    class="text-light/60 hover:text-accent-purple transition-colors" title="Facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="https://instagram.com" target="_blank"
                                    class="text-light/60 hover:text-accent-purple transition-colors" title="Instagram">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </div>

                            <!-- Emoji Reactions -->
                            <div class="emoji-reactions">
                                @php
                                    $emojis = ['❤️', '👍', '😍', '🔥', '💯'];
                                @endphp
                                @foreach($emojis as $emoji)
                                    @php
                                        $reaction = $blog->reactions->firstWhere('emoji', $emoji);
                                        $count = $reaction ? $reaction->count : 0;
                                    @endphp
                                    <button class="emoji-btn" type="button" onclick="event.stopPropagation(); event.preventDefault(); addReaction({{ $blog->id }}, '{{ $emoji }}')">
                                        <span>{{ $emoji }}</span>
                                        <span class="reaction-count" data-post="{{ $blog->id }}" data-emoji="{{ $emoji }}">{{ $count }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('helpers.footer')
    @include('helpers.scripts')
</body>

</html>
