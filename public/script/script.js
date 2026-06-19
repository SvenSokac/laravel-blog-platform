
function getAllTags() {
  const tags = new Set()
  blogPosts.forEach((post) => {
    post.tags.forEach((tag) => tags.add(tag))
  })
  return Array.from(tags)
}

function initializeTagFilters() {
  const tagFiltersContainer = document.getElementById("tagFilters")
  const tagFiltersContainerMobile = document.getElementById("tagFiltersMobile")

  const tags = getAllTags()

  const createTagButtons = (container) => {
    if (!container) return
    container.innerHTML = ""
    tags.forEach((tag) => {
      const tagBtn = document.createElement("button")
      tagBtn.type = "button"
      tagBtn.className = "tag-filter"
      tagBtn.textContent = tag
      tagBtn.onclick = (e) => {
        e.preventDefault()
        tagBtn.classList.toggle("active")
        // Toggle active state on corresponding button in other container
        const otherContainer = container === tagFiltersContainer ? tagFiltersContainerMobile : tagFiltersContainer
        if (otherContainer) {
          const otherBtn = Array.from(otherContainer.querySelectorAll(".tag-filter")).find(
            (btn) => btn.textContent === tag,
          )
          if (otherBtn) {
            otherBtn.classList.toggle("active")
          }
        }
        filterBlogPosts()
      }
      container.appendChild(tagBtn)
    })
  }

  createTagButtons(tagFiltersContainer)
  createTagButtons(tagFiltersContainerMobile)
}

function filterBlogPosts() {
  const searchInput = document.getElementById("searchInput")
  const categoryFilter = document.getElementById("categoryFilter")

  if (!searchInput || !categoryFilter) return

  const searchTerm = searchInput.value.toLowerCase()
  const selectedCategory = categoryFilter.value
  const selectedTags = Array.from(document.querySelectorAll(".tag-filter.active")).map((btn) => btn.textContent)

  const filtered = blogPosts.filter((post) => {
    const matchesSearch =
      post.title.toLowerCase().includes(searchTerm) ||
      post.excerpt.toLowerCase().includes(searchTerm) ||
      post.content.toLowerCase().includes(searchTerm)

    const matchesCategory = !selectedCategory || post.category === selectedCategory

    const matchesTags = selectedTags.length === 0 || selectedTags.some((tag) => post.tags.includes(tag))

    return matchesSearch && matchesCategory && matchesTags
  })

  renderBlogPosts(filtered)
}

// Theme Management
const themeToggle = document.getElementById("themeToggle")
const body = document.body

function initializeTheme() {
  const savedTheme = localStorage.getItem("theme") || "dark"
  if (savedTheme === "light") {
    body.classList.add("light-mode")
    updateThemeIcon()
  }
}

function updateThemeIcon() {
  const sunIcon = document.getElementById("sunIcon")
  const moonIcon = document.getElementById("moonIcon")

  if (body.classList.contains("light-mode")) {
    sunIcon.classList.remove("hidden")
    moonIcon.classList.add("hidden")
  } else {
    sunIcon.classList.add("hidden")
    moonIcon.classList.remove("hidden")
  }
}

if (themeToggle) {
  themeToggle.addEventListener("click", () => {
    body.classList.toggle("light-mode")
    updateThemeIcon()
    const currentTheme = body.classList.contains("light-mode") ? "light" : "dark"
    localStorage.setItem("theme", currentTheme)
  })
}

// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById("mobileMenuBtn")
const mobileMenu = document.getElementById("mobileMenu")

if (mobileMenuBtn && mobileMenu) {
  mobileMenuBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden")
  })
}

// Close mobile menu when clicking on a link
const mobileMenuLinks = document.querySelectorAll("#mobileMenu a")
mobileMenuLinks.forEach((link) => {
  link.addEventListener("click", () => {
    if (mobileMenu) {
      mobileMenu.classList.add("hidden")
    }
  })
})




function formatDate(dateString) {
  const options = { year: "numeric", month: "short", day: "numeric" }
  return new Date(dateString).toLocaleDateString("en-US", options)
}

function openPostModal(postId) {
  const post = blogPosts.find((p) => p.id === postId)
  if (!post) return

  const modalContent = document.getElementById("modalContent")
  if (!modalContent) return


  const postModal = document.getElementById("postModal")
  if (postModal) {
    postModal.classList.remove("hidden")
  }
}

function addComment(postId) {
  const post = blogPosts.find((p) => p.id === postId)
  const commentText = document.getElementById("newCommentText")

  if (!post || !commentText) return

  const text = commentText.value.trim()
  if (!text) return

  const newComment = {
    author: "You",
    text: text,
    date: new Date().toISOString().split("T")[0],
    replies: [],
  }

  post.comments.push(newComment)
  commentText.value = ""
  openPostModal(postId)
}

function toggleReplyForm(postId, commentIdx) {
  const replyForm = document.getElementById(`replyForm-${postId}-${commentIdx}`)
  if (replyForm) {
    replyForm.classList.toggle("hidden")
  }
}

