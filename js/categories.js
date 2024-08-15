    function toggleDropdown() {
      const dropdown = document.querySelector('.dropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    document.addEventListener('click', function(event) {
      const dropdownContainer = document.querySelector('.dropdown-container');
      const dropdown = document.querySelector('.dropdown');

      if (!dropdownContainer.contains(event.target)) {
        dropdown.style.display = 'none';
      }
    });

    // Smooth scroll to post section when pen button is clicked
    const penButton = document.getElementById('pen-button');
    const postSection = document.getElementById('post-section');

    penButton.addEventListener('click', function() {
      postSection.scrollIntoView({ behavior: 'smooth' });
    });

    // Post creation functionality
    const postForm = document.getElementById('post-form');
    const postsContainer = document.getElementById('posts');

    postForm.addEventListener('submit', function(event) {
      event.preventDefault();
      createPost();
    });

    function createPost() {
      const postContent = document.getElementById('post-content').value;
      const isAnonymous = document.getElementById('anonymous-checkbox').checked;

      // Create a new post element
      const postElement = document.createElement('div');
      postElement.classList.add('post');

      // Create the post header
      const postHeader = document.createElement('div');
      postHeader.classList.add('post-header');

      const authorElement = document.createElement('span');
      authorElement.textContent = isAnonymous ? 'Anonymous' : 'Your Name';

      const postActions = document.createElement('div');
      postActions.classList.add('post-actions');

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.addEventListener('click', function() {
        postsContainer.removeChild(postElement);
      });

      postActions.appendChild(deleteButton);
      postHeader.appendChild(authorElement);
      postHeader.appendChild(postActions);

      // Create the post content
      const postContentElement = document.createElement('p');
      postContentElement.textContent = postContent;

      // Append the post header and content to the post element
      postElement.appendChild(postHeader);
      postElement.appendChild(postContentElement);

      // Append the post element to the posts container
      postsContainer.appendChild(postElement);

      // Clear the post content input
      document.getElementById('post-content').value = '';
    }