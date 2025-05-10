(function() {
  const faq = document.querySelector('.page.faq.archive')
  if (faq) {
    const tags = faq.querySelectorAll('.tags .tag')
    const posts = faq.querySelectorAll('.posts .post')
    tags.forEach(el => {
      el.addEventListener('click', () => {
        const term = Number(el.dataset.id)
        tags.forEach(_el => {
          _el.classList.remove('active')
        })
        el.classList.add('active')

        posts.forEach(post => {
          post.classList.add('hidden')
          const terms = JSON.parse(post.dataset.terms)
          if (terms.includes(term)) post.classList.remove('hidden')
        })
      })
    })
  }
})()