function addReply(postId, commentIdx) {
  const post = blogPosts.find((p) => p.id === postId)
  if (!post || !post.comments[commentIdx]) return

  const replyForm = document.getElementById(`replyForm-${postId}-${commentIdx}`)
  if (!replyForm) return

  const replyText = replyForm.querySelector(".reply-input").value.trim()

  if (!replyText) return

  if (!post.comments[commentIdx].replies) {
    post.comments[commentIdx].replies = []
  }

  const newReply = {
    author: "You",
    text: replyText,
    date: new Date().toISOString().split("T")[0],
  }

  post.comments[commentIdx].replies.push(newReply)
  openPostModal(postId)
}

function likeComment(postId, commentIdx) {
  const post = blogPosts.find((p) => p.id === postId)
  if (!post || !post.comments[commentIdx]) return

  if (!post.comments[commentIdx].likes) {
    post.comments[commentIdx].likes = 0
  }
  post.comments[commentIdx].likes++
}

function sharePost(postId, platform) {
  const post = blogPosts.find((p) => p.id === postId)
  if (!post) return

  const url = window.location.href
  const text = `Check out this article: ${post.title}`

  if (platform === "twitter") {
    window.open(
      `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`,
      "_blank",
    )
  } else if (platform === "facebook") {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, "_blank")
  } else if (platform === "copy") {
    navigator.clipboard.writeText(url)
    alert("Link copied to clipboard!")
  }
}

function closeModal() {
  const postModal = document.getElementById("postModal")
  if (postModal) {
    postModal.classList.add("hidden")
  }
}

// Contact Form
const contactForm = document.getElementById("contactForm")
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault()
  })
}

// Newsletter Form
const newsletterForm = document.getElementById("newsletterForm")
if (newsletterForm) {
  newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault()
  })
}

// Search functionality
const searchBtn = document.getElementById("searchBtn")
if (searchBtn) {
  searchBtn.addEventListener("click", filterBlogPosts)
}

const searchBtnMobile = document.getElementById("searchBtnMobile")
if (searchBtnMobile) {
  searchBtnMobile.addEventListener("click", filterBlogPosts)
}

const searchInput = document.getElementById("searchInput")
if (searchInput) {
  searchInput.addEventListener("keyup", filterBlogPosts)
}

const searchInputMobile = document.getElementById("searchInputMobile")
if (searchInputMobile) {
  searchInputMobile.addEventListener("keyup", filterBlogPosts)
}

const categoryFilter = document.getElementById("categoryFilter")
if (categoryFilter) {
  categoryFilter.addEventListener("change", filterBlogPosts)
}

const categoryFilterMobile = document.getElementById("categoryFilterMobile")
if (categoryFilterMobile) {
  categoryFilterMobile.addEventListener("change", filterBlogPosts)
}

// Initialize About Map
function initializeAboutMap() {
  const mapElement = document.getElementById("aboutMap")
  if (!mapElement) return

  const readerLocations = [
    { lat: 27.7172, lng: 85.324, name: "Kathmandu, Nepal" },
    { lat: -8.65, lng: 115.2167, name: "Bali, Indonesia" },
    { lat: 13.7563, lng: 100.5018, name: "Bangkok, Thailand" },
    { lat: 64.1466, lng: -21.9426, name: "Reykjavik, Iceland" },
    { lat: 40.7128, lng: -74.006, name: "New York, USA" },
    { lat: 51.5074, lng: -0.1278, name: "London, UK" },
    { lat: 48.8566, lng: 2.3522, name: "Paris, France" },
    { lat: 35.6762, lng: 139.6503, name: "Tokyo, Japan" },
  ]

  const google = window.google
  if (!google) return

  const map = new google.maps.Map(mapElement, {
    zoom: 2,
    center: { lat: 20, lng: 0 },
    styles: [
      {
        elementType: "geometry",
        stylers: [{ color: "#1e293b" }],
      },
      {
        elementType: "labels.text.stroke",
        stylers: [{ color: "#1e293b" }],
      },
      {
        elementType: "labels.text.fill",
        stylers: [{ color: "#f1f5f9" }],
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [{ color: "#0f172a" }],
      },
    ],
  })

  readerLocations.forEach((location) => {
    new google.maps.Marker({
      position: { lat: location.lat, lng: location.lng },
      map: map,
      title: location.name,
      icon: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 8,
        fillColor: "#8B5CF6",
        fillOpacity: 0.8,
        strokeColor: "#EF4444",
        strokeWeight: 2,
      },
    })
  })
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", () => {
  initializeTheme()
  initializeTagFilters()
  renderBlogPosts()
  initializeAboutMap()
})

// Close modal when clicking outside
const postModal = document.getElementById("postModal")
if (postModal) {
  postModal.addEventListener("click", (e) => {
    if (e.target.id === "postModal") {
      closeModal()
    }
  })
}
