@include('helpers.head')

<body class="bg-dark text-light transition-colors duration-300">
    @include('helpers.navbar')

    <!-- Main Content -->
    <main class="min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-accent-purple hover:text-accent-purple/80 transition-colors mb-8">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Articles
            </a>

            <!-- Blog Post Content -->
            <article class="bg-dark-secondary rounded-lg border border-accent-purple/20 p-8">
                <!-- Display blog data from database -->
                <h1 class="text-4xl font-bold text-light mb-6">{{ $blog->title }}</h1>

                <div class="flex items-center gap-4 mb-8 pb-8 border-b border-accent-purple/20">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-accent-purple to-accent-red flex items-center justify-center text-gray-400 font-bold text-lg">
                        {{ $blog->author_initial }}
                    </div>
                    <div>
                        <p class="text-light font-semibold">{{ $blog->author_name }}</p>
                        <p class="text-light/60 text-sm">{{ $blog->published_date->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Image Gallery -->
                <div class="image-gallery mb-8">
                    @if($blog->images)
                        @foreach($blog->images as $image)
                            <img src="{{ asset($image) }}" alt="{{ $blog->title }}" class="gallery-image">
                        @endforeach
                    @endif
                </div>

                <!-- Category and Tags -->
                <div class="mb-8 flex flex-wrap gap-2">
                    <span class="text-sm px-3 py-1 bg-accent-purple/20 text-accent-purple rounded-full font-medium">{{ $blog->category }}</span>
                    @if($blog->tags)
                        @foreach($blog->tags as $tag)
                            <span class="text-sm px-3 py-1 bg-accent-seagreen/20 text-accent-seagreen rounded-full font-medium">{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>

                <!-- Blog Content -->
                <div class="prose prose-invert max-w-none mb-8">
                    <p class="text-light/80 leading-relaxed text-lg">{{ $blog->content }}</p>
                </div>

                <!-- Share buttons -->
                <div class="share-buttons mb-8 pb-8 border-b border-accent-purple/20">
                    <p class="text-light font-semibold mb-3">Share this article:</p>
                    <div class="flex flex-wrap gap-3">
                        <button class="share-btn" onclick="sharePost('twitter')">
                            <i class="fa-brands fa-x-twitter"></i>
                        </button>
                        <button class="share-btn" onclick="sharePost('facebook')">
                            <i class="fa-brands fa-facebook"></i>
                        </button>
                        <button class="share-btn" onclick="sharePost('copy')">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"></path></svg>
                            Copy Link
                        </button>
                    </div>
                </div>

                <!-- Emoji Reactions -->
                <div class="mb-8 pb-8 border-b border-accent-purple/20">
                    <p class="text-light font-semibold mb-3">React to this article:</p>
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

                <!-- Comments Section -->
                <div class="comments-section">
                    <h3 class="text-2xl font-bold text-light mb-6">Comments (<span id="commentCount">{{ $blog->comments->count() }}</span>)</h3>

                    <!-- Add Comment Form -->
                    <div class="mb-8 p-6 bg-dark rounded-lg border border-accent-purple/20">
                        <input type="text" id="authorName" placeholder="Your name" class="w-full px-4 py-2 mb-3 bg-dark-secondary border border-accent-purple/30 rounded-lg text-light placeholder-light/50 text-base focus:outline-none focus:border-accent-purple transition-colors">
                        <input type="email" id="authorEmail" placeholder="Your email" class="w-full px-4 py-2 mb-3 bg-dark-secondary border border-accent-purple/30 rounded-lg text-light placeholder-light/50 text-base focus:outline-none focus:border-accent-purple transition-colors">
                        <textarea id="newCommentText" placeholder="Share your thoughts..." class="w-full px-4 py-3 bg-dark-secondary border border-accent-purple/30 rounded-lg text-light placeholder-light/50 text-base focus:outline-none focus:border-accent-purple transition-colors resize-none" rows="4"></textarea>
                        <button onclick="addComment({{ $blog->id }})" class="mt-4 px-6 py-3 bg-gradient-to-r from-accent-purple to-accent-red text-gray-400 rounded-lg font-semibold hover:shadow-lg hover:shadow-accent-purple/50 transition-all duration-300">Post Comment</button>
                    </div>

                    <!-- Comments List -->
                    <div id="commentsList">
                        @if($blog->comments->count() > 0)
                            @foreach($blog->comments as $comment)
                                <div class="comment-thread mb-6">
                                    <div class="comment-header">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-accent-purple to-accent-red flex items-center justify-center text-gray-400 font-bold">
                                            {{ substr($comment->author_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="comment-author text-light font-semibold">{{ $comment->author_name }}</span>
                                            <span class="comment-time text-light/60"> • {{ $comment->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <p class="comment-text mt-3 text-light/80">{{ $comment->content }}</p>
                                    <div class="comment-actions">
                                        <button class="comment-action-btn text-accent-purple hover:text-accent-purple/80 transition-colors" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>
                                        <button class="comment-action-btn text-accent-purple hover:text-accent-purple/80 transition-colors" onclick="likeComment({{ $comment->id }})">
                                            <span id="like-{{ $comment->id }}">Like</span> (<span id="like-count-{{ $comment->id }}">{{ $comment->likes }}</span>)
                                        </button>
                                    </div>

                                    <!-- Reply Form -->
                                    <div id="replyForm-{{ $comment->id }}" class="reply-form hidden mt-4 p-4 bg-dark rounded-lg border border-accent-purple/20">
                                        <input type="text" class="reply-author w-full px-3 py-2 mb-2 bg-dark-secondary border border-accent-purple/30 rounded text-light placeholder-light/50 text-sm focus:outline-none focus:border-accent-purple transition-colors" placeholder="Your name" data-comment-id="{{ $comment->id }}">
                                        <input type="email" class="reply-email w-full px-3 py-2 mb-2 bg-dark-secondary border border-accent-purple/30 rounded text-light placeholder-light/50 text-sm focus:outline-none focus:border-accent-purple transition-colors" placeholder="Your email" data-comment-id="{{ $comment->id }}">
                                        <textarea class="reply-input w-full px-3 py-2 mb-2 bg-dark-secondary border border-accent-purple/30 rounded text-light placeholder-light/50 text-sm focus:outline-none focus:border-accent-purple transition-colors resize-none" placeholder="Write a reply..." rows="2" data-comment-id="{{ $comment->id }}"></textarea>
                                        <div class="flex gap-2">
                                            <button onclick="addReply({{ $blog->id }}, {{ $comment->id }})" class="px-4 py-2 bg-accent-purple text-gray-400 rounded font-medium hover:bg-accent-purple/80 transition-colors text-sm">Reply</button>
                                            <button onclick="toggleReplyForm({{ $comment->id }})" class="px-4 py-2 bg-light/20 text-light rounded font-medium hover:bg-light/30 transition-colors text-sm">Cancel</button>
                                        </div>
                                    </div>

                                    <!-- Replies -->
                                    @if($comment->replies->count() > 0)
                                        <div class="replies-container mt-4 ml-6 border-l-2 border-accent-purple/20 pl-4">
                                            @foreach($comment->replies as $reply)
                                                <div class="reply mb-4">
                                                    <div class="comment-header">
                                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-accent-seagreen to-accent-purple flex items-center justify-center text-gray-400 text-xs font-bold">
                                                            {{ substr($reply->author_name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <span class="comment-author text-light font-semibold text-sm">{{ $reply->author_name }}</span>
                                                            <span class="comment-time text-light/60 text-xs"> • {{ $reply->created_at->format('M d, Y') }}</span>
                                                        </div>
                                                    </div>
                                                    <p class="comment-text mt-2 text-light/80 text-sm">{{ $reply->content }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p class="text-light/60 text-center py-8">No comments yet. Be the first to share your thoughts!</p>
                        @endif
                    </div>
                </div>
            </article>
        </div>
    </main>

    <!-- Footer -->
    @include('helpers.footer')
    @include('helpers.scripts')

    <!-- Added JavaScript for dynamic comment handling -->
    <script>
        const blogId = {{ $blog->id }};

        function addComment(blogId) {
            const authorName = document.getElementById('authorName').value.trim();
            const authorEmail = document.getElementById('authorEmail').value.trim();
            const content = document.getElementById('newCommentText').value.trim();

            if (!authorName || !authorEmail || !content) {
                alert('Please fill in all fields');
                return;
            }

            fetch(`/blog/${blogId}/comments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    author_name: authorName,
                    author_email: authorEmail,
                    content: content,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('authorName').value = '';
                    document.getElementById('authorEmail').value = '';
                    document.getElementById('newCommentText').value = '';
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function toggleReplyForm(commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            if (replyForm) {
                replyForm.classList.toggle('hidden');
            }
        }

        function addReply(blogId, commentId) {
            const replyForm = document.getElementById(`replyForm-${commentId}`);
            const authorName = replyForm.querySelector('.reply-author').value.trim();
            const authorEmail = replyForm.querySelector('.reply-email').value.trim();
            const content = replyForm.querySelector('.reply-input').value.trim();

            if (!authorName || !authorEmail || !content) {
                alert('Please fill in all fields');
                return;
            }

            fetch(`/blog/${blogId}/comments/${commentId}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    author_name: authorName,
                    author_email: authorEmail,
                    content: content,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function likeComment(commentId) {
            fetch(`/comments/${commentId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`like-count-${commentId}`).textContent = data.likes;
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function sharePost(platform) {
            const url = window.location.href;
            const text = `Check out this article: {{ $blog->title }}`;

            if (platform === 'twitter') {
                window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`, '_blank');
            } else if (platform === 'facebook') {
                window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
            } else if (platform === 'copy') {
                navigator.clipboard.writeText(url);
                alert('Link copied to clipboard!');
            }
        }
    </script>
</body>

</html>
