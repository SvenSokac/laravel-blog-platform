function addReaction(blogId, emoji) {
  fetch(`/blog/${blogId}/react`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    },
    body: JSON.stringify({ emoji: emoji }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Update the reaction count in the UI
        const countElement = document.querySelector(`.reaction-count[data-post="${blogId}"][data-emoji="${emoji}"]`)
        if (countElement) {
          countElement.textContent = data.count
        }
      }
    })
    .catch((error) => console.error("Error:", error))
}
